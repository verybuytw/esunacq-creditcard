<?php

namespace Tests\Payment\EsunBank\Acq;

use VeryBuy\Payment\EsunBank\Acq\Request\RequestBuilder;
use VeryBuy\Payment\EsunBank\Acq\Request\RequestInterface;

class RequestBuilderTest extends AbstractTestCase
{
    protected $requestStub = [
        'ONO' => 'TESTORDERNUMBER00001',
        'TA' => 300,
        'U' => 'https://domain.com/esunacq/creditcard/response'
    ];

    public function testEsunBankAcqConfig()
    {
        $this->assertArrayHasKey('creditcard', config('esunacq'));

        $creditcard = config('esunacq.creditcard');

        $this->assertArrayHasKey('hashkey', $creditcard);
        $this->assertArrayHasKey('options', $creditcard);
    }

    public function testRequestBuilder()
    {

        $builder = new RequestBuilder(
            config('esunacq.creditcard.hashkey'),
            array_merge(config('esunacq.creditcard.options'), $this->requestStub)
        );

        $this->assertFalse($builder->validate()->hasErrors());
    }

    public function testRequestBuilderWithInstallment()
    {
        $builder = new RequestBuilder(
            config('esunacq.creditcard.hashkey'),
            array_merge(config('esunacq.creditcard.options'), $this->requestStub),
            RequestInterface::TYPE_GENERAL
        );

        $this->assertFalse($builder->validate()->hasErrors());

        $data = $builder->getFormFields(function($fields) {
            return json_decode($fields['data'], true);
        });

        $this->assertArrayHasKey('IC', $data);
    }

    public function testRequestBuilderWithInstallmentAndBonus()
    {
        $builder = new RequestBuilder(
            config('esunacq.creditcard.hashkey'),
            array_merge(config('esunacq.creditcard.options'), $this->requestStub),
            RequestInterface::TYPE_GENERAL,
            true
        );

        $this->assertFalse($builder->validate()->hasErrors());

        $data = $builder->getFormFields(function($fields) {
            return json_decode($fields['data'], true);
        });

        $this->assertArrayHasKey('BPF', $data);
    }
}
