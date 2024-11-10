<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Stringable;

class Money extends Stringable
{
    public function __construct(
        private string $currency,
        private float $amount
    ) {}

    public function getCurrency() : string
    {
        return $this->currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function __toString(): string
    {
        return "{$this->amount} {$this->getDeviseFromSymbol($this->currency)}";
    }

    private function getDeviseFromSymbol(string $symbol) {
        $devises = [
            'XOF' => 'FCFA',
            'EUR' => 'Euro',
            '$' => 'Dollar',
        ];

        return $devises[$symbol];
    }
}