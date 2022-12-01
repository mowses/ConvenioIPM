<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelaReparcelamentoLancamentoTributarioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ano_reparcelamento' => [
                'required',
                'integer',
            ],
            'numero_reparcelamento' => [
                'required',
                'integer',
            ],
        ];
    }
}
