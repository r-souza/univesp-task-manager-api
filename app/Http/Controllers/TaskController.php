<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ApiControllerTrait;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

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
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $per_page = $request->per_page;

        #Define a default column to sort with
        $sortColumn = ($request->sortColumn ? $request->sortColumn : 'id');

        #Define a default sort order
        $sortOrder = ($request->sortOrder ? $request->sortOrder : 'asc');

        #Define a default filter field
        $filterField = ($request->filterField ? $request->filterField : 'name');

        $filter = $request->filter;

        $statusId = $request->status_id;
        $projectId = $request->project_id;
        $priorityId = $request->priority_id;
        $userId = $request->user_id;

        $tasks = $this->repository->paginate($per_page, $sortColumn, $sortOrder, $filterField, $filter, $statusId, $projectId, $priorityId, $userId);

        return new $this->resourceCollectionClass($tasks);
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
