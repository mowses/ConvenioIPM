<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class CancelaReparcelamentoLancamentoTributarioTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/cancelaReparcelamentoLancamentoTributario';

    public function test_cancelaReparcelamentoLancamentoTributario_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'ano_reparcelamento' => 'The ano reparcelamento field is required.',
            'numero_reparcelamento' => 'The numero reparcelamento field is required.',
        ]);
    }

    public function test_cancelaReparcelamentoLancamentoTributario_deve_retornar_erro_de_reparcelamento_nao_existe()
    {
        $response = $this->post(self::ENDPOINT, [
            'ano_reparcelamento' => 2022,
            'numero_reparcelamento' => 1,
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('item.codigo', 'WGT-000719');
        $response->assertJsonPath('item.descricao', 'O Reparcelamento não existe.');
    }
}
