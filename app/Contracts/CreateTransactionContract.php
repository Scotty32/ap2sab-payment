<?php declare(strict_types=1);

namespace App\Contracts;

use App\Models\Money;

class CreateTransactionContract {
    public function __construct(
        private string $uuid,
        private string $paymentCode,
        private float $amount,
        private string $currency,
        private string $paymentDate,
    ) {}

    public function getUuid(): string {
        return $this->uuid;
    }

    public function getPaymentCode(): string {
        return $this->paymentCode;
    }

    public function getAmount(): Money {
        return new Money(
            $this->currency,
            $this->amount,
        );
    }

    public function getPaymentDate(): string {
        return $this->paymentDate;
    }
}