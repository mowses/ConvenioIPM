<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetPessoaBasicoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'FiltroCodigoInicial' => [
                'required',
                'integer',
                'lt:FiltroCodigoFinal',
            ],
            'FiltroCodigoFinal' => [
                'required',
                'integer',
                'gt:FiltroCodigoInicial',
            ],
        ];
    }
}
