<?php

namespace Tests\Traits\Feature;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

trait CrudTrait
{
    /**
     * Tests whether a record can be shown
     *
     * @return void
     */
    public function testItCanShow(): void
    {
        $this->withoutMiddleware();

        $showRoute = $this->getRoute('show');

        $this->itCanShowModelOverHttp($this->modelClass, $showRoute);
    }

    /**
     * Tests whether a list of records can be shown
     *
     * @return void
     */
    public function testItCanList(): void
    {
        $this->withoutMiddleware();
        $indexRoute = $this->getRoute('index');

        $this->itCanListModelOverHttp($this->modelClass, $indexRoute, 4);
    }

    /**
     * Tests whether a record can be created
     *
     * @return void
     */
    public function testItCanCreate(): void
    {
        $this->withoutMiddleware();

        $storeRoute = $this->getRoute('store');

        $this->itCanCreateModelOverHttp($this->modelClass, $storeRoute);
    }

    /**
    * Tests whether a record can be updated
    *
    * @return void
    */
    public function testItCanUpdate(): void
    {
        $this->withoutMiddleware();

        $updateRoute = $this->getRoute('update');

        $this->itCanUpdateModelOverHttp($this->modelClass, $updateRoute);
    }

    /**
     * Tests whether a record can be deleted
     *
     * @return void
     */
    public function testItCanDelete(): void
    {
        $this->withoutMiddleware();

        $deleteRoute    = $this->getRoute('delete');
        $showRoute      = $this->getRoute('show');

        $this->itCanDeleteModelOverHttp($this->modelClass, $deleteRoute, $showRoute);
    }

    /**
     * Tests whether a record can be restored
     *
     * @return void
     */
    public function testItCanRestore(): void
    {
        $this->withoutMiddleware();

        $restoreRoute    = $this->getRoute('restore');
        $showRoute      = $this->getRoute('show');

        $this->itCanRestoreModelOverHttp($this->modelClass, $restoreRoute, $showRoute);
    }

    /**
     * Tests whether a softdeleted record can be shown
     *
     * @return void
     */
    public function testItCanShowTrashed()
    {
        $this->withoutMiddleware();

        $showRoute = $this->getRoute('showTrashed');

        $this->itCanShowSoftDeletedModelOverHttp($this->modelClass, $showRoute);
    }

    /**
     * @param string $action
     *
     * @return string
     */
    private function getRoute(string $action): string
    {
        $routes = [
            'index'         => 'index',
            'show'          => 'show',
            'store'         => 'store',
            'update'        => 'update',
            'delete'        => 'destroy',
            'all'           => 'all',
            'showTrashed'   => 'showTrashed',
            'restore'       => 'restore'
        ];

        return "{$this->routePrefix}.{$routes[$action]}";
    }
}
