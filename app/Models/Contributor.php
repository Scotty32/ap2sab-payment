<?php declare(strict_type=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contributor extends Model
{
    use HasUuids;

    public function transaction(): BelongsTo {
        return $this->belongsTo(Transaction::class);
    }
    
    public function profile(): BelongsTo {
        return $this->belongsTo(Transaction::class);
    }
}
