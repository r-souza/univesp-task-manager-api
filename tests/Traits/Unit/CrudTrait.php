<?php

namespace Tests\Traits\Unit;

use Tests\Traits\CommonTrait;

trait CrudTrait
{
    use CommonTrait;

    /**
     * Tests whether a record can be shown
     *
     * @return void
     */
    public function testItCanShow(): void
    {
        $this->ItCanShowModel($this->modelClass, $this->getRepository());
    }

    /**
     * Tests whether a list of records can be shown
     *
     * @return void
     */
    public function testItCanListAll(): void
    {
        $this->itCanListModel($this->modelClass, $this->getRepository());
    }

    /**
     * Tests whether a record can be created
     *
     * @return void
     */
    public function testItCanCreate(): void
    {
        $this->itCanCreateModel($this->modelClass, $this->getRepository());
    }

    /**
     * Tests whether a record can be updated
     *
     * @return void
     */
    public function testItCanUpdate(): void
    {
        $this->itCanUpdateModel($this->modelClass, $this->getRepository());
    }

    /**
     * Tests whether a record can be deleted
     *
     * @return void
     */
    public function testItCanSoftDelete(): void
    {
        $this->itCanSoftDeleteModel($this->modelClass, $this->getRepository());
    }

    /**
     * Tests whether a record can be restored
     *
     * @return void
     */
    public function testItCanRestore(): void
    {
        $this->itCanRestoreModel($this->modelClass, $this->getRepository());
    }
}
