<?php

namespace VeryBuy\Payment\EsunBank\Acq\Response;

trait ResponseBuilderRawDataTrait
{
    /**
     * @var array
     */
    protected $response = [];

    /**
     * @var array
     */
    protected $raw = [];

    /**
     * @params array $raw
     * 
     * @return static::class
     */
    public function setRawData($raw)
    {
        $this->raw = $raw;

        $this->response = $this->parse($raw);

        return $this;
    }

    /**
     * @return array
     */
    protected function getRawData()
    {
        return $this->raw;
    }

    /**
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }
}
