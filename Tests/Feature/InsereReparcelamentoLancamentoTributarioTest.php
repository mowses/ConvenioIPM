<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class InsereReparcelamentoLancamentoTributarioTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/insereReparcelamentoLancamentoTributario';

    public function test_insereReparcelamentoLancamentoTributario_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'cpf_cnpj_pessoa' => 'The cpf cnpj pessoa field is required.',
        ]);
    }

    public function test_insereReparcelamentoLancamentoTributario_deve_retornar_erro_forma_pagto_nao_cadastrada()
    {
        $response = $this->post(self::ENDPOINT, [
            'cpf_cnpj_pessoa' => '009.145.819-61',
            'ano_forma_pagamento' => 0,
            'codigo_forma_pagamento' => 8,
            'data_base' => '01/01/2022',
            'ano_parcelamento' => 2022,
            'quantidade_parcelas' => 1,
            'origens' => [
                [
                    'ano_lancamento' => 2022,
                    'numero_lancamento' => '71741',
                    'parcela' => 1,
                ],
            ],
            'parcelas' => [
                [
                    'parcela' => 1,
                    'tipo_parcela' => 0,
                    'data_vencimento' => '01/01/2022',
                    'tributos' => [
                        [
                            'codigo' => 1,
                            'enquadramento' => 1,
                            'valor_tributo_original' => 11.99,
                            'valor_correcao_original' => 10.99,
                            'valor_multa_original' => 9.99,
                            'valor_juros_original' => 8.99,
                            'valor_juros_parcelamento_original' => 7.99,
                        ],
                    ],
                ],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('item.0.codigo', 'WGT-000008');
        $response->assertJsonPath('item.0.descricao', 'Forma de pagamento não cadastrada.');
    }
}
