<?php declare(strict_types=1);

namespace App\Contracts;

class InitTransactionResponseModel
{
    public function __construct(
        private string $paymentUrl,
        private string $paymentToken,
    ) {}

    public function getPaymentUrl() : string {
        return $this->paymentUrl;
    }

    public function getPaymentToken() : string {
        return $this->paymentUrl;
    }
}