<?php declare(strict_type=1);

namespace App\Services;

use App\Contracts\CreateProfileContract;
use App\Models\Profile;

class ProfileService
{
    public function getOrCreateProfile(CreateProfileContract $profileDto): Profile
    {
        return Profile::findOrCreateProfile($profileDto);
    }
}
