<?php declare(strict_types=1);

namespace App\Contracts;

use App\Models\Participant;

class AddParticipantReturnContract {
    public function __construct(
        private Participant $participant,
        private string $paymentUrl,
    ) {}
    public function getUrl(): string {
        return $this->paymentUrl;
    }

    public function getPayementUrl(): string {
        return $this->paymentUrl;
    }
}