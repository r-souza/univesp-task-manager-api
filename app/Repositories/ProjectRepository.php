<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository extends BaseRepository
{
    protected $model;

    /**
     * ProjectRepository constructor
     * @param Project $project
     */
     public function __construct(Project $project)
     {
         $this->model = $project;
     }

}
