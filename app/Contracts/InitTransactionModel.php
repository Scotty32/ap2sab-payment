<?php declare(strict_types=1);

namespace App\Contracts;

use App\Models\Money;
use App\Models\Profile;

class InitTransactionModel
{
    public function __construct(
        private Profile $profile,
        private Money $amount,
        private string $transaction_id,
        private string $designation,
        private string $returnUrl,
        private string $notifyUrl,
    ) {}

    public function getProfile() : Profile {
        return $this->profile;
    }

    public function getAmount() : Money {
        return $this->amount;
    }

    public function getTransactionId() : string {
        return $this->transaction_id;
    }

    public function getDesignation() : string {
        return $this->designation;
    }

    public function getReturnUrl() : string {
        return $this->returnUrl;
    }

    public function getNotifyUrl() : string {
        return $this->notifyUrl;
    }
}