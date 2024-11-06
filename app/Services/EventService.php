<?php declare(strict_type=1);

namespace App\Services;

use App\Models\Event;

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
}
