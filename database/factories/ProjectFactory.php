<?php

namespace Database\Factories;

use App\Models\Money;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(5),
            'description' => fake()->randomHtml(),
            'required_amount' => new Money('XOF', rand(500000, 3000000)),
        ];
    }
}
