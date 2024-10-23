<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    use HasUuids;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'phone_number',
        'promotion',
        'profession',
        'country',
        'city',
    ];

    public function transaction(): BelongsTo {
        return $this->belongsTo(Transaction::class);
    }
}
