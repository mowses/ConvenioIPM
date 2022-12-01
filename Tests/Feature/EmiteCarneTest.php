<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class EmiteCarneTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/emiteCarne';

    public function test_emiteCarne_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'ano_lancamento' => 'The ano lancamento field is required.',
        ]);
    }

    public function test_emiteCarne_deve_retornar_fault()
    {
        $response = $this->post(self::ENDPOINT, [
            'ano_lancamento' => 2022,
            'ano_forma_pagamento' => null,
            'codigo_forma_pagamento' => null,
            'sequencia_forma_pagamento' => null,
            'numero_lancamento' => 1,
            'parcela' => null,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'faultcode' => 'WGT-000855',
            'faultstring' => 'Não foram encontrados lançamentos para os filtros informados.',
        ]);
    }

    public function test_emiteCarne_deve_retornar_sucesso()
    {
        $response = $this->post(self::ENDPOINT, [
            'ano_lancamento' => 2022,
            'ano_forma_pagamento' => null,
            'codigo_forma_pagamento' => null,
            'sequencia_forma_pagamento' => null,
            'numero_lancamento' => '71741',
            'parcela' => null,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['carne']);
    }
}
