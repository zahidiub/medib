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
            ['medicine_name' => 'Tab Eziday Duo 5/50mg', 'unit_price' => 17.50],
            ['medicine_name' => 'Accu-check (performa) 50s', 'unit_price' => 2747.00],
            ['medicine_name' => 'Tab Lochol EZ 10/10MG', 'unit_price' => 18.99],
            ['medicine_name' => 'Tab Panadol 500mg', 'unit_price' => 3.50],

            ['medicine_name' => 'Cap Sunny-D', 'unit_price' => 550.00],
            ['medicine_name' => 'Syp Rendac-C', 'unit_price' => 200.00],
            ['medicine_name' => 'Tab Actim 5mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Actin 2.5mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Ascard 75mg', 'unit_price' => 3.17],
            ['medicine_name' => 'Tab Azitma 50mg', 'unit_price' => 82.50],
            ['medicine_name' => 'Tab Biforge 10/160mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Bynevol 10mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Calone-D', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Danlol 2.5mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Lolura 2mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Myteka 10mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Neege 40mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Rosera 10mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Rovista 10mg', 'unit_price' => 45.33],
            ['medicine_name' => 'Tab Sofvasc 5/80mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Surbex-Z', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Sustac 2.6mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Triforge 5/160/25mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Triforge 10/160/25mg', 'unit_price' => 17.00],
            ['medicine_name' => 'Tab Trygil 2.6mg', 'unit_price' => 8.62],
            ['medicine_name' => 'Tab Venticort 400mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Vitrum', 'unit_price' => 500.00],
            ['medicine_name' => 'Tab Zopent 40mg', 'unit_price' => 40.70],
            ['medicine_name' => 'Tab Jardy MET 12.5/500mg', 'unit_price' => 45.00],
            ['medicine_name' => 'Tab Diabetron-MR 60mg', 'unit_price' => 20.33],
            ['medicine_name' => 'Tab Viptin-MET 50/500mg', 'unit_price' => 37.50],
            ['medicine_name' => 'Tab Bemdo 180mg', 'unit_price' => 39.00],
            ['medicine_name' => 'Tab Loprin 75mg', 'unit_price' => 2.73],
            ['medicine_name' => 'Tab Avincer 80mg', 'unit_price' => 33.00],
            ['medicine_name' => 'Strip BSL Accu-Check', 'unit_price' => 40.56],
            ['medicine_name' => 'Cap Indrop-D', 'unit_price' => 450.00],
            ['medicine_name' => 'Tab Itaglip Plus XR 50/500mg', 'unit_price' => 41.78],
            ['medicine_name' => 'Tab Atco DAP 10mg', 'unit_price' => 30.71],
            ['medicine_name' => 'Pen Toujeo Insulin Pen 300 Units', 'unit_price' => 3252.94],
            ['medicine_name' => 'Tab Eziday 50mg', 'unit_price' => 32.90],
            ['medicine_name' => 'Tab Neuro Met SL 1000mg', 'unit_price' => 40.00],
            ['medicine_name' => 'Tab Finone 100mg', 'unit_price' => 18.00],
            ['medicine_name' => 'Tab Cerebex Forte', 'unit_price' => 43.33],
            ['medicine_name' => 'Tab Metliptain 50/500mg', 'unit_price' => 28.54],
            ['medicine_name' => 'Tab Diampa LT 10/5mg', 'unit_price' => 39.64],
            ['medicine_name' => 'Tab Cresar AM 5/40mg', 'unit_price' => 26.79],
            ['medicine_name' => 'Tab Mabil 50mg', 'unit_price' => 13.67],
            ['medicine_name' => 'Tab Keto cell', 'unit_price' => 50.00],
            ['medicine_name' => 'Tab Nebivol 2.5mg', 'unit_price' => 12.07],
            ['medicine_name' => 'Cap Tamsol-D', 'unit_price' => 120.00],
            ['medicine_name' => 'Q.CO 50mg', 'unit_price' => 48.93],
            ['medicine_name' => 'Cap Cefspan 400mg', 'unit_price' => 146.00],
            ['medicine_name' => 'Cap Busonide 400/12mcg', 'unit_price' => 19.00],
            ['medicine_name' => 'Tab Antial 10mg', 'unit_price' => 20.00],
            ['medicine_name' => 'Tab Nobil 2.5mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Keto Cell', 'unit_price' => 50.00],
            ['medicine_name' => 'Cap Maxflow 0.4mg', 'unit_price' => 78.70],
            ['medicine_name' => 'Cac Plus 1000', 'unit_price' => 100.00],
            ['medicine_name' => 'Diazard Fort XR 12.5/2.5/100mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Diazard Fort XR 2.5/2.5/1000mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Digimint Syp', 'unit_price' => 100.00],
            ['medicine_name' => 'Glucomet Plus', 'unit_price' => 100.00],
            ['medicine_name' => 'Glucophage 1g', 'unit_price' => 100.00],
            ['medicine_name' => 'Glucoroute', 'unit_price' => 100.00],
            ['medicine_name' => 'Glusimet 50/500mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Linzardy 5/10mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Neumatoz 05', 'unit_price' => 100.00],
            ['medicine_name' => 'Novomix 50 Flex Pen', 'unit_price' => 100.00],
            ['medicine_name' => 'Oss PRO', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Rosera 5mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Rosubar 10mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Jezeta 10/10mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Levopraid 25mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab Novorapid Pen 10mg', 'unit_price' => 100.00],
            ['medicine_name' => 'Theragram Ultra', 'unit_price' => 100.00],
            ['medicine_name' => 'Tab DAPA MET XR 5/1000mg', 'unit_price' => 100.00],
        ];

        foreach ($medicines as $medicine) {
            Medicine::firstOrCreate(
                ['medicine_name' => $medicine['medicine_name']],
                $medicine
            );
        }
    }
}
