<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

/**
 * Trait with common methods for API controllers
 */
trait ApiControllerTrait
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return $this->repository->all();
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

        $records = $this->repository->paginate($per_page, $sortColumn, $sortOrder, $filter);

        return new $this->resourceCollectionClass($records);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ModelResource
     */
    public function show($id)
    {
        $record = $this->repository->getById($id);
        return new $this->resourceClass($record);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  Request $request
    * @param  int $id
    * @return Resource
    */
    public function traitUpdate($request, $id)
    {
        $record = $this->repository->update($request->all(), $id);

        return new $this->resourceClass($record);
    }

    /**
     * Custom Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Resource
     */
    public function traitCustomUpdate($data, $id)
    {
        $record = $this->repository->update($data, $id);
        return new $this->resourceClass($record);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request    $request
     * @return Resource
     */
    public function traitStore($request)
    {
        return new $this->resourceClass(
            $this->repository->create($request->all())
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->repository->delete($id)) {
            return response()->json(null, 204);
        }
    }

    /**
    * Restore the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function restore(int $id)
    {
        if ($this->repository->restore($id)) {
            return response()->json(sprintf('Record with id %s was restored', $id));
        }
    }

    /**
     * Display the specified softdeleted resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\PersonResource
     */
    public function showTrashed($id)
    {
        $record = $this->repository->getById($id, true);

        return new  $this->resourceClass($record);
    }

}
