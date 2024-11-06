<?php

namespace Database\Factories;

use App\Models\Money;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [    
            'amount' => new Money('XOF', rand(500, 10000)),
            'transaction_uuid' => Uuid::uuid4(),
            'designation' => fake()->sentence(),
            'payment_url' => fake()->url(),
            'payment_token' => fake()->uuid(),
            'status' => Transaction::TRANSACTION_STATUS_PENDING,
        ];
    }
}
