<?php declare(strict_type=1);

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    /**
     * @return Project[]
     */
    public function getAllProjects(): array
    {
        return Project::all()->toArray();
    }

    /**
     * @return Project[]
     */
    public function getDoneProjects(): array
    {
        return Project::where('end_date', '<', now())->get()->toArray();
    }

    /**
     * @return Project[]
     */
    public function getPendingProjects(): array
    {
        return Project::where('is_done', false)->get()->toArray();
    }
}
