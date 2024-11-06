<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'event_id',
    ];

    public function scopePaid(Builder $query): void
    {
        $query->has( 'transaction.status', Transaction::TRANSACTION_STATUS_SUCCESS);
    }

    public function transaction(): BelongsTo {
        return $this->belongsTo(Transaction::class);
    }

    public function profile(): BelongsTo {
        return $this->belongsTo(Profile::class);
    }
    
    public function event(): BelongsTo {
        return $this->belongsTo(Event::class);
    }
}
