<?php

namespace VeryBuy\Payment\EsunBank\Acq\Response;

use Carbon\Carbon;
use VeryBuy\Payment\EsunBank\Acq\BuilderConfigTrait;
use VeryBuy\Payment\EsunBank\Acq\BuilderHashKeyTrait;
use VeryBuy\Payment\EsunBank\Acq\VerifyInterface;

class ResponseBuilder extends ResponseBuilderContract implements VerifyInterface
{
    use BuilderConfigTrait,
        BuilderHashKeyTrait,
        ResponseBuilderBonusTrait,
        ResponseBuilderErrorTrait,
        ResponseBuilderInstallmentTrait,
        ResponseBuilderParseTrait,
        ResponseBuilderRawDataTrait,
        ResponseBuilderVerifyTrait;

    /**
     * @param string $hashKey
     * @param array  $config
     * @param array  $raw
     */
    public function __construct($hashKey, array $config, array $raw = [])
    {
        $this->setHashKey($hashKey)
            ->setConfig($config);

        if (!empty($raw)) {
            $this->setRawData($raw);
        }
    }

    public function isSuccess($strict = false)
    {
        $raw = $this->getRawData();

        if ($strict and array_key_exists('MACD', $raw)) {
            return static::verify($raw['MACD']);
        }

        return $this->response['RC'] == ResponseInterface::STATUS_SUCCESS;
    }

    public function getOrderNumber()
    {
        return $this->response['ONO'];
    }

    public function getTradeTime($format = 'Y-m-d H:i:s')
    {
        if (!array_key_exists('LTD', $this->response) or !array_key_exists('LTT', $this->response)) {
            throw new CreditCardException('Response args LTT or LTD not exists.');
        }

        $timestamp = strtotime(strtr('{Ymd}{time}', [
            '{Ymd}' => $this->response['LTD'],
            '{time}' => $this->response['LTT'],
        ]));

        return Carbon::createFromTimestamp($timestamp)->format($format);
    }
}
