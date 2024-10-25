<?php declare(strict_types=1);

namespace App\Contracts;

class CheckTransactionResponseModel
{
    public function __construct(
        private string $paymentStatus,
        private string $paymentCode,
        private string $paymentDate,
    ) {}

    public function getPaymentStatus() : string {
        return $this->paymentStatus;
    }

    public function getPaymentCode() : string {
        return $this->paymentCode;
    }

    public function getPaymentDate() : string {
        return $this->paymentDate;
    }
}