<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class ReceiptPrintController extends Controller
{
    public function preview(Bill $bill)
    {
        $bill->load(['medicalStore', 'patient', 'billDetails.medicine']);
        return view('bills.preview', compact('bill'));
    }

    public function print(Bill $bill)
    {
        $bill->load(['medicalStore', 'patient', 'billDetails.medicine']);
        $store = $bill->medicalStore;

        try {
            $connector = new FilePrintConnector("/dev/usb/lp1"); // adjust device path if needed
            $printer = new Printer($connector);

            // Header - store name
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(2, 2);
            $printer->setEmphasis(true);
            $printer->text(($store->name ?? '') . "\n");

            // Header - store details
            $printer->setTextSize(1, 1);
            $printer->setEmphasis(false);
            if (!empty($store->sub_name)) {
                $printer->text($store->sub_name . "\n");
            }
            if (!empty($store->address)) {
                $printer->text($store->address . "\n");
            }
            if (!empty($store->phone)) {
                $printer->text("Phone # " . $store->phone . "\n");
            }
            if (!empty($store->license_no)) {
                $printer->text("License No: " . $store->license_no . "\n");
            }
            $printer->text("\n");

            // Bill meta
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->setEmphasis(true);
            $printer->text(" No: " . $bill->receipt_no . "    ");
            $printer->setEmphasis(false);
            $printer->text("Date: " . \Illuminate\Support\Carbon::parse($bill->date)->format('d/m/Y') . "\n");
            $printer->text(" M/S: " . (optional($bill->patient)->name ?? '') . "\n\n");

            // Table headers
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setEmphasis(true);
            $printer->text($this->row("Item", "Qty", "Price", "Total"));
            $printer->setEmphasis(false);
            $printer->text(str_repeat("-", 42) . "\n");

            // Table rows
            $grossTotal = 0;
            foreach ($bill->billDetails as $detail) {
                $name = optional($detail->medicine)->medicine_name ?? '';
                $printer->text($this->row(
                    $name,
                    (string) $detail->quantity,
                    number_format($detail->unit_price, 2),
                    number_format($detail->total_price, 2)
                ));
                $grossTotal += $detail->total_price;
            }

            $printer->text(str_repeat("-", 42) . "\n");

            // Totals
            $discount = (float) $bill->discount;
            $netTotal = $grossTotal - $discount;
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("Gross Total:      " . str_pad(number_format($grossTotal, 2), 10, ' ', STR_PAD_LEFT) . "   \n");
            $printer->text("Disc:             " . str_pad(number_format($discount, 2), 10, ' ', STR_PAD_LEFT) . "   \n");
            $printer->text("Net Total:        " . str_pad(number_format($netTotal, 2), 10, ' ', STR_PAD_LEFT) . "   \n\n");

            // Footer - bottom content from store
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            if (!empty($store->bottom_content)) {
                foreach (preg_split('/\r\n|\r|\n/', $store->bottom_content) as $line) {
                    $printer->text($line . "\n");
                }
            }
            $printer->text("\n\n");

            $printer->cut();
            $printer->close();

            return $this->message(true, 'Receipt #' . $bill->receipt_no . ' sent to printer.');
        } catch (\Exception $e) {
            return $this->message(false, 'Printing failed: ' . $e->getMessage());
        }
    }

    private function row($item, $qty, $price, $total)
    {
        // Column widths (14 + 3 + 10 + 12) plus 3 single-space separators = 42 chars.
        // A literal space between each column guarantees a gap even when a value
        // (e.g. a 6-digit price) is wider than its allotted column.
        return sprintf(
            "%-14.14s %3s %10s %12s\n",
            mb_substr($item, 0, 14),
            $qty,
            $price,
            $total
        );
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
