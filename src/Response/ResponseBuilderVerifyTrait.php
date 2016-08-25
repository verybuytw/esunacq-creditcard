<?php

namespace VeryBuy\Payment\EsunBank\Acq\Response;

trait ResponseBuilderVerifyTrait
{
    /**
     * @param string
     *
     * @return bool
     */
    public function verify($encrypted)
    {
        $raw = $this->getRawData();

        return ($encrypted == static::encrypt($raw['DATA']));
    }

    /**
     * @param string
     *
     * @return string
     */
    public function encrypt($data)
    {
        return hash('sha256', strtr('{data},{hash}', [
            '{data}' => $data,
            '{hash}' => static::getHashKey(),
        ]));
    }
}
