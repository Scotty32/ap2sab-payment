<?php
 
namespace App\Casts;

use App\Models\Money as MoneyValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
 
class Money implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): MoneyValueObject
    {
        return new MoneyValueObject(
            $attributes['participation_amount_currency'],
            $attributes['participation_amount_amount'],
        );
    }
 
    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     * @return array<string, string>
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        if (! $value instanceof MoneyValueObject) {
            throw new InvalidArgumentException('The given value is not an Money instance.');
        }
 
        return [
            'participation_amount_currency' => $value->getCurrency(),
            'participation_amount_amount' => $value->getAmount(),
        ];
    }
}