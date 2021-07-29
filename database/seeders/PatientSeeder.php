<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the patients
        $patients = Patient::factory(250)->create();

        // Create the notes and randomise the patient associated with each.
        Note::factory(1000)
            ->create()
            ->each(function ($note) use ($patients) {
                $note->update(['patient_id' => $patients->random()->id]);
            });
    }
}
