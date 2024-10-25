<?php declare(strict_type=1);

namespace App\Models;

use App\Contracts\CreateProfileContract;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use HasUuids;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'phone_number',
        'promotion',
        'profession',
        'country',
        'city',
    ];

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function contributors(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    static public function findOrCreateProfile(CreateProfileContract $profileDto)
    {
        $data = [
            'last_name' => $profileDto->getLastName(),
            'first_name' => $profileDto->getFirstName(),
            'email' => $profileDto->getEmail(),
            'phone_number' => $profileDto->getPhoneNumber(),
            'promotion' => $profileDto->getPromotion(),
            'profession' => $profileDto->getProfession(),
            'country' => $profileDto->getCountry(),
            'city' => $profileDto->getCity(),
        ];
        
        $profile = Profile::where('email', $data['email'])
            ->where('phone_number', $data['phone_number'])
            ->first();

        if ($profile) {
            return $profile;
        }

        return Profile::create($data);
    }
}
