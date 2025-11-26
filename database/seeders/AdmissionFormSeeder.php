<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdmissionForm;
use App\Models\University;

class AdmissionFormSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure universities exist
        if (University::count() == 0) {
            $this->call(UniversitySeeder::class);
        }

        // Create 50 admission forms and auto attach to universities
        AdmissionForm::factory(50)->create();
    }
}
