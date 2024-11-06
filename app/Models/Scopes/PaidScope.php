<?php

namespace App\Models\Scopes;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PaidScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
       $builder->with('transaction', function ($query) {
        $query->where('status', Transaction::TRANSACTION_STATUS_PENDING);
       });
    }
}
