<?php declare(strict_type=1);

namespace App\Services;

use App\Models\Event;
use Carbon\Carbon;
use Exception;

class EventService
{
    /**
     * @return Event[]
     */
    public function getAllEvents(): array
    {
        return Event::all()->toArray();
    }
    
    /**
     * @return Event[]
     */
    public function getDoneEvents(): array
    {
        return Event::where('date', '<', now())->get()->toArray();
    }
    
    /**
     * @return Event[]
     */
    public function getPendingEvents(): array
    {
        return Event::where('date', '>', now())->get()->toArray();
    }

    /**
     * @return Event[]
     */
    public function getEventBydate(string $date): Event
    {
        return Event::whereDate('date', Carbon::createFromFormat('d/m/Y' ,$date)->format('Y-m-d'))->firstOr(function () use ($date) {
            throw new Exception('aucun evenement a la date '.Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'));
        });
    }
}
