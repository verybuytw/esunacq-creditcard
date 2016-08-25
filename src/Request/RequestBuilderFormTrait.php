<?php

namespace VeryBuy\Payment\EsunBank\Acq\Request;

use Closure;

trait RequestBuilderFormTrait
{
    /**
     * @return array
     */
    protected function getParams()
    {
        $params = $this->config;

        if ($this->installment) {
            $params['IC'] = $this->installment;
        }

        if (!is_null($this->bonus)) {
            $params['BPF'] = $this->bonus ? 'Y' : 'N';
        }

        return $params;
    }

    /**
     * @return array|Closure
     */
    public function getFormFields(Closure $next = null)
    {
        $params = json_encode($this->getParams());

        $fields = [
            'data' => $params,
            'mac' => static::encrypt($params),
            'ksn' => 1,
        ];

        return is_callable($next) ? $next($fields) : $fields;
    }
}
