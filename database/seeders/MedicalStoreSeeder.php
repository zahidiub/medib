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
                'name' => 'Rafique Medical Store',
                'sub_name' => '',
                'license_no' => '05-352-0064-069265M',
                'address' => 'Main Al-Mumtaz Road Samanabad Lahore',
                'phone' => '0323-8430074',
                'bottom_content' => "NO RETURN WITHOUT RECEIPT\nRETURN TIMING: 10 AM TO 6 PM FRIDAY\nOPEN MEDICINE NOT RETURNABLE. FRIDGE\nITEM NOT RETURNABLE\n\n\n",
            ],    
            [
                'name' => 'Green Plus Pharmacie',
                'sub_name' => '',
                'license_no' => '05-352-0070-052414P',
                'address' => 'Shop# 3, Chiragh Din Market, Opp. Valencia Gate # 8, Defence Road, Lahore',
                'phone' => '0321-4638248',
                'bottom_content' => "MEDICINE NOT RETURNABLE ON SUNDAY\nOPEN MEDICINE NOT RETURNABLE\nRETURN TIMING: 10 AM TO 6 PM FRIDAY\nFRIDGE ITEM NOT RETURNABLE.",
            ],
            [
                'name' => 'Farooq Plus Pharmacy',
                'sub_name' => '',
                'license_no' => '05-352-0064-106323P',
                'address' => '168-Multan Road Niazi Building Lahore',
                'phone' => '0323-8415998',
                'bottom_content' => "MEDICINE NOT RETURNABLE ON SUNDAY\nOPEN MEDICINE NOT RETURNABLE\nRETURN TIMING: 10 AM TO 6 PM FRIDAY\nFRIDGE ITEM NOT RETURNABLE.",
            ],
            [
                'name' => 'Rainbow',
                'sub_name' => 'Cash & Carry Pharmacy',
                'license_no' => '2110-A/99',
                'address' => 'Main Canal, West Bank Road, Near EME DHA Sector Lahore',
                'phone' => '.42-35971775',
                'bottom_content' => "MEDICINE NOT RETURNABLE ON SUNDAY\nOPEN MEDICINE NOT RETURNABLE\nRETURN TIMING: 10 AM TO 6 PM FRIDAY\nFRIDGE ITEM NOT RETURNABLE.",
            ]
        ];

        foreach ($stores as $store) {
            MedicalStore::firstOrCreate(
                ['name' => $store['name']],
                $store
            );
        }
    }
}
