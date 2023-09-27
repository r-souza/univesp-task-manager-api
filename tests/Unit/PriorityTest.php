<?php

namespace Tests\Unit;

use App\Models\Priority;
use App\Repositories\PriorityRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Tests\Traits\CommonTrait;
use Tests\Traits\Unit\CrudTrait;

class PriorityTest extends TestCase
{
    // use CrudTrait;
    use RefreshDatabase;
    use CommonTrait;

    private $modelClass = Priority::class;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    /**
    * Tests whether a record can be shown
    *
    * @return void
    */
    public function testItCanShow(): void
    {
        $this->ItCanShowModel($this->modelClass, $this->getRepository());
    }


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
