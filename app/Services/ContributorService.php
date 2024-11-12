<?php declare(strict_type=1);

namespace App\Services;

use App\Contracts\AddContributorContract;
use App\Contracts\AddContributorReturnContract;
use App\Models\Contributor;
use App\Models\Participant;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ContributorService
{
    public function __construct(
        private ProfileService $profileService,
        private TransactionService $transactionService,
    ) { }
    public function addContributor(
        AddContributorContract $contributorDto,
    ): AddContributorReturnContract {

        try {
            DB::beginTransaction();

            $profile = $this->profileService->getOrCreateProfile($contributorDto);
            $returnUrl = url(route('api.contribution.success',  ['project' => $contributorDto->getProject()->id]));

            $transaction = $this->transactionService->initTransaction(
                $profile,
                $contributorDto->getAmount(),
                $contributorDto->getDesignation(),
                $returnUrl,
            );
    
            $contributor = $this->createContributor($profile, $transaction, $contributorDto->getProject());

            DB::commit();
            return new AddContributorReturnContract(
                $contributor,
                $transaction->payment_url,
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function createContributor(
        Profile $profile,
        Transaction $transaction,
        Project $project,
    ): Contributor {
        $contributor = $profile->contributors()->create([
            'transaction_id' => $transaction->id,
            'project_id' =>$project->id,
        ]);

        return $contributor;
    }
}
