<?php declare(strict_types=1);

namespace App\Contracts;

class CreateParticipantContract {
    public function __construct(
        private string $last_name,
        private string $first_name,
        private string $email,
        private string $phoneNumber,
        private string $promotion,
        private ?string $profession,
        private string $country,
        private string $city,
    ) {}

    public function getFirstName(): string {
        return $this->first_name;
    }

    public function getLastName(): string {
        return $this->last_name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function getPromotion(): string {
        return $this->promotion;
    }

    public function getProfession(): ?string {
        return $this->profession;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function getCity(): string {
        return $this->city;
    }
}