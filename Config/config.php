<?php

return [

    'services' => [
        'WUNPessoa' => [
            'endpoint' => env('CONVENIO_IPM_WUNPESSOA_ENDPOINT'),
            'username' => env('CONVENIO_IPM_WUNPESSOA_USERNAME'),
            'password' => env('CONVENIO_IPM_WUNPESSOA_PASSWORD'),
        ],

        'WGTLancamentoTributario' => [
            'endpoint' => env('CONVENIO_IPM_WGT_LANCAMENTO_TRIBUTARIO_ENDPOINT'),
            'username' => env('CONVENIO_IPM_WGT_LANCAMENTO_TRIBUTARIO_USERNAME'),
            'password' => env('CONVENIO_IPM_WGT_LANCAMENTO_TRIBUTARIO_PASSWORD'),
        ],
    ]
];
