<?php declare(strict_type=1);

namespace App\Services;

use App\Contracts\AddParticipantContract;
use App\Contracts\AddParticipantReturnContract;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Profile;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ParticipantService
{
    public function __construct(
        private ProfileService $profileService,
        private TransactionService $transactionService,
    ) { }
    public function addParticipant(
        AddParticipantContract $participantDto,
    ): AddParticipantReturnContract {

        try {
            DB::beginTransaction();

            $profile = $this->profileService->getOrCreateProfile($participantDto);
            $returnUrl = url(route('api.evenement.inscription.success'));

            $transaction = $this->transactionService->initTransaction(
                $profile,
                $participantDto->getAmount(),
                $participantDto->getDesignation(),
                $returnUrl,
            );
    
            $participant = $this->createParticipant($profile, $transaction, $participantDto->getEvent());

            DB::commit();
            return new AddParticipantReturnContract(
                $participant,
                $transaction->payment_url,
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function createParticipant(
        Profile $profile,
        Transaction $transaction,
        Event $event
    ): Participant {
        $participant = $profile->participants()->create([
            'transaction_id' => $transaction->id,
            'event_id' => $event->id
        ]);

        return $participant;
    }
}
