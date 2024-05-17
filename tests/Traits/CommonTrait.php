<?php

namespace Tests\Traits;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;

trait CommonTrait
{
    use WithFaker;

    /**
     * This method makes and returns a model without persisting it on the database.
     * Method available on Common Trait
     *
     * @param string $class
     *
     * @return Model
     */
    public function makeModel(string $class, array $overrides = []): Model
    {
        return $class::factory()->make($overrides);
    }


    /**
     * This method creates and returns a model persisting it on the database.
     *
     * @param string $class
     * @param array $overrides
     *
     * @return Model
     */
    public function createModel(string $class, array $overrides = []): Model
    {
        // return factory($class)->create($overrides);
        return $class::factory()->create($overrides);
    }


    /**
     * This method creates and returns some registries persisted the database.
     *
     * @param string $class
     * @param int $registries
     *
     * @return Collection
     */
    public function createModels(string $class, int $registries): Collection
    {
        // return factory($class, $registries)->create();
        return $class::factory()
            ->count($registries)
            ->create();
    }

    /**
     * @param string $class
     * @param BaseRepository $repository
     * @param string|null $fieldToVerify
     *
     * @return void
     */
    public function itCanCreateModel(string $class, BaseRepository $repository, string $fieldToVerify = null): void
    {
        $model = $this->makeModel($class);
        $fieldToVerify = $this->handleFieldToVerify($fieldToVerify, $model);

        $created = $repository->create($model->toArray());

        $this->assertInstanceOf($class, $created);
        $this->assertEquals($created->$fieldToVerify, $model->$fieldToVerify);
    }

    /**
     * @param string $class
     * @param string $storeRoute
     *
     * @return void
     */
    public function itCanCreateModelOverHttp(string $class, string $storeRoute): void
    {
        $model = $this->makeModel($class);

        $response = $this->json(
            'POST',
            route($storeRoute),
            $model->toArray()
        );

        $response->assertStatus(201);
        $response->assertJsonFragment(
            $model->toArray()
        );
    }

    /**
     * @param array $data
     * @param string $storeRoute
     * @param string $fieldToVerify
     *
     * @return void
     */
    public function itCanValidateOnCreateModelOverHttp(array $data, string $storeRoute, string $fieldToVerify = null): void
    {
        $response = $this->json(
            'POST',
            route($storeRoute),
            $data
        );

        $response->assertStatus(422);
        $response->assertSeeText(
            $fieldToVerify
        );
    }

    /**
     * @param array $data
     * @param string $storeRoute
     * @param string $fieldToVerify
     *
     * @return void
     */
    public function itCanValidateOnUpdateModelOverHttp(array $data, string $class, string $updateRoute, string $fieldToVerify = null): void
    {
        $model = $this->createModel($class);

        $response = $this->json(
            'PUT',
            route($updateRoute, $model->id),
            $data
        );

        $response->assertStatus(422);
        $response->assertSeeText(
            $fieldToVerify
        );
    }

    /**
     * @param string $class
     * @param BaseRepository $repository
     * @param string|null $fieldToVerify
     *
     * @return void
     */
    public function ItCanShowModel(string $class, BaseRepository $repository, string $fieldToVerify = null): void
    {
        $model = $this->createModel($class);
        /**
         * If no $fieldToVerify is passed, use the first attribute
        */
        if (!isset($fieldToVerify)) {
            $fieldToVerify = $this->getFirstAtribute($model);
        }

        $found = $repository->getById($model->id);

        $this->assertInstanceOf($class, $found);
        $this->assertEquals($found->$fieldToVerify, $model->$fieldToVerify);
    }

    /**
     * @param string $class
     * @param string $showRoute
     * @param string|null $fieldToVerify
     *
     * @return void
     */
    public function itCanShowModelOverHttp(string $class, string $showRoute, string $fieldToVerify = null): void
    {
        $model = $this->createModel($class);
        /**
         * If no $fieldToVerify is passed, use the first attribute
         */
        if (!isset($fieldToVerify)) {
            $fieldToVerify = $this->getFirstAtribute($model);
        }

        $response = $this->json(
            'GET',
            route($showRoute, $model->id)
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(
            [
                $fieldToVerify  => $model->$fieldToVerify
            ]
        );
    }

    /**
     * @param string $class
     * @param string $showRoute
     * @param string|null $fieldToVerify
     *
     * @return void
     */
    public function itCanShowSoftDeletedModelOverHttp(string $class, string $showRoute, string $fieldToVerify = null): void
    {
        $model = $this->createModel($class, [
            'deleted_at' => date("Y-m-d H:i:s")
        ]);

        /**
         * If no $fieldToVerify is passed, use the first attribute
         */
        if (!isset($fieldToVerify)) {
            $fieldToVerify = $this->getFirstAtribute($model);
        }

        $response = $this->json(
            'GET',
            route($showRoute, $model->id)
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(
            [
                $fieldToVerify  => $model->$fieldToVerify
            ]
        );
    }

    /**
     * @param string $class
     * @param BaseRepository $repository
     * @param string|null $fieldToUpdate
     *
     * @return void
     */
    public function itCanUpdateModel(string $class, BaseRepository $repository, string $fieldToUpdate = null): void
    {
        $model = $this->createModel($class);
        $field = $this->handleFieldToUpdate($fieldToUpdate, $model);

        $data = $this->makeModel($class)->only($field);
        $found = $repository->update($data, $model->id);

        $this->assertInstanceOf($class, $found);
        $this->assertEquals($data[$field], $found->$field);
    }

    /**
     * @param string $class
     * @param string $updateRoute
     * @param string|null $fieldToUpdate
     * @param string $value
     *
     * @return void
     */
    public function itCanUpdateModelOverHttp(string $class, string $updateRoute, string $fieldToUpdate = null, string $value = 'updated'): void
    {
        $model = $this->createModel($class);

        /**
         * If no $fieldToUpdate is passed, use the first attribute
         */
        if (!isset($fieldToUpdate)) {
            $fieldToUpdate = $this->getFirstAtribute($model);
        }

        $data = [
           $fieldToUpdate  => $value
        ];

        $response = $this->json(
            'PUT',
            route($updateRoute, $model->id),
            $data
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(
            [
                'id'             => $model->id,
                $fieldToUpdate   => $data[$fieldToUpdate]
            ]
        );
    }

    /**
     * @param string $class
     * @param BaseRepository $repository
     *
     * @return void
     */
    public function itCanSoftDeleteModel(string $class, BaseRepository $repository): void
    {
        $model = $this->createModel($class);
        $table = $model->getTable();
        $dates = $model->getDates();

        $deleted = $repository->delete($model->id);

        $fieldsToVerify = [
            'id', $this->getFirstAtribute($model)
        ];

        $this->assertTrue($deleted);
        $this->assertSoftDeleted($table, $model->only($fieldsToVerify));
    }

    /**
     * @param string $class
     * @param string $deleteRoute
     * @param string $showRoute
     *
     * @return void
     */
    public function itCanDeleteModelOverHttp(string $class, string $deleteRoute, string $showRoute): void
    {
        $model = $this->createModel($class);

        $response = $this->json(
            'DELETE',
            route($deleteRoute, $model->id)
        );

        $response->assertStatus(204);

        $response = $this->json(
            'GET',
            route($showRoute, $model->id)
        )->assertStatus(404);
    }

    public function itCantDeleteModelOverHttp(Model $model, string $deleteRoute, string $showRoute): void
    {
        $response = $this->json(
            'DELETE',
            route($deleteRoute, $model->id)
        );

        $response->assertStatus(422);
        $response->assertSee('cadastro de deficiente associado');
    }

    /**
     * @param string $class
     * @param BaseRepository $repository
     *
     * @return void
     */
    public function itCanRestoreModel(string $class, BaseRepository $repository): void
    {
        $model = $this->createModel($class);
        $model->delete();

        $restored = $repository->restore($model->id);

        $this->assertTrue($restored);
    }

    /**
     * @param string $class
     * @param string $restoreRoute
     *
     * @return void
     */
    public function itCanRestoreModelOverHttp(string $class, string $restoreRoute): void
    {
        $model = $this->createModel($class);
        $model->delete();

        $response = $this->json(
            'POST',
            route($restoreRoute, $model->id)
        );

        $response->assertStatus(200);
    }

    /**
     * @param string $class
     * @param BaseRepository $repository
     * @param int $registries
     * @param string|null $fieldToVerify
     *
     * @return void
     */
    public function itCanListModel(string $class, BaseRepository $repository, int $registries = 3, string $fieldToVerify = null): void
    {
        $records = $this->createModels($class, $registries);

        $field = $this->handleFieldToVerify($fieldToVerify, $records->first());

        $found = $repository->all();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $found);
        $this->assertEquals($found->pluck($field, 'id'), $records->pluck($field, 'id'));
    }


    /**
     * @param string $class
     * @param string $indexRoute
     * @param int $registries
     * @param string|null $fieldToVerify
     *
     * @return void
     */
    public function itCanListModelOverHttp(string $class, string $indexRoute, int $registries, string $fieldToVerify = null): void
    {
        $this->withoutMiddleware();

        $models = $this->createModels($class, $registries);

        /**
         * If no $fieldToVerify is passed, use the first attribute
         */
        if (!isset($fieldToVerify)) {
            $fieldToVerify = $this->getFirstAtribute($models[0]);
        }

        $response = $this->json(
            'GET',
            route($indexRoute)
        );

        $response->assertStatus(200);
        $response->assertJsonCount($registries, 'data'); // "{"data":[{"id":1,"name":"Sr...

        for ($i = 1; $i <= $registries; $i++) {
            $response->assertJsonFragment(
                [
                    $fieldToVerify => $models->find($i)->$fieldToVerify
                ]
            );
        }
    }

    /**
     * @param string $class
     * @param string $indexRoute
     * @param int $registries
     * @param string|null $fieldToVerify
     *
     * @return void
     */
    public function itCanListDeletedOnlyModelOverHttp(string $class, string $indexRoute, int $registries, string $fieldToVerify = null): void
    {
        $this->withoutMiddleware();

        $models = $this->createModels($class, $registries);
        $deletedRegistries = intdiv($registries, 2);

        /**
         * Delete records
         */
        for ($i = 1; $i <= $deletedRegistries; $i++) {
            $models->find($i)->delete();
        }

        /**
         * If no $fieldToVerify is passed, use the first attribute
         */
        if (!isset($fieldToVerify)) {
            $fieldToVerify = $this->getFirstAtribute($models[0]);
        }

        $response = $this->json(
            'GET',
            route($indexRoute) . '?trashed=true'
        );

        $response->assertStatus(200);
        $response->assertJsonCount($deletedRegistries, 'data'); // "{"data":[{"id":1,"name":"Sr...
    }


    /**
     * Private methods
     */

    /**
     * Return the first attribute for a given model
     * @param Model $model
     *
     * @return string
     */
    private function getFirstAtribute(Model $model): string
    {
        $attributes = $model->getAttributes();
        $firstAttribute = array_keys($attributes)[0];

        return $firstAttribute;
    }

    /**
     * @param string|null $fieldToVerify
     * @param Model $model
     *
     * @return string
     */
    private function handleFieldToVerify(?string $fieldToVerify, Model $model): string
    {
        /**
        * If no $fieldToVerify is passed, use the first attribute
        */
        if (!isset($fieldToVerify)) {
            $fieldToVerify = $this->getFirstAtribute($model);
        }

        return $fieldToVerify;
    }


    /**
     * @param string|null $fieldToUpdate
     * @param Model $model
     *
     * @return string
     */
    private function handleFieldToUpdate(?string $fieldToUpdate, Model $model): string
    {
        /**
        * If no $fieldToUpdate is passed, use the first attribute
        */
        if (!isset($fieldToUpdate)) {
            $fieldToUpdate = $this->getFirstAtribute($model);
        }

        return $fieldToUpdate;
    }
}
