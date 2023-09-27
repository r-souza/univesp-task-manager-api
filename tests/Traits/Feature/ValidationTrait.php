<?php

namespace Tests\Traits\Feature;

use Illuminate\Support\Str;
use Tests\Traits\CommonTrait;

trait ValidationTrait
{
    use CommonTrait;
    /**
     * It Can Check Size Validation Fields
     *
     * @param string $class
     * @param array $fields
     * @param string $route
     * @param boolean $updating
     * @return void
     */
    public function itCanCheckSizeValidationFields(string $class, array $fields, string $route, bool $updating = false): void
    {
        foreach ($fields as $field => $size) {
            $data = $this->makeModel($class, [
                $field => $this->faker->text($size + 100)
            ])->toArray();

            if ($updating) {
                $this->itCanValidateOnUpdateModelOverHttp($data, $class, $route, $field);
            } else {
                $this->itCanValidateOnCreateModelOverHttp($data, $route, $field);
            }

        }
    }

    /**
     * It Can Check Min Validation Fields
     *
     * @param string $class
     * @param array $fields
     * @param string $route
     * @param boolean $updating
     * @return void
     */
    public function itCanCheckMinValidationFields(string $class, array $fields, string $route, bool $updating = false): void
    {
        foreach ($fields as $field => $size) {
            $data = $this->makeModel($class, [
                $field => Str::random($size - 1)
            ])->toArray();

            if ($updating) {
                $this->itCanValidateOnUpdateModelOverHttp($data, $class, $route, $field);
            } else {
                $this->itCanValidateOnCreateModelOverHttp($data, $route, $field);
            }
        }
    }

    /**
     * It Can Check Max Validation Fields
     *
     * @param string $class
     * @param array $fields
     * @param string $route
     * @param boolean $updating
     * @return void
     */
    public function itCanCheckMaxValidationFields(string $class, array $fields, string $route, $updating = false): void
    {
        foreach ($fields as $field => $size) {
            $data = $this->makeModel($class, [
                $field => Str::random($size + 1)
            ])->toArray();

            if ($updating) {
                $this->itCanValidateOnUpdateModelOverHttp($data, $class, $route, $field);
            } else {
                $this->itCanValidateOnCreateModelOverHttp($data, $route, $field);
            }
        }
    }

    /**
     * It Can Check Required Validation Fields
     *
     * @param string $class
     * @param array $fields
     * @param string $route
     * @param boolean $updating
     * @return void
     */
    public function itCanCheckRequiredValidationFields(string $class, array $fields, string $route, bool $updating = false): void
    {
        foreach ($fields as $field) {
            $data = $this->makeModel($class)->toArray();
            $data[$field] = '';

            if ($updating) {
                $this->itCanValidateOnUpdateModelOverHttp($data, $class, $route, $field);
            } else {
                $this->itCanValidateOnCreateModelOverHttp($data, $route, $field);
            }
        }
    }

    /**
     * It Can Check Unique Validation Fields
     *
     * @param string $class
     * @param array $fields
     * @param string $route
     * @param boolean $updating
     * @return void
     */
    public function itCanCheckUniqueValidationFields(string $class, array $fields, string $route, bool $updating = false): void
    {
        foreach ($fields as $field) {
            $model = $this->createModel($class);
            $data = $this->makeModel($class)->toArray();
            $data[$field] = $model->$field;

            if ($updating) {
                $this->itCanValidateOnUpdateModelOverHttp($data, $class, $route, $field);
            } else {
                $this->itCanValidateOnCreateModelOverHttp($data, $route, $field);
            }
        }
    }
}
