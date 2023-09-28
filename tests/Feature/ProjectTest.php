<?php

namespace Tests\Feature;

use App\Models\Project;

use Tests\TestCase;
use Tests\Traits\Feature\CrudTrait;
use Tests\Traits\Feature\ValidationTrait;

class ProjectTest extends TestCase
{
    use CrudTrait;
    use ValidationTrait;

    private $modelClass = Project::class;
    private $routePrefix = 'projects';

    private $requiredValidationFields = [
        'name'
    ];

    private $minValidationFields = [
        'name' => '3'
    ];

    private $maxValidationFields = [
        'name' => '255'
    ];
}
