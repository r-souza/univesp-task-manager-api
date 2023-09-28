<?php

namespace Tests\Feature;

use App\Models\Task;

use Tests\TestCase;
use Tests\Traits\Feature\CrudTrait;
use Tests\Traits\Feature\ValidationTrait;

class TaskTest extends TestCase
{
    use CrudTrait;
    use ValidationTrait;

    private $modelClass = Task::class;
    private $routePrefix = 'tasks';

    private $requiredValidationFields = [
        'name'
    ];

    private $minValidationFields = [
        'name' => '3',
        'description' => '3'
    ];

    private $maxValidationFields = [
        'name' => '255',
        'description' => '255'
    ];
}
