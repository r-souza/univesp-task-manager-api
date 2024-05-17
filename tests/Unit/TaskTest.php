<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Tests\Traits\Unit\CrudTrait;

class TaskTest extends TestCase
{
    use CrudTrait;

    private $modelClass = Task::class;

    /**
     * Method for return TaskRepository
     *
     * @return TaskRepository
     */
    private function getRepository(): TaskRepository
    {
        return new TaskRepository(new Task());
    }
}
