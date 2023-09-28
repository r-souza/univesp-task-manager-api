<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ApiControllerTrait;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    use ApiControllerTrait;

    private $repository;
    private $resourceClass;
    private $resourceCollectionClass;

    public function __construct(TaskRepository $TaskRepository)
    {
        /**
         * For use with Trait
         */

        $this->repository = $TaskRepository;
        $this->resourceClass = TaskResource::class;
        $this->resourceCollectionClass = TaskCollection::class;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  App\Http\Requests\TaskRequest $request
    * @param  int $id
    * @return App\Http\Resources\TaskResource
    */
    public function update(UpdateTaskRequest $request, $id)
    {
        return $this->traitUpdate($request, $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TaskRequest    $request
     * @return App\Http\Resources\TaskResource
     */
    public function store(StoreTaskRequest $request)
    {
        return $this->traitStore($request);
    }

}
