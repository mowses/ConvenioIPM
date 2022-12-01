<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class GetPessoaBasicoTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/getPessoaBasico';

    public function test_getPessoaBasico_deve_retornar_mensagem_de_nenhum_resultado_quando_nao_encontrado_nenhum_registro()
    {
        $response = $this->post(self::ENDPOINT, [
            'FiltroCodigoInicial' => 0,
            'FiltroCodigoFinal' => 1,
        ]);

        $this->assertStringContainsString('nenhum resultado', $response->content());
    }

    public function test_getPessoaBasico_deve_retornar_10_registros_quando_inicial_0_e_final_100()
    {
        $response = $this->post(self::ENDPOINT, [
            'FiltroCodigoInicial' => 0,
            'FiltroCodigoFinal' => 100,
        ]);

        $response->assertJsonCount(10, 'item');
    }
}
