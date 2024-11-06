<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventName = 'Test d evenement';

        Event::factory()
            ->has(
                Participant::factory()
                    ->forTransaction([ 'designation' => $eventName])
                    ->forProfile()
                    ->count(3)
            )
            ->create([
                'title' => $eventName
            ]);
        
        Event::factory()
            ->done()
            ->has(
                Participant::factory()
                    ->forTransaction([ 'designation' => $eventName])
                    ->forProfile()
                    ->count(3)
            )
            ->create([
                'title' => $eventName
            ]);
    }
}
