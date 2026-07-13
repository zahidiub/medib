<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run()
    {
        $patients = [
            'Saif Ur Rehman',
            'Safia Begum',
            'Ghulam Mustafa'
        ];

        foreach ($patients as $name) {
            Patient::firstOrCreate(['name' => $name]);
        }
    }
}
