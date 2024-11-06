<?php

namespace Database\Seeders;

use App\Models\Contributor;
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
        $projectName = 'Test de Projet';

        Project::factory()
            ->has(
                Contributor::factory()
                    ->count(3)
                    ->forTransaction([ 'designation' => $projectName])
                    ->forProfile()
            )
            ->create([
                'title' => $projectName
            ]);
            
        Project::factory()
        ->accomplished()
        ->has(
            Contributor::factory()
                ->count(3)
                ->forTransaction([ 'designation' => $projectName])
                ->forProfile()
        )
        ->create([
            'title' => $projectName
        ]);
            
    }
}
