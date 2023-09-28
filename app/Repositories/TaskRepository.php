<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends BaseRepository
{
    protected $model;

    /**
     * TaskRepository constructor
     * @param Task $task
     */
     public function __construct(Task $task)
     {
         $this->model = $task;
     }

}
