<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscaDadosCarneRequest extends FormRequest
{
    public function rules()
    {
        return [
            'banco_codigo' => [
                'integer',
            ],
            'convenio_numero' => [
                'integer',
            ],
            'ano_lancamento' => [
                'required',
                'integer',
            ],
            'numero_lancamento' => [
                'required',
                'string',
            ],
            'ano_parcelamento' => [
                'integer',
            ],
            'numero_parcelamento' => [
                'integer',
            ],
            'nosso_numero_formatado' => [
                'string',
            ],
            'vencimento_carne' => [
                'date',
            ],
            'identificador_pix' => [
                'string',
            ],
            'link_qrcode_pix' => [
                'string',
            ],
        ];
    }
}
