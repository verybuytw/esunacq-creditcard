<?php

namespace VeryBuy\Payment\EsunBank\Acq;

interface ErrorInterface
{
    public function hasErrors();
    public function getErrors();
    public function addError($error);
}
