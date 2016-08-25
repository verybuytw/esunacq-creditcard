<?php

namespace VeryBuy\Payment\EsunBank\Acq\Request;

use Illuminate\Support\Collection;

trait RequestBuilderErrorTrait
{
    /**
     * @var Collection
     */
    protected $errors;

    /**
     * @return Collection
     */
    protected function registerErrorCollectoin()
    {
        return new Collection();
    }

    /**
     * @return EsunAcqBuilder
     */
    protected function initErrorCollectoin()
    {
        $this->errors = $this->registerErrorCollectoin();

        return $this;
    }

    /**
     * @return Collection
     */
    protected function getErrorCollection()
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return !$this->errors->isEmpty();
    }

    /**
     * @return Collection
     */
    public function getErrors()
    {
        return $this->getErrorCollection()->all();
    }

    /**
     * @param string $error
     *
     * @return EsunAcqBuilder
     */
    public function addError($error)
    {
        $this->getErrorCollection()->push($error);

        return $this;
    }
}
