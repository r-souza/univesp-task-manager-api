<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Tests\Traits\Unit\CrudTrait;

class ProjectTest extends TestCase
{
    use CrudTrait;

    private $modelClass = Project::class;

    /**
     * Method for return ProjectRepository
     *
     * @return ProjectRepository
     */
    private function getRepository(): ProjectRepository
    {
        return new ProjectRepository(new Project());
    }


}
