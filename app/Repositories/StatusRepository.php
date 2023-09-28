<?php

namespace App\Repositories;

use App\Models\Status;

class StatusRepository extends BaseRepository
{
    protected $model;

    /**
     * StatusRepository constructor
     * @param Status $status
     */
     public function __construct(Status $status)
     {
         $this->model = $status;
     }

}
