<?php

namespace App\Models;

use App\Concerns\ToUrl;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasUuids;
    use HasFactory;
    use ToUrl;

    protected $fillable = [
        'title',
        'short_description',
        'long_description',
        'date',
        'participation_amount',
        'image_url',
    ];
    
    protected $appends = [
        'participation_amount',
        'image_full_url',
    ];

    
    public static function boot(): void
    {
        parent::boot();
        Model::unguard();
    }
    protected function participationAmount(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => new Money(
                $attributes['participation_amount_currency'],
                $attributes['participation_amount_amount'],
            ),
            set: fn (mixed $value) => [
                'participation_amount_currency' => $value->getCurrency(),
                'participation_amount_amount' => $value->getAmount(),
            ],
        );
        
    }    

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }
    
    protected function casts(): array
    {
        return [
            'participation_amount' => 'string',
        ];
    }
}
