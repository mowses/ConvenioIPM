<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class BuscaDadosCarneTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/buscaDadosCarne';

    public function test_buscaDadosCarne_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'ano_lancamento' => 'The ano lancamento field is required.',
        ]);
    }

    public function test_buscaDadosCarne_deve_retornar_sucesso()
    {
        $response = $this->post(self::ENDPOINT, [
            'ano_lancamento' => 2022,
            'numero_lancamento' => '71741',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('item.0.numero_lancamento', '71741');
    }
}
