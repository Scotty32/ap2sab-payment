<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    const TRANSACTION_STATUS_SUCCESS = 'success';
    const TRANSACTION_STATUS_FAILED = 'failed';
    const TRANSACTION_STATUS_PENDING = 'pending';

    const TRANSACTION_STATUS = [
        self::TRANSACTION_STATUS_FAILED,
        self::TRANSACTION_STATUS_PENDING,
        self::TRANSACTION_STATUS_SUCCESS,
    ];

    use HasUuids;

    
    protected $fillable = [
        'amount',
        'transaction_uuid',
        'payment_code',
        'payment_date',
        'payment_token',
        'payment_url',
        'designation',
        'status',
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
