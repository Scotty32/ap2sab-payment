<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contributor extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'profile_id',
        'project_id',
    ];

    public function transaction(): BelongsTo {
        return $this->belongsTo(Transaction::class);
    }
    
    public function profile(): BelongsTo {
        return $this->belongsTo(Profile::class);
    }
    
    public function project(): BelongsTo {
        return $this->belongsTo(Project::class);
    }
}
