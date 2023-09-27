<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Priority;
use App\Repositories\PriorityRepository;
use Tests\Traits\Unit\CrudTrait;

class PriorityTest extends TestCase
{
    use CrudTrait;

    private $modelClass = Priority::class;

    /**
     * Method for return PriorityRepository
     *
     * @return PriorityRepository
     */
    private function getRepository(): PriorityRepository
    {
        return new PriorityRepository(new Priority());
    }


}
