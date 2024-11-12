<?php declare(strict_type=1);

namespace App\Services;

use App\Models\Event;
use Carbon\Carbon;

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
        return Event::where('date', Carbon::createFromFormat('d/m/Y' ,$date)->format('Y-m-d'))->firstOrFail();
    }
}
