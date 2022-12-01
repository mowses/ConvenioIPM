<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculoTributarioIndividualRequest extends FormRequest
{
    public function rules()
    {
        return [
            'identificador_proprio' => [
                'integer',
            ],
            'ano_calculo' => [
                'required',
                'integer',
            ],
            'data_base_calculo' => [
                'required',
                'date',
            ],
            'codigo_sub_receita' => [
                'required',
                'integer',
            ],
            'cpfcnpj' => [
                'string',
            ],
            'contribuinte' => [
                'required',
                'string',
            ],
            'cadastro_imobiliario' => [
                'integer',
            ],
            'cadastro_economico' => [
                'integer',
            ],
            'numero_convenio' => [
                'integer',
            ],
            'observacao' => [
                'string',
            ],
            'nao_gera_carne' => [
                'boolean',
            ],
            'parametros_calculo' => [
                'array',
            ],
            'parametros_calculo.*.parametro.*.codigo_bloco' => [
                'integer',
            ],
            'parametros_calculo.*.parametro.*.codigo_item' => [
                'integer',
            ],
            'parametros_calculo.*.parametro.*.sequencia_item' => [
                'integer',
            ],
            'parametros_calculo.*.parametro.*.valor' => [
                'string',
            ],
            'parametros_calculo.*.parametro.*.valor_lista' => [
                'integer',
            ],
            'formas_pagamento' => [
                'required',
                'array',
            ],
            'formas_pagamento.*.ano_forma_pagamento' => [
                'required',
                'integer',
            ],
            'formas_pagamento.*.codigo_forma_pagamento' => [
                'required',
                'integer',
            ],
            'formas_pagamento.*.quantidade_parcelas' => [
                'required',
                'integer',
            ],
            'formas_pagamento.*.competencia_inicial' => [
                'integer',
            ],
            'formas_pagamento.*.competencia_final' => [
                'integer',
            ],
            'formas_pagamento.*.data_base_vencimento' => [
                'required',
                'date',
            ],
            'formas_pagamento.*.principal' => [
                'boolean',
            ],
        ];
    }
}
