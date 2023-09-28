<?php

namespace Tests\Feature;

use App\Models\Status;

use Tests\TestCase;
use Tests\Traits\Feature\CrudTrait;
use Tests\Traits\Feature\ValidationTrait;

class StatusTest extends TestCase
{
    use CrudTrait;
    use ValidationTrait;

    private $modelClass = Status::class;
    private $routePrefix = 'status';

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
