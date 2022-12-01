<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlteraValoresParcelaRequest extends FormRequest
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
            'data_base_atualizacao' => [
                'required',
                'date',
            ],
            'data_vencimento' => [
                'required',
                'date',
            ],
            'tributos' => [
                'required',
                'array',
            ],
            'tributos.*.codigo_tributo' => [
                'required',
                'integer',
            ],
            'tributos.*.valor_tributo' => [
                'numeric',
            ],
            'tributos.*.valor_correcao' => [
                'numeric',
            ],
            'tributos.*.valor_multa' => [
                'numeric',
            ],
            'tributos.*.valor_juros' => [
                'numeric',
            ],
            'tributos.*.valor_juros_parcelamento' => [
                'numeric',
            ],
        ];
    }
}
