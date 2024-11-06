<?php

namespace App\Models;

use App\Concerns\ToUrl;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasUuids;
    use HasFactory;
    use ToUrl;

    protected $fillable = [
        'title',
        'decription',
        'end_date',
        'required_amount',
        'image_url',
    ];
    
    protected $appends = [
        'required_amount',
        'image_full_url',
    ];

    protected function requiredAmount(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => new Money(
                $attributes['required_amount_currency'],
                $attributes['required_amount_amount'],
            ),
            set: fn (mixed $value) => [
                'required_amount_currency' => $value->getCurrency(),
                'required_amount_amount' => $value->getAmount(),
            ],
        );
    }
    
    public function contributors(): HasMany
    {
        return $this->hasMany(Contributor::class);
    }
}
