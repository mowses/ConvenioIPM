<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class CalculoTributarioIndividualTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/calculoTributarioIndividual';

    public function test_calculoTributarioIndividual_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'ano_calculo' => 'The ano calculo field is required.',
        ]);
    }

    public function test_calculoTributarioIndividual_deve_retornar_que_nenhum_calculo_tributario_foi_gerado()
    {
        $response = $this->post(self::ENDPOINT, [
            'ano_calculo' => 2022,
            'data_base_calculo' => '01/01/2022',
            'codigo_sub_receita' => 439,
            'contribuinte' => '162.016.049-87',
            'cadastro_imobiliario' => 0,
            'formas_pagamento' => [
                [
                    'ano_forma_pagamento' => 0,
                    'codigo_forma_pagamento' => 8,
                    'quantidade_parcelas' => 1,
                    'data_base_vencimento' => '01/01/2022',
                ]
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'codigo_mensagem' => 'WGT-000658',
        ]);
        $this->assertStringContainsString('N\u00e3o foi gerado nenhum C\u00e1lculo Tribut\u00e1rio!', $response->content());
    }
}
