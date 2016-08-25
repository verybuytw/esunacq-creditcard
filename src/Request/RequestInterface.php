<?php

namespace VeryBuy\Payment\EsunBank\Acq\Request;

interface RequestInterface
{
    const TYPE_GENERAL = 'EC000001';
    const TYPE_INSTALLMENT = 'EC000002';
}
