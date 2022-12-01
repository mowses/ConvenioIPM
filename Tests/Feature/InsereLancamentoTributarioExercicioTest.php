<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class InsereLancamentoTributarioExercicioTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/insereLancamentoTributarioExercicio';

    public function test_insereLancamentoTributarioExercicio_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'lancamentos' => 'The lancamentos field is required.',
        ]);
    }

    public function test_insereLancamentoTributarioExercicio_deve_retornar_erro_de_identificador_ja_relacionado()
    {
        $this->post(self::ENDPOINT, $data = [
            'lancamentos' => [
                [
                    'identificador_proprio' => '71741',
                    'cpf_cnpj_pessoa' => '009.145.819-61',
                    'codigo_sub_receita' => 439,
                    'codigo_moeda' => 1,
                    'ano_lancamento' => 2022,
                    'data_base_calculo' => '01/05/2022',
                    'observacao' => 'Inserindo lancamento tributario no ambiente de homologacao para teste',
                    'formas_pagamento' => [
                        [
                            'ano' => 0,
                            'codigo' => 8,
                            'situacao' => 1,
                            'quantidade_parcelas' => 1,
                            'parcelas' => [
                                [
                                    'parcela' => 1,
                                    'tipo_parcela' => 0,
                                    'data_vencimento' => '01/01/2022',
                                    'tributos' => [
                                        [
                                            'codigo_tributo' => 31107,
                                            'enquadramento' => 1,
                                            'valor_tributo_original' => 15.01,
                                        ]
                                    ],
                                ]
                            ],
                        ]
                    ],
                ],
            ],
        ]);

        $response = $this->post(self::ENDPOINT, $data);

        $response->assertStatus(200);
        $this->assertStringContainsString('WGT-000642', $response->content());
        $this->assertStringContainsString('Identificador 71741 j\u00e1 relacionado', $response->content());
    }
}
