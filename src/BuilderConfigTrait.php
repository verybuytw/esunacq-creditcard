<?php

namespace VeryBuy\Payment\EsunBank\Acq;

trait BuilderConfigTrait
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @param array $config
     *
     * @return static::class
     */
    public function setConfig(array $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}
