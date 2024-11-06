<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\EventService;

class Events extends Controller
{
    public function __construct(
        private EventService $eventService) {}
    /**
     * Handle the incoming request.
     */
    public function all()
    {
        try {
            return response()
            ->json($this->eventService->getAllEvents());
        } catch (\Throwable $th) {
            abort(400, $th->getMessage());
        }
    }

    public function pending()
    {
        try {
            return response()
            ->json($this->eventService->getPendingEvents());
        } catch (\Throwable $th) {
            abort(400, $th->getMessage());
        }
    }

    public function getDoneEvents()
    {
        try {
            return response()
            ->json($this->eventService->getDoneEvents());
        } catch (\Throwable $th) {
            abort(400, $th->getMessage());
        }
    }
}
