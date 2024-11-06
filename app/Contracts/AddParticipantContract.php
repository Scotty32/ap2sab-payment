<?php declare(strict_types=1);

namespace App\Contracts;

use App\Models\Event;
use App\Models\Money;

class AddParticipantContract extends CreateProfileContract {

    private Money $amount;
    private string $designation;

    public function __construct(
        string $last_name,
        string $first_name,
        string $email,
        string $phoneNumber,
        ?string $promotion,
        ?string $profession,
        string $country,
        string $city,
        protected Event $event,
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

        $this->amount = $event->participation_amount;
        $this->designation = $event->title;
    }

    public function getAmount() : Money
    {
        return $this->amount;
    }

    public function getDesignation() : string
    {
        return $this->designation;
    }

    public function getEvent() : Event
    {
        return $this->event;
    }
}