<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ReceiptPrintController extends Controller
{   
public function print()
{
    try {
        // Set your shared printer name here
        // $printer_name = "BlackCopper"; // Change to your printer's shared name
        // $connector = new WindowsPrintConnector($printer_name);
        $connector = new \Mike42\Escpos\PrintConnectors\FilePrintConnector("/dev/usb/lp1"); // or your device path
        $printer = new Printer($connector);


        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->setTextSize(2, 2); // Double size for store name
        $printer->setEmphasis(true); // Bold
        $printer->text("Green Plus Pharmacie\n");

        $printer->setTextSize(1, 1); // Normal size for the rest
        $printer->setEmphasis(false); // Unbold
        $printer->text("Shop# 3, Chiragh Din Market\n");
        $printer->text("Opp. Valencia Gate # 8, Defence Road, Lahore\n");
        $printer->text("Phone # 0321-4638248 (JAZZ CASH) 0308-4005680\n");
        $printer->text("License No: 05-352-0070-052414P\n\n");

        // Details Section
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->setEmphasis(true); // Bold for Sr. No and Date
        $printer->text(" No: 259583    ");
        $printer->setEmphasis(false); // Unbold for the rest
        $printer->text("Date: 06/11/2025\n");
         $printer->text("  M/S: Safia Begum\n\n");
        
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        // Table Headers (Bold)
        $printer->setEmphasis(true); // Bold for table headers
        $printer->text(str_pad("Item", 22));
        $printer->text(str_pad("Qty", 7));
        $printer->text(str_pad("Price", 8));
        $printer->text("Total\n");
        $printer->setEmphasis(false); // Unbold for table rows
        $printer->text(str_repeat("-", 42) . "\n");

        // Table Items
        $printer->text("  Inj Toujeo 300IU       03  3253.30  9759.99\n");
        $printer->text("  Inj Humulin R 100IU    02  1399.00  2798.00\n");
        $printer->text("  ..10ML                                     \n");
        $printer->text("  Inj Humulin N 100IU    02  1318.00  2636.00\n");
        $printer->text("  ..10ML90                                   \n");
        $printer->text("  Tab Linjardy MXR 5/25/ 60    28.60  1716.00\n");
        $printer->text("  ..1000mg                                   \n");
        $printer->text("  Tab Ucalo 2mg          60    30.00  1800.00\n");
        $printer->text("  Tab Levopraid 50mg    120    46.51  5581.20\n");
        $printer->text("  Tab Eziday DUO 5/50mg  60    17.50  1050.00\n");
        $printer->text("  Accu-check (performa)  01  2747.00  2747.00\n");
        $printer->text("  ..50's                                     \n");
        $printer->text("  Tab Lochol EZ 10/10MG  60    18.99  1139.40\n");
       
        
        $printer->text(str_repeat("-", 42) . "\n");
        
        // Totals Section (Bold for totals)
        
        $grossTotal = 29227.59;
        $netTotal = 29227.59;
        $discount = 0.00;

        
        $printer->setEmphasis(false); // Bold for totals
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("Gross Total:      " . str_pad(number_format($grossTotal, 2), 10, ' ', STR_PAD_LEFT) . "   \n");
        $printer->text("Disc:             " . str_pad(number_format($discount, 2), 10, ' ', STR_PAD_LEFT) . "   \n");
        $printer->text("Net Total:        " . str_pad(number_format($netTotal, 2), 10, ' ', STR_PAD_LEFT) . "   \n\n");
        $printer->setEmphasis(false); // Unbold

        // Footer (No bold, but keep regular text)
        $printer->setTextSize(1, 1); // Ensure normal font size
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("MEDICINE NOT RETURNABLE ON SUNDAY\n");
        $printer->text("OPEN MEDICINE NOT RETURNABLE\n");
        $printer->text("RETURN TIMING: 10 AM TO 6 PM FRIDAY\n");
        $printer->text("FRIDGE ITEM NOT RETURNABLE.\n\n\n");


        $printer->cut();
        $printer->close();

        return response()->json(['success' => true, 'message' => 'Receipt sent to printer.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Printing failed: ' . $e->getMessage()]);
    }
}

}