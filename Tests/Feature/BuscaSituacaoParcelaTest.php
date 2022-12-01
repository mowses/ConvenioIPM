<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class BuscaSituacaoParcelaTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/buscaSituacaoParcela';

    public function test_buscaSituacaoParcela_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'buscasituacaoparcela' => 'The buscasituacaoparcela field is required.',
        ]);
    }

    public function test_buscaSituacaoParcela_deve_retornar_sucesso()
    {
        $response = $this->post(self::ENDPOINT, [
            'buscasituacaoparcela' => [
                'numero_lancamento' => '71741',
                'ano_lancamento' => 2022,
                'ano_forma_pagamento' => 0,
                'codigo_forma_pagamento' => 8,
                'sequencia_forma_pagamento' => 1,
                'parcela' => 0,
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('item.numero_lancamento', '71741');
    }
}
