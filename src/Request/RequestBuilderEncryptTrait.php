<?php

namespace VeryBuy\Payment\EsunBank\Acq\Request;

trait RequestBuilderEncryptTrait
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function encrypt($data)
    {
        return hash('sha256', $data.static::getHashKey());
    }
}
