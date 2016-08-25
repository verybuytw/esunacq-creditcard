<?php

return [
    'creditcard' => [
        /**
         * MAC  string  HashKey
         */
        'hashkey' => 'JIASUUJE5I3LRFIJ6NVHXVA0LHLL0UUR',
        'options' => [
            /*
             * MID  string  length: 15  required    特店代碼
             * TID  string  length: 8   required    終端機代號      Note: 一般交易(EC000001),分期交易(EC000002)
             * ONO  string  length: 20  required    訂單編號        Note: 不可 包含【_】字元
             * TA   integer length: 10  required    交易金額
             * U    string  length: 60  required    回覆位址        Note: URL 不可包含 【#】、【?】及【&】字元
             * IC   string  length: 7   option      分期代碼        Note: 需由對方業務申請提供代碼
             * BPF  string  length: 1   option      銀行紅利折抵    Note: Y:使用 / N:不使用
             */
            'MID' => '8089016171',
            'TID' => 'EC000001',
            'ONO' => null,
            'TA' => 0,
            'U' => null,
        ],
    ],
];
