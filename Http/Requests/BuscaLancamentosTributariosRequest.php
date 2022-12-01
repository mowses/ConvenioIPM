<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscaLancamentosTributariosRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ano_lancamento' => [
                'required',
                'integer',
            ],
            'codigo_sub_receita' => [
                'required',
                'integer',
            ],
            'cpf_cnpj_pessoa' => [
                'required',
                'string',
            ],
            'cadastro' => [
                'present',
                'integer',
                'nullable',
            ],
            'identificador_proprio' => [
                'present',
                'string',
                'nullable',
            ],
            'detalhado' => [
                'boolean',
            ],
        ];
    }
}
