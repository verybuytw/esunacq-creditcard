<?php

namespace VeryBuy\Payment\EsunBank\Acq\Request;

use VeryBuy\Payment\EsunBank\Acq\BuilderConfigTrait;
use VeryBuy\Payment\EsunBank\Acq\BuilderHashKeyTrait;
use VeryBuy\Payment\EsunBank\Acq\EncryptInterface;
use VeryBuy\Payment\EsunBank\Acq\ErrorInterface;
use VeryBuy\Payment\EsunBank\Acq\ValidateInterface;

class RequestBuilder extends RequestBuilderContract implements EncryptInterface, ErrorInterface, ValidateInterface
{
    use BuilderConfigTrait,
        BuilderHashKeyTrait,
        RequestBuilderEncryptTrait,
        RequestBuilderFormTrait,
        RequestBuilderValidateTrait,
        RequestBuilderErrorTrait;

    /**
     * @var string IC
     */
    protected $installment;

    /**
     * @var bool BPF
     */
    protected $bonus;

    /**
     * @param string $hashKey
     * @param array  $config
     * @param string $installment
     * @param bool   $bonus
     */
    public function __construct($hashKey, array $config, $installment = null, $bonus = null)
    {
        $this->setHashKey($hashKey)
            ->setConfig($config);

        if (is_string($installment) and
            in_array($installment, [
                RequestInterface::TYPE_GENERAL,
                RequestInterface::TYPE_INSTALLMENT
            ])) {
            $this->setInstallment($installment);
        }

        if (is_bool($bonus)) {
            $this->setBonus($bonus);
        }

        $this->initErrorCollectoin();
    }

    /**
     * @param string $installment <ul><li>length: 7</li><li>分期代碼</li><li>IC</li></ul>
     *
     * @return EsunAcqBuilder
     */
    public function setInstallment($installment)
    {
        $this->installment = $installment;

        return $this;
    }

    /**
     * @param bool $bonus <ul><li>length: 1</li><li>銀行紅利折抵</li><li>BPF</li></ul>
     *
     * @return EsunAcqBuilder
     */
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;

        return $this;
    }
}
