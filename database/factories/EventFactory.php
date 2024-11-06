<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Money;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(5),
            'short_description' => fake()->sentence(),
            'long_description' => fake()->randomHtml(),
            'date' => Carbon::now()->addMonths(6),
            'participation_amount' => new Money('XOF', rand(500000, 3000000)),
        ];
    }
    
    public function done(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'date' => Carbon::now()->subMonths(2),
            ];
        });
    }
}
