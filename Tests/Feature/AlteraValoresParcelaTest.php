<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class AlteraValoresParcelaTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/alteraValoresParcela';

    public function test_alteraValoresParcela_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'numero_lancamento' => 'The numero lancamento field is required.',
        ]);
    }

    public function test_alteraValoresParcela_deve_retornar_sucesso()
    {
        $response = $this->post(self::ENDPOINT, [
            'numero_lancamento' => '71741',
            'ano_lancamento' => 2022,
            'ano_forma_pagamento' => 0,
            'codigo_forma_pagamento' => 8,
            'sequencia_forma_pagamento' => 1,
            'parcela' => 0,
            'data_base_atualizacao' => '01/01/2022',
            'data_vencimento' => '01/01/2022',
            'tributos' => [
                [
                    'codigo_tributo' => 31107,
                    'valor_tributo' => 11.99,
                    'valor_correcao' => 10.99,
                    'valor_multa' => 9.99,
                    'valor_juros' => 8.99,
                    'valor_juros_parcelamento' => 7.99,
                ],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'mensagem' => 'Alterações da parcela inseridas com sucesso!',
            'executado' => 'true',
        ]);
    }
}
