<?php

namespace App\Repositories;

use App\Models\Priority;

class PriorityRepository extends BaseRepository
{
    protected $model;

    /**
     * PriorityRepository constructor
     * @param Priority $priority
     */
     public function __construct(Priority $priority)
     {
         $this->model = $priority;
     }

}
