<?php declare(strict_types=1);

namespace App\Contracts;

class CreateProfileContract {
    public function __construct(
        protected string $last_name,
        protected string $first_name,
        protected string $email,
        protected string $phoneNumber,
        protected ?string $promotion,
        protected ?string $profession,
        protected string $country,
        protected string $city,
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

    public function getPromotion(): ?string {
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