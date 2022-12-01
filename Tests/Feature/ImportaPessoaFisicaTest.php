<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class ImportaPessoaFisicaTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/importaPessoaFisica';

    public function test_doImportaPessoaFisica_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'cpf' => 'The cpf field is required.',
        ]);
    }

    public function test_doImportaPessoaFisica_deve_retornar_erro_cpf_invalido()
    {
        $response = $this->post(self::ENDPOINT, [
            'nome' => 'PESSOA FISICA FANTASMA',
            'cpf' => '00000000000',
        ]);

        $response->assertJson([
            'faultcode' => 'WUN-000137',
            'faultstring' => 'O CPF (00000000000) não é válido.'
        ]);
    }

    public function test_doImportaPessoaFisica_deve_retornar_erro_cpf_valido_com_mascara()
    {
        $response = $this->post(self::ENDPOINT, [
            'nome' => 'PESSOA FISICA FANTASMA',
            'cpf' => '782.743.620-04',
        ]);

        $response->assertJson([
            'faultcode' => 'WUN-000136',
            'faultstring' => 'Não foi encontrado nenhuma pessoa para o CPF/CNPJ repassado.'
        ]);
    }

    public function test_doImportaPessoaFisica_deve_retornar_erro()
    {
        $response = $this->post(self::ENDPOINT, [
            'nome' => 'PESSOA FISICA FANTASMA',
            'cpf' => '78274362004',
        ]);

        $response->assertStatus(200);
        $this->assertStringContainsString('Erro ao realizar a importa\u00e7\u00e3o da pessoa.', $response->content());
    }
}
