<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ApiControllerTrait;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Repositories\ProjectRepository;

class ProjectController extends Controller
{
    use ApiControllerTrait;

    private $repository;
    private $resourceClass;
    private $resourceCollectionClass;

    public function __construct(ProjectRepository $ProjectRepository)
    {
        /**
         * For use with Trait
         */

        $this->repository = $ProjectRepository;
        $this->resourceClass = ProjectResource::class;
        $this->resourceCollectionClass = ProjectCollection::class;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  App\Http\Requests\ProjectRequest $request
    * @param  int $id
    * @return App\Http\Resources\ProjectResource
    */
    public function update(UpdateProjectRequest $request, $id)
    {
        return $this->traitUpdate($request, $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProjectRequest    $request
     * @return App\Http\Resources\ProjectResource
     */
    public function store(StoreProjectRequest $request)
    {
        return $this->traitStore($request);
    }

}
