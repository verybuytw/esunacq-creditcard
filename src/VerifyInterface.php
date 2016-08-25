<?php

namespace VeryBuy\Payment\EsunBank\Acq;

interface VerifyInterface
{
    public function verify($encrypted);
    public function encrypt($data);
}
