<?php

namespace Database\Seeders;

use App\Models\Contributor;
use App\Models\Money;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Projet 1',
                'description' => '<p>Création d’une Cité pour l’Hébergement des Prêtres et Évêques émérites ou avec des soucis de santé.</p>',
                'required_amount' => new Money('XOF', 0),
            ],
            [
                'title' => 'Projet 2',
                'description' => '<p>Exploitation de 100 hectares de cocoteraie en exploitation afin de renforcer les ressources financières de la Fondation.</p>',
                'required_amount' => new Money('XOF', 0),
            ],
            [
                'title' => 'Projet 3',
                'description' => '<p>10 hectares d’espace destiné à la construction de la Cité des Prêtres et Évêques émérites ou avec des soucis de santé.</p>',
                'required_amount' => new Money('XOF', 0),
            ],
            [
                'title' => 'Projet 4',
                'description' => '<p>Venir en aide aux membres qui vivent dans la précarité ou qui sont malades.</p>',
                'required_amount' => new Money('XOF', 0),
            ],
        ];

        Project::factory()
            ->createMany($events);
    }
}
