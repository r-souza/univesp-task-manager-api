<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Status;
use App\Repositories\StatusRepository;
use Tests\Traits\Unit\CrudTrait;

class StatusTest extends TestCase
{
    use CrudTrait;

    private $modelClass = Status::class;

    /**
     * Method for return StatusRepository
     *
     * @return StatusRepository
     */
    private function getRepository(): StatusRepository
    {
        return new StatusRepository(new Status());
    }
}
