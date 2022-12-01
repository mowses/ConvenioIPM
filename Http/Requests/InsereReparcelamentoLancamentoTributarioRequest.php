<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsereReparcelamentoLancamentoTributarioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'cpf_cnpj_pessoa' => [
                'required',
                'string',
            ],
            'ano_forma_pagamento' => [
                'required',
                'integer',
            ],
            'codigo_forma_pagamento' => [
                'required',
                'integer',
            ],
            'data_base' => [
                'required',
                'date',
            ],
            'ano_parcelamento' => [
                'required',
                'integer',
            ],
            'observacao' => [
                'string',
            ],
            'quantidade_parcelas' => [
                'required',
                'integer',
            ],
            'origens' => [
                'required',
                'array',
            ],
            'origens.*.ano_lancamento' => [
                'required',
                'integer',
            ],
            'origens.*.numero_lancamento' => [
                'required',
                'integer',
            ],
            'origens.*.parcela' => [
                'required',
                'integer',
            ],
            'parcelas' => [
                'required',
                'array',
            ],
            'parcelas.*.parcela' => [
                'required',
                'integer',
            ],
            'parcelas.*.tipo_parcela' => [
                'required',
                'integer',
            ],
            'parcelas.*.data_vencimento' => [
                'required',
                'date',
            ],
            'parcelas.*.ano_competencia' => [
                'integer',
            ],
            'parcelas.*.mes_competencia' => [
                'integer',
            ],
            'parcelas.*.observacao' => [
                'string',
            ],
            'parcelas.*.tributos' => [
                'required',
                'array',
            ],
            'parcelas.*.tributos.*.codigo' => [
                'required',
                'integer',
            ],
            'parcelas.*.tributos.*.enquadramento' => [
                'required',
                'integer',
            ],
            'parcelas.*.tributos.*.valor_tributo_original' => [
                'required',
                'numeric',
            ],
            'parcelas.*.tributos.*.valor_correcao_original' => [
                'required',
                'numeric',
            ],
            'parcelas.*.tributos.*.valor_multa_original' => [
                'required',
                'numeric',
            ],
            'parcelas.*.tributos.*.valor_juros_original' => [
                'required',
                'numeric',
            ],
            'parcelas.*.tributos.*.valor_juros_parcelamento_original' => [
                'required',
                'numeric',
            ],
        ];
    }
}
