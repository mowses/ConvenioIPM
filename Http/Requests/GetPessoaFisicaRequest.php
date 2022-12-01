<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetPessoaFisicaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'cpf' => [
                'required',
                'string',
            ],
        ];
    }
}
