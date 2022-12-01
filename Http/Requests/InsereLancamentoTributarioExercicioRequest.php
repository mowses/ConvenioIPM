<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsereLancamentoTributarioExercicioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'lancamentos' => [
                'required',
                'array',
            ],
            'lancamentos.*.identificador_proprio' => [
                'integer',
            ],
            'lancamentos.*.cpf_cnpj_pessoa' => [
                'required',
                'string',
            ],
            'lancamentos.*.codigo_sub_receita' => [
                'required',
                'integer',
            ],
            'lancamentos.*.codigo_moeda' => [
                'integer',
            ],
            'lancamentos.*.cadastro' => [
                'integer',
            ],
            'lancamentos.*.ano_lancamento' => [
                'required',
                'integer',
            ],
            'lancamentos.*.data_base_calculo' => [
                'required',
                'date',
            ],
            'lancamentos.*.observacao' => [
                'string',
            ],
            'lancamentos.*.formas_pagamento' => [
                'required',
                'array',
            ],
            'lancamentos.*.formas_pagamento.*.ano' => [
                'required',
                'integer',
            ],
            'lancamentos.*.formas_pagamento.*.codigo' => [
                'required',
                'integer',
            ],
            'lancamentos.*.formas_pagamento.*.situacao' => [
                'required',
                'integer',
            ],
            'lancamentos.*.formas_pagamento.*.quantidade_parcelas' => [
                'required',
                'integer',
            ],
            'lancamentos.*.formas_pagamento.*.observacaofp' => [
                'string',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas' => [
                'required',
                'array',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas.*.parcela' => [
                'required',
                'integer',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas.*.tipo_parcela' => [
                'required',
                'integer',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas.*.data_vencimento' => [
                'required',
                'date',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas.*.ano_competencia' => [
                'integer',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas.*.nro_competencia' => [
                'integer',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas.*.observacaoparc' => [
                'string',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas.*.tributos' => [
                'required',
                'array',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas.*.tributos.*.codigo_tributo' => [
                'required',
                'integer',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas.*.tributos.*.enquadramento' => [
                'required',
                'integer',
            ],
            'lancamentos.*.formas_pagamento.*.parcelas.*.tributos.*.valor_tributo_original' => [
                'required',
                'numeric',
            ],
        ];
    }
}
