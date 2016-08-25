<?php

namespace VeryBuy\Payment\EsunBank\Acq\Response;

trait ResponseBuilderParseTrait
{
    /**
     * @param array
     *
     * @return array
     */
    protected function parse($raw)
    {
        $data = $raw['DATA'];

        $fields = explode(',', $data);

        $parsed = [];

        foreach ($fields as $field) {
            list($index, $value) = explode('=', $field);

            $parsed[$index] = $value;
        }

        if (array_key_exists('MACD', $raw)) {
            $parsed['MACD'] = $raw['MACD'];
        }

        return $parsed;
    }
}
