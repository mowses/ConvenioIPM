<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmiteCarneRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ano_lancamento' => [
                'required',
                'integer',
            ],
            'numero_lancamento' => [
                'required',
                'integer',
            ],
            'ano_forma_pagamento' => [
                'present',
                'integer',
                'nullable',
            ],
            'codigo_forma_pagamento' => [
                'present',
                'integer',
                'nullable',
            ],
            'sequencia_forma_pagamento' => [
                'present',
                'integer',
                'nullable',
            ],
            'parcela' => [
                'present',
                'integer',
                'nullable',
            ],
        ];
    }
}
