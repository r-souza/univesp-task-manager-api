<?php

namespace Tests\Traits\Feature;

trait ValidationTrait
{
    use CommonValidationTrait;
    /**
     *
     * @return void
     */
    public function testItCanValidateStoreRequest(): void
    {
        $this->withoutMiddleware();
        $route = $this->getRoute('store');

        /**
         * Validate fields with required rule
         */
        $this->checkRequiredRule($route);

        /**
         * Validate fields with size rule
         */
        $this->checkSizeRule($route);

        /**
         * Validate fields with min rule
         */
        $this->checkMinRule($route);

        /**
         * Validate fields with max rule
         */
        $this->checkMaxRule($route);

        /**
         * Validate fields with unique rule
         */
        $this->checkUniqueRule($route);
    }

    /**
     *
     * @return void
     */
    public function testItCanValidateUpdateRequest(): void
    {
        $this->withoutMiddleware();
        $route = $this->getRoute('update');

        /**
         * Validate fields with required rule
         */
        $this->checkRequiredRule($route, true);

        /**
         * Validate fields with size rule
         */
        $this->checkSizeRule($route, true);

        /**
         * Validate fields with min rule
         */
        $this->checkMinRule($route, true);

        /**
         * Validate fields with max rule
         */
        $this->checkMaxRule($route, true);

        /**
         * Validate fields with unique rule
         */
        $this->checkUniqueRule($route, true);
    }

    /**
     * Validate fields with required rule
     *
     * @param string $route
     * @param boolean $updating
     * @return void
     */
    private function checkRequiredRule(string $route, $updating = false): void
    {
        if (isset($this->requiredValidationFields)) {
            $this->itCanCheckRequiredValidationFields($this->modelClass, $this->requiredValidationFields, $route, $updating);
        }
    }

    /**
     * Validate fields with unique rule
     *
     * @param string $route
     * @param boolean $updating
     * @return void
     */
    private function checkUniqueRule(string $route, $updating = false): void
    {
        if (isset($this->uniqueValidationFields)) {
            $this->itCanCheckUniqueValidationFields($this->modelClass, $this->uniqueValidationFields, $route, $updating);
        }
    }

    /**
    * Validate fields with size rule
    *
    * @param string $route
    * @param boolean $updating
    * @return void
    */
    private function checkSizeRule(string $route, $updating = false): void
    {
        if (isset($this->sizeValidationFields)) {
            $this->itCanCheckSizeValidationFields($this->modelClass, $this->sizeValidationFields, $route, $updating);
        }
    }

    /**
    *  Validate fields with min rule
    *
    * @param string $route
    * @param boolean $updating
    * @return void
    */
    private function checkMinRule(string $route, $updating = false): void
    {
        if (isset($this->minValidationFields)) {
            $this->itCanCheckMinValidationFields($this->modelClass, $this->minValidationFields, $route, $updating);
        }
    }

    /**
     *  Validate fields with max rule
     *
     * @param string $route
     * @param boolean $updating
     * @return void
     */
    private function checkMaxRule(string $route, $updating = false): void
    {
        if (isset($this->maxValidationFields)) {
            $this->itCanCheckMaxValidationFields($this->modelClass, $this->maxValidationFields, $route, $updating);
        }
    }

}
