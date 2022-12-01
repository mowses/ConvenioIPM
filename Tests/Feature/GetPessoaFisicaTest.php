<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class GetPessoaFisicaTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/getPessoaFisica';

    public function test_getPessoaFisica_deve_retornar_fault_code_quando_enviar_cpf_invalido()
    {
        $response = $this->post(self::ENDPOINT, [
            'cpf' => '000.000.00-00',
        ]);

        $response->assertJson([
            'faultcode' => 'WUN-000137',
            'faultstring' => 'O CPF (000.000.00-00) não é válido.'
        ]);
    }

    public function test_getPessoaFisica_deve_retornar_dados_do_seu_moacir_grande_moaca()
    {
        $response = $this->post(self::ENDPOINT, [
            'cpf' => '162.016.049-87',
        ]);

        $response->assertJsonFragment([
            'codigo' => '167',
            'nome' => 'MOACIR VIRGILIO FRANZOI',
            'cpf' => '162.016.049-87',
        ]);
    }
}
