<?php declare(strict_type=1);

namespace App\Services;

use App\Contracts\CreateParticipantContract;
use App\Models\Participant;
use App\Models\Transaction;

class ParticipantService
{
    public function addParticipant(
        CreateParticipantContract $participantDto,
        Transaction $transaction
    ): Participant {
        $data = [
            'last_name' => $participantDto->getLastName(),
            'first_name' => $participantDto->getFirstName(),
            'email' => $participantDto->getEmail(),
            'phone_number' => $participantDto->getPhoneNumber(),
            'promotion' => $participantDto->getPromotion(),
            'profession' => $participantDto->getProfession(),
            'country' => $participantDto->getCountry(),
            'city' => $participantDto->getCity(),
        ];

        $participant = $transaction->participant()->create($data);

        return $participant;
    }
}
