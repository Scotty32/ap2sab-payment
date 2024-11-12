<?php

namespace App\Models;

use App\Concerns\ToUrl;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    use HasUuids;
    use HasFactory;
    use ToUrl;

    protected $fillable = [
        'title',
        'description',
        'required_amount_currency',
        'required_amount_amount',
        'required_amount',
        'image_url',
    ];
    
    protected $appends = [
        'image_full_url',
    ];

    protected $attributes = [
        'required_amount_currency' => 'XOF',
        'required_amount_amount' => 0,
        'image_url' => 'default-image.jpg',
    ];

    public static function boot(): void
    {
        parent::boot();
        Model::unguard();
    }

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
    
    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class, 'contributors');
    }
}
