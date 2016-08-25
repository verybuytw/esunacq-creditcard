<?php

namespace VeryBuy\Payment\EsunBank\Acq\Response;

trait ResponseBuilderBonusTrait
{
    /**
     * @return boolean
     */
    public function hasBonus()
    {
        $response = $this->getResponse();

        return (
            array_key_exists('BB', $response) and
            array_key_exists('BRP', $response) and
            array_key_exists('BRA', $response)
        );
    }
}
