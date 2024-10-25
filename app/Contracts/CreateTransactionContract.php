<?php declare(strict_types=1);

namespace App\Contracts;

use App\Models\Money;

class CreateTransactionContract {
    public function __construct(
        private string $uuid,
        private Money $amount,
        private string $designation,
        private string $paymentToken,
        private string $paymentUrl,
    ) {}

    public function getUuid(): string {
        return $this->uuid;
    }

    public function getAmount(): Money {
        return $this->amount;
    }

    public function getDesignation(): string {
        return $this->designation;
    }

    public function getPayementToken(): string {
        return $this->paymentToken;
    }

    public function getPayementUrl(): string {
        return $this->paymentUrl;
    }
}