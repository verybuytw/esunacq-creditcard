<?php

namespace VeryBuy\Payment\EsunBank\Acq\Request;

trait RequestBuilderValidateTrait
{
    /**
     * @return RequestBuilder
     */
    public function validate()
    {
        /*
         * MID  string  length:15   merchant id,
         * TID  string  length:8    payment type,
         * ONO  string  length:20   order number,
         * TA   integer length:10   amount,
         * U    string  length:60   return url,
         */

        $config = $this->getConfig();

        if (strlen($config['MID']) < 1 or
            strlen($config['MID']) > 15) {
            $this->addError(sprintf(
                'MID need range in 1 to 15, length: %d',
                strlen($config['MID'])
            ));
        }

        if (strlen($config['ONO']) < 1 or
            strlen($config['ONO']) > 20) {
            $this->addError(sprintf(
                'ONO need range in 1 to 20, length: %d',
                strlen($config['ONO'])
            ));
        }

        if ($config['TA'] < 0 or
            $config['TA'] > (1e+10 - 1)) {
            $this->addError(sprintf(
                'TA need range in 0 to 9999999999, amount : %d',
                $config['TA']
            ));
        }

        if (strlen($config['U']) < 1 or
            strlen($config['U']) > 60) {
            $this->addError(sprintf(
                'U need range in 1 to 60, length: %d',
                strlen($config['U'])
            ));
        }

        return $this;
    }
}
