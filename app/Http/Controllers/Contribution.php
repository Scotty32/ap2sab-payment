<?php

namespace App\Http\Controllers;

use App\Contracts\AddContributorContract;
use App\Http\Requests\AddContributor;
use App\Http\Requests\AddParticipant;
use App\Models\Money;
use App\Services\ContributorService;
use Illuminate\Http\Request;

class Contribution extends Controller
{
    public function __construct(private ContributorService $contributorService) {}
    public function showContributionForm(Request $request)
    {
        $designation = $request->query('designation');

        if (null === $designation) {
            abort(404);
        }

        $request->session()->put('contribution_designation', $designation);

        return view('contribution.add_contributor', [
            'designation' => $designation,
        ]);
    }

    public function addContributor(AddContributor $request)
    {
        $designation = session('contribution_designation');

        if (null === $designation) {
            abort(404);
        }

        $data = $request->validated();

        try {
            $response = $this->contributorService->addContributor(
                new AddContributorContract(
                    $data['last_name'],
                    $data['first_name'],
                    $data['email'],
                    $data['phone_number'],
                    $data['promotion'],
                    $data['profession'],
                    $data['country'],
                    $data['city'],
                    new Money('XOF', $data['amount']),
                    $designation
                )
            );

            $request->session()->forget('contribution_designation');

            return redirect()->away($response->getUrl());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withErrors($th->getMessage());
        }
    }
}
