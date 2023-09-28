<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ApiControllerTrait;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Resources\StatusCollection;
use App\Http\Resources\StatusResource;
use App\Repositories\StatusRepository;

class StatusController extends Controller
{
    use ApiControllerTrait;

    private $repository;
    private $resourceClass;
    private $resourceCollectionClass;

    public function __construct(StatusRepository $StatusRepository)
    {
        /**
         * For use with Trait
         */

        $this->repository = $StatusRepository;
        $this->resourceClass = StatusResource::class;
        $this->resourceCollectionClass = StatusCollection::class;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  App\Http\Requests\StatusRequest $request
    * @param  int $id
    * @return App\Http\Resources\StatusResource
    */
    public function update(UpdateStatusRequest $request, $id)
    {
        return $this->traitUpdate($request, $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StatusRequest    $request
     * @return App\Http\Resources\StatusResource
     */
    public function store(StoreStatusRequest $request)
    {
        return $this->traitStore($request);
    }

}
