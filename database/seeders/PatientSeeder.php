<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run()
    {
        $patients = [
            'Safia Begum',
            'Muhammad Ali',
            'Ayesha Khan',
            'Bilal Ahmed',
            'Fatima Noor',
        ];

        foreach ($patients as $name) {
            Patient::firstOrCreate(['name' => $name]);
        }
    }
}
