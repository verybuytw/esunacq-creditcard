<?php

namespace VeryBuy\Payment\EsunBank\Acq\Response;

trait ResponseBuilderInstallmentTrait
{
    /**
     * @return boolean
     */
    public function hasInstallment()
    {
        $response = $this->getResponse();

        return (
            array_key_exists('ITA', $response) and
            array_key_exists('IP', $response) and
            array_key_exists('IPA', $response) and
            array_key_exists('IFPA', $response)
        );
    }
}
