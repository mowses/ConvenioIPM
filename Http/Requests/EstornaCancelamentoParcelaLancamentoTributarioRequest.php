<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstornaCancelamentoParcelaLancamentoTributarioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'numero_lancamento' => [
                'required',
                'integer',
            ],
            'ano_lancamento' => [
                'required',
                'integer',
            ],
            'ano_forma_pagamento' => [
                'required',
                'integer',
            ],
            'codigo_forma_pagamento' => [
                'required',
                'integer',
            ],
            'sequencia_forma_pagamento' => [
                'required',
                'integer',
            ],
            'parcela' => [
                'required',
                'integer',
            ],
        ];
    }
}
