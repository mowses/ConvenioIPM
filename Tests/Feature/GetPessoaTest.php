<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class GetPessoaTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/getPessoa';

    public function test_getPessoa_deve_retornar_fault_code_quando_enviar_cpf_invalido()
    {
        $response = $this->post(self::ENDPOINT, [
            'cpfCnpj' => '000.000.00-00',
            'nomeRazao' => null,
        ]);

        $response->assertJson([
            'faultcode' => 'WUN-000072',
            'faultstring' => 'O CPF/CNPJ (000.000.00-00) não é válido.'
        ]);
    }

    public function test_getPessoa_deve_retornar_dados_do_seu_moacir_grande_moaca()
    {
        $response = $this->post(self::ENDPOINT, [
            'cpfCnpj' => '162.016.049-87',
            'nomeRazao' => null,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'codigo' => '167',
            'nomerazao' => 'MOACIR VIRGILIO FRANZOI',
            'cpfcnpj' => '162.016.049-87',
        ]);
    }
}
