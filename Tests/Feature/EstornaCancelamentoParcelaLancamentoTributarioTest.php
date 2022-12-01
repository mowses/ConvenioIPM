<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class EstornaCancelamentoParcelaLancamentoTributarioTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/estornaCancelamentoParcelaLancamentoTributario';

    public function test_estornaCancelamentoParcelaLancamentoTributario_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'numero_lancamento' => 'The numero lancamento field is required.',
            'ano_lancamento' => 'The ano lancamento field is required.',
            'ano_forma_pagamento' => 'The ano forma pagamento field is required.',
            'codigo_forma_pagamento' => 'The codigo forma pagamento field is required.',
            'sequencia_forma_pagamento' => 'The sequencia forma pagamento field is required.',
            'parcela' => 'The parcela field is required.',
        ]);
    }

    public function test_estornaCancelamentoParcelaLancamentoTributario_deve_retornar_mensagem_de_nenhuma_parcela_encontrada()
    {
        $response = $this->post(self::ENDPOINT, [
            'numero_lancamento' => 71741,
            'ano_lancamento' => 2022,
            'ano_forma_pagamento' => 0,
            'codigo_forma_pagamento' => 8,
            'sequencia_forma_pagamento' => 1,
            'parcela' => 1,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'mensagem' => 'Nenhuma parcela encontrada para os dados informados.',
            'executado' => 'false',
        ]);
    }
}
