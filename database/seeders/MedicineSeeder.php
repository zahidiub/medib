<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        $medicines = [
            ['medicine_name' => 'Inj Toujeo 300IU', 'unit_price' => 3253.30],
            ['medicine_name' => 'Inj Humulin R 100IU 10ML', 'unit_price' => 1399.00],
            ['medicine_name' => 'Inj Humulin N 100IU 10ML', 'unit_price' => 1318.00],
            ['medicine_name' => 'Tab Linjardy MXR 5/25/1000mg', 'unit_price' => 28.60],
            ['medicine_name' => 'Tab Ucalo 2mg', 'unit_price' => 30.00],
            ['medicine_name' => 'Tab Levopraid 50mg', 'unit_price' => 46.51],
            ['medicine_name' => 'Tab Eziday DUO 5/50mg', 'unit_price' => 17.50],
            ['medicine_name' => 'Accu-check (performa) 50s', 'unit_price' => 2747.00],
            ['medicine_name' => 'Tab Lochol EZ 10/10MG', 'unit_price' => 18.99],
            ['medicine_name' => 'Tab Panadol 500mg', 'unit_price' => 3.50],
        ];

        foreach ($medicines as $medicine) {
            Medicine::firstOrCreate(
                ['medicine_name' => $medicine['medicine_name']],
                $medicine
            );
        }
    }
}
