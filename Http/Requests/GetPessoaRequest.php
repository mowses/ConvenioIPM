<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetPessoaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'cpfCnpj' => [
                'required',
                'string',
            ],
            'nomeRazao' => [
                'present',
                'nullable',
                'string',
            ],
        ];
    }
}
