<?php

namespace App\Http\Controllers;

use App\Contracts\AddParticipantContract;
use App\Http\Requests\AddParticipant;
use App\Models\Event;
use App\Models\Money;
use App\Services\ParticipantService;
use Illuminate\Http\Request;

class Participation extends Controller
{
    public function __construct(private ParticipantService $participantService) {}
    public function showParticipationForm(Request $request, Event $event)
    {
        $designation = $event->title;
        $amount = $event->participation_amount_amount;
        $formAction = url(route('evenement.inscription.store', [ 'event' => $event->id]));

        return view('participation.add_participant', [
            'amount' => $amount,
            'designation' => $designation,
            'formAction' => $formAction
        ]);
    }

    public function addParticipant(AddParticipant $request, Event $event)
    {
        $designation = $event->title;

        $data = $request->validated();

        try {
            $response = $this->participantService->addParticipant(
                new AddParticipantContract(
                    $data['last_name'],
                    $data['first_name'],
                    $data['email'],
                    $data['phone_number'],
                    $data['promotion'],
                    $data['profession'],
                    $data['country'],
                    $data['city'],
                    $event,
                    $designation
                )
            );

            return redirect()->away($response->getUrl());
        } catch (\Throwable $th) {
            return back()->withErrors($th->getMessage());
        }
    }
}
