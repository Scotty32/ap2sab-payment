<?php declare(strict_types=1);

namespace App\Contracts;

use App\Models\Contributor;

class AddContributorReturnContract {
    public function __construct(
        private Contributor $contributor,
        private string $paymentUrl,
    ) {}
    public function getUrl(): string {
        return $this->paymentUrl;
    }

    public function getPayementUrl(): string {
        return $this->paymentUrl;
    }
}