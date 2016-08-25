Installation
-------------

### Use RequestBuilder generate form for esunacq creditcard


```php
<?php

    use VeryBuy\Payment\EsunBank\Acq\Request\RequestBuilder;

    $builder = new RequestBuilder($MAC, [
        'ONO' => 'TEST1234567890',      //  訂單編號
        'TA' => 1200,                   //  金額
        'MID' => '',                    //  特店代碼
        'TID' => 'EC000001',            //  刷卡代碼
        'U' => 'path/to/response',      //  回傳 URL
    ]);

    if (! $builder->validate()->hasErrors()) {
        // $formFields 組成 html form 後送出即可
        $formFields = $builder->getFormFields();
    } else {
        $errors = builder->getErrors(); // return array
    }
```

### Use ResponseBuilder verify response

```php
<?php

    use VeryBuy\Payment\EsunBank\Acq\Response\ResponseBuilder;

    $builder = new ResponseBuilder($MAC, [
        'MID' => '',
    ], $_REQUEST);

    if (! $builder->isSuccess()) {
        $builder->getError();
    }
```