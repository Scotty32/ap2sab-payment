<?php declare(strict_types=1);

namespace App\Contracts;

use App\Models\Money;
use App\Models\Project;

class AddContributorContract  extends CreateProfileContract {

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
        private Money $amount,
        protected Project $project,
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

        $this->designation = $project->title;
    }

    public function getAmount() : Money
    {
        return $this->amount;
    }

    public function getDesignation() : string
    {
        return $this->designation;
    }

    public function getProject() : Project
    {
        return $this->project;
    }
}