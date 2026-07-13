<?php

namespace Database\Seeders;

use App\Models\MedicalStore;
use Illuminate\Database\Seeder;

class MedicalStoreSeeder extends Seeder
{
    public function run()
    {
        $stores = [
            [
                'name' => 'Green Plus Pharmacie',
                'license_no' => '05-352-0070-052414P',
                'address' => 'Shop# 3, Chiragh Din Market, Opp. Valencia Gate # 8, Defence Road, Lahore',
                'phone' => '0321-4638248',
                'bottom_content' => "MEDICINE NOT RETURNABLE ON SUNDAY\nOPEN MEDICINE NOT RETURNABLE\nRETURN TIMING: 10 AM TO 6 PM FRIDAY\nFRIDGE ITEM NOT RETURNABLE.",
            ],
            [
                'name' => 'City Care Pharmacy',
                'license_no' => '05-100-2233-778899X',
                'address' => 'Main Boulevard, Gulberg III, Lahore',
                'phone' => '0300-1122334',
                'bottom_content' => "NO RETURN WITHOUT RECEIPT\nCHECK MEDICINE BEFORE LEAVING",
            ],
        ];

        foreach ($stores as $store) {
            MedicalStore::firstOrCreate(
                ['name' => $store['name']],
                $store
            );
        }
    }
}
