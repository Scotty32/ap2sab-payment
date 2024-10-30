<?php

namespace App\Http\Controllers;

use App\Contracts\AddParticipantContract;
use App\Http\Requests\AddParticipant;
use App\Models\Money;
use App\Services\ParticipantService;
use Illuminate\Http\Request;

class Participation extends Controller
{
    public function __construct(private ParticipantService $participantService) {}
    public function showParticipationForm(Request $request)
    {
        $designation = $request->query('designation');
        $amount = $request->query('amount');

        if (null === $amount || null === $designation) {
            abort(404);
        }

        $request->session()->put('participation_amount', $amount);
        $request->session()->put('participation_designation', $designation);

        return view('participation.add_participant', [
            'amount' => $amount,
            'designation' => $designation,
        ]);
    }

    public function addParticipant(AddParticipant $request)
    {
        $amount = session('participation_amount');
        $designation = session('participation_designation');

        if (null === $amount || null === $designation) {
            abort(404);
        }

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
                    new Money('XOF', $amount),
                    $designation
                )
            );

            $request->session()->forget('participation_amount');
            $request->session()->forget('participation_designation');

            return redirect()->away($response->getUrl());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withErrors($th->getMessage());
        }
    }
}
