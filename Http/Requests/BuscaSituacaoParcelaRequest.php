<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscaSituacaoParcelaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'buscasituacaoparcela' => [
                'required',
                'array',
            ],
            'buscasituacaoparcela.numero_lancamento' => [
                'required',
                'integer',
            ],
            'buscasituacaoparcela.ano_lancamento' => [
                'required',
                'integer',
            ],
            'buscasituacaoparcela.ano_forma_pagamento' => [
                'required',
                'integer',
            ],
            'buscasituacaoparcela.codigo_forma_pagamento' => [
                'required',
                'integer',
            ],
            'buscasituacaoparcela.sequencia_forma_pagamento' => [
                'required',
                'integer',
            ],
            'buscasituacaoparcela.parcela' => [
                'required',
                'integer',
            ],
        ];
    }
}
