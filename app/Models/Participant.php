<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    use HasUuids;

    protected $fillable = [
        'transaction_id'
    ];

    public function transaction(): BelongsTo {
        return $this->belongsTo(Transaction::class);
    }

    public function profile(): BelongsTo {
        return $this->belongsTo(Profile::class);
    }
}
