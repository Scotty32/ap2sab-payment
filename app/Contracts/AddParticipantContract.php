<?php declare(strict_types=1);

namespace App\Contracts;

use App\Models\Money;

class AddParticipantContract extends CreateProfileContract {
    public function __construct(
        string $last_name,
        string $first_name,
        string $email,
        string $phoneNumber,
        ?string $promotion,
        ?string $profession,
        string $country,
        string $city,
        private Money $amount,
        private string $designation,
    ) {
        parent::__construct(
            $last_name,
            $first_name,
            $email,
            $phoneNumber,
            $promotion,
            $profession,
            $country,
            $city
        );
    }

    public function getAmount() : Money
    {
        return $this->amount;
    }

    public function getDesignation() : string
    {
        return $this->designation;
    }
}