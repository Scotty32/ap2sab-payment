<?php

namespace Database\Seeders;

use App\Models\Participant;
use Illuminate\Database\Seeder;

class ParticipationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Participant::factory()
            ->count(2)
            ->forProfile()
            ->forTransaction()
            ->create();
    }
}
