<?php

namespace App\Http\Controllers;

use App\Contracts\AddContributorContract;
use App\Http\Requests\AddContributor;
use App\Http\Requests\AddParticipant;
use App\Models\Money;
use App\Models\Project;
use App\Services\ContributorService;
use Illuminate\Http\Request;

class Contribution extends Controller
{
    public function __construct(private ContributorService $contributorService) {}
    public function showContributionForm(Request $request, Project $project)
    {
        $formAction = route('contribution.store', ['project' => $project->id]);

        return view('contribution.add_contributor', [
            'designation' => $project->title,
            'formAction' => $formAction,
        ]);
    }

    public function addContributor(AddContributor $request, Project $project)
    {

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
                    $project
                )
            );

            return redirect()->away($response->getUrl());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withErrors($th->getMessage());
        }
    }
}
