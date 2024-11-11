<?php

namespace App\Models;

use App\Casts\Money;
use App\Concerns\ToUrl;
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
        'participation_amount_currency',
        'participation_amount_amount',
        'image_url',
    ];

    protected $appends = [
        'image_full_url',
    ];
    
    public static function boot(): void
    {
        Model::unguard();
        parent::boot();
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }
    
    protected function casts(): array
    {
        return [
            'participation_amount' => Money::class,
        ];
    }
}
