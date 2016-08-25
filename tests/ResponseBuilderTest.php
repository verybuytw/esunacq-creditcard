<?php

namespace Tests\Payment\EsunBank\Acq;

use VeryBuy\Payment\EsunBank\Acq\Response\ResponseBuilder;

class ResponseBuilderTest extends AbstractTestCase
{
    protected $responseStub = [
        'DATA' => 'RC=00,MID=8089016171,ONO=TEST1471162266,LTD=20160814,LTT=161132,RRN=046227000001,AIR=997410,AN=552199******1898',
        'MACD' => '9447ef4f7401be44ffbd7ac806725e4e874d5d8a2fad0f61f5d196f1ee08eedc'
    ];

    public function testEsunBankAcqConfig()
    {
        $this->assertArrayHasKey('creditcard', config('esunacq'));

        $creditcard = config('esunacq.creditcard');

        $this->assertArrayHasKey('hashkey', $creditcard);
        $this->assertArrayHasKey('options', $creditcard);
        $this->assertArrayHasKey('MID', $creditcard['options']);
    }

    public function testResponseBuilder()
    {
        $builder = new ResponseBuilder(
            config('esunacq.creditcard.hashkey'),
            [
                'MID' => config('esunacq.creditcard.options.MID')
            ],
            $this->responseStub
        );

        $this->assertTrue(is_bool($builder->isSuccess()));
    }
}
