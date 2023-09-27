<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ApiControllerTrait;
use App\Http\Requests\StorePriorityRequest;
use App\Http\Requests\UpdatePriorityRequest;
use App\Http\Resources\PriorityCollection;
use App\Http\Resources\PriorityResource;
use App\Repositories\PriorityRepository;

class PriorityController extends Controller
{
    use ApiControllerTrait;

    private $repository;
    private $resourceClass;
    private $resourceCollectionClass;

    public function __construct(PriorityRepository $PriorityRepository)
    {
        /**
         * For use with Trait
         */

        $this->repository = $PriorityRepository;
        $this->resourceClass = PriorityResource::class;
        $this->resourceCollectionClass = PriorityCollection::class;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  App\Http\Requests\PriorityRequest $request
    * @param  int $id
    * @return App\Http\Resources\PriorityResource
    */
    public function update(UpdatePriorityRequest $request, $id)
    {
        return $this->traitUpdate($request, $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PriorityRequest    $request
     * @return App\Http\Resources\PriorityResource
     */
    public function store(StorePriorityRequest $request)
    {
        return $this->traitStore($request);
    }

}
