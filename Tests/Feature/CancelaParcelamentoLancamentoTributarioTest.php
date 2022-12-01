<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class CancelaParcelamentoLancamentoTributarioTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/cancelaParcelaLancamentoTributario';

    public function test_cancelaParcelaLancamentoTributario_deve_dar_erro_validacao()
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

    public function test_cancelaParcelaLancamentoTributario_deve_retornar_erro_de_parcela_1_nao_cadastrada_no_sistema()
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
            'mensagem' => '<div class="mensagem_sistema">Lançamento: 2022/71741 Forma de Pagamento: 8/0-1 Parcela: 1 não cadastrado no sistema.</div>',
            'executado' => 'false',
        ]);
    }
}
