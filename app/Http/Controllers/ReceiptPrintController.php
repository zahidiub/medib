<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Support\Carbon;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class ReceiptPrintController extends Controller
{
    // Character width of the thermal paper. All layout math is based on this so
    // that the on-screen preview and the printed paper are byte-for-byte identical.
    const WIDTH = 42;

    public function preview(Bill $bill)
    {
        $lines = $this->buildReceiptLines($bill);
        return view('bills.preview', compact('bill', 'lines'));
    }

    public function print(Bill $bill)
    {
        $lines = $this->buildReceiptLines($bill);

        try {
            $connector = new FilePrintConnector("/dev/usb/lp1"); // adjust device path if needed
            $printer = new Printer($connector);

            // Alignment/centering is already baked into the text, so print every
            // line left-justified at normal size to match the preview exactly.
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->setTextSize(1, 1);

            foreach ($lines as $line) {
                if (!empty($line['big'])) {
                    // Store name: medium (double height), bold, centered by the printer.
                    $printer->setJustification(Printer::JUSTIFY_CENTER);
                    $printer->setTextSize(2, 2);
                    $printer->setEmphasis(true);
                    $printer->text($line['text'] . "\n");
                    $printer->setTextSize(1, 1);
                    $printer->setEmphasis(false);
                    continue;
                }
                // Center every line on the paper. The body lines are all exactly
                // WIDTH characters wide, so centering shifts them as a single block
                // and gives equal margins on both sides while keeping the columns
                // aligned. Header/footer lines are shorter and get centered too.
                $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->setEmphasis(!empty($line['bold']));
                $printer->text($line['text'] . "\n");
            }
            $printer->setEmphasis(false);

            $printer->text("\n\n");
            $printer->cut();
            $printer->close();

            return $this->message(true, 'Receipt #' . $bill->receipt_no . ' sent to printer.');
        } catch (\Exception $e) {
            return $this->message(false, 'Printing failed: ' . $e->getMessage());
        }
    }

    /**
     * Single source of truth for the receipt layout.
     * Returns an array of ['text' => string, 'bold' => bool] lines, each already
     * aligned/padded to the paper width. Used by both the printer and the preview.
     */
    private function buildReceiptLines(Bill $bill): array
    {
        $bill->load(['medicalStore', 'patient', 'billDetails.medicine']);
        $store = $bill->medicalStore;

        $lines = [];

        // Header - store name (large + bold, centered). Stored raw (unpadded) so the
        // printer can center it at double size and the preview can center it via CSS.
        $lines[] = $this->line($store->name ?? '', true, true);
        if (!empty($store->sub_name)) {
            $lines[] = $this->line($store->sub_name, false, false, 'center');
        }
        if (!empty($store->address)) {
            $lines[] = $this->line($store->address, false, false, 'center');
        }
        if (!empty($store->phone)) {
            $lines[] = $this->line("Phone # " . $store->phone, false, false, 'center');
        }
        if (!empty($store->license_no)) {
            $lines[] = $this->line("License No: " . $store->license_no, false, false, 'center');
        }
        $lines[] = $this->line('');

        // Bill meta - receipt no on the left, date on the right
        $left = "No: " . $bill->receipt_no;
        $right = "Date: " . Carbon::parse($bill->date)->format('d/m/Y');
        $lines[] = $this->line($this->leftRight($left, $right), true);
        $lines[] = $this->line($this->padRight("M/S: " . (optional($bill->patient)->name ?? '')));
        $lines[] = $this->line('');

        // Table header
        foreach ($this->row("Item", "Qty", "Price", "Total") as $r) {
            $lines[] = $this->line($r, true);
        }
        $lines[] = $this->line(str_repeat("-", self::WIDTH));

        // Table rows
        $grossTotal = 0;
        foreach ($bill->billDetails as $detail) {
            $rows = $this->row(
                optional($detail->medicine)->medicine_name ?? '',
                (string) $detail->quantity,
                number_format($detail->unit_price, 2),
                number_format($detail->total_price, 2)
            );
            foreach ($rows as $r) {
                $lines[] = $this->line($r);
            }
            $grossTotal += $detail->total_price;
        }
        $lines[] = $this->line(str_repeat("-", self::WIDTH));

        // Totals
        $discount = (float) $bill->discount;
        $netTotal = $grossTotal - $discount;
        $lines[] = $this->line($this->totalLine("Gross Total:", $grossTotal));
        $lines[] = $this->line($this->totalLine("Disc:", $discount));
        $lines[] = $this->line($this->totalLine("Net Total:", $netTotal), true);

        // Footer - store bottom content (centered)
        if (!empty($store->bottom_content)) {
            $lines[] = $this->line('');
            foreach (preg_split('/\r\n|\r|\n/', $store->bottom_content) as $footer) {
                $lines[] = $this->line($footer, false, false, 'center');
            }
        }

        return $lines;
    }

    private function line($text, $bold = false, $big = false, $align = 'left'): array
    {
        return ['text' => $text, 'bold' => $bold, 'big' => $big, 'align' => $align];
    }

    private function padRight($text): string
    {
        $text = (string) $text;
        $len = mb_strlen($text);
        if ($len >= self::WIDTH) {
            return mb_substr($text, 0, self::WIDTH);
        }
        return $text . str_repeat(' ', self::WIDTH - $len);
    }

    private function leftRight($left, $right): string
    {
        $gap = self::WIDTH - mb_strlen($left) - mb_strlen($right);
        $gap = $gap > 1 ? $gap : 1;
        return $left . str_repeat(' ', $gap) . $right;
    }

    private function totalLine($label, $amount): string
    {
        $str = $label . "  " . number_format($amount, 2);
        return str_pad($str, self::WIDTH, ' ', STR_PAD_LEFT);
    }

    /**
     * Format one item row into 42-char lines.
     * Columns: item 14 + qty 3 + price 10 + total 12, plus single-space separators.
     * Long item names wrap onto continuation lines; only the first line carries the
     * qty/price/total values.
     */
    private function row($item, $qty, $price, $total): array
    {
        $wrapped = $this->wrapText($item, 18);

        $out = [];
        $out[] = sprintf("%-18.18s %3s %8s %10s", array_shift($wrapped), $qty, $price, $total);

        foreach ($wrapped as $line) {
            // Pad to full width so continuation lines shift with the rest of the
            // centered block instead of being centered on their own.
            $out[] = $this->padRight(" " . $line);
        }

        return $out;
    }

    private function wrapText($text, $width): array
    {
        $text = trim((string) $text);
        if ($text === '') {
            return [''];
        }

        $lines = [];
        foreach (preg_split('/\s+/', $text) as $word) {
            while (mb_strlen($word) > $width) {
                $lines[] = mb_substr($word, 0, $width);
                $word = mb_substr($word, $width);
            }

            if (empty($lines)) {
                $lines[] = $word;
                continue;
            }

            $last = array_pop($lines);
            $candidate = $last === '' ? $word : $last . ' ' . $word;
            if (mb_strlen($candidate) <= $width) {
                $lines[] = $candidate;
            } else {
                $lines[] = $last;
                $lines[] = $word;
            }
        }

        return empty($lines) ? [''] : $lines;
    }

    private function message($success, $text)
    {
        $color = $success ? '#16a34a' : '#dc2626';
        $back = route('bills.index');
        return response(
            "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Print</title>"
            . "<style>body{font-family:sans-serif;padding:40px;text-align:center}"
            . "a{display:inline-block;margin-top:20px;padding:8px 16px;background:#1f2937;color:#fff;text-decoration:none;border-radius:6px}</style>"
            . "</head><body><h2 style='color:{$color}'>{$text}</h2>"
            . "<a href='{$back}'>Back to Bills</a></body></html>"
        );
    }
}
