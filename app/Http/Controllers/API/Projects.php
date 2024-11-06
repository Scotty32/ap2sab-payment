<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;

class Projects extends Controller
{
    public function __construct(
        private ProjectService $projectService
    ) {}
    
    public function all()
    {
        try {
            return response()
            ->json($this->projectService->getAllProjects());
        } catch (\Throwable $th) {
            abort(400, $th->getMessage());
        }
    }
    
    public function pending()
    {
        try {
            return response()
            ->json($this->projectService->getPendingProjects());
        } catch (\Throwable $th) {
            abort(400, $th->getMessage());
        }
    }

    public function getDoneProjects()
    {
        try {
            return response()
            ->json($this->projectService->getDoneProjects());
        } catch (\Throwable $th) {
            abort(400, $th->getMessage());
        }
    }
}
