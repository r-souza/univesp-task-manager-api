<?php

namespace Tests\Feature;

use App\Models\Priority;

use Tests\TestCase;
use Tests\Traits\Feature\CrudTrait;
use Tests\Traits\Feature\ValidationTrait;

class PriorityTest extends TestCase
{
    use CrudTrait;
    use ValidationTrait;

    private $modelClass = Priority::class;
    private $routePrefix = 'priorities';

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
