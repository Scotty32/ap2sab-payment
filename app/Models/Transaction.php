<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasUuids;

    
    protected $fillable = [
        'amount',
        'transaction_uuid',
        'payment_code',
        'payment_date',
    ];

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => new Money(
                $attributes['currency'],
                $attributes['raw_amount'],
            ),
            set: fn (mixed $value) => [
                'currency' => $value->getCurrency(),
                'raw_amount' => $value->getAmount(),
            ],
        );
    }

    public function participant(): HasOne
    {
        return $this->hasOne(Participant::class);
    }
}
