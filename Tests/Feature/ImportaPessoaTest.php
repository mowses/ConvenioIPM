<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class ImportaPessoaTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/importaPessoa';

    public function test_doImportaPessoa_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'nomerazao' => 'The nomerazao field is required.',
        ]);
    }

    public function test_doImportPessoa_deve_retornar_com_sucesso()
    {
        $response = $this->post(self::ENDPOINT, [
            'nomerazao' => 'EMPRESA FANTASMA FAKE',
            'tipopessoa' => 2,
            'cpfcnpj' => '83.880.882/0001-54',
            'rgie' => '1',
            'estrangeiro' => 0,
            'situacao' => 1,
            'nomefantasia' => 'ESTA EMPRESA NAO EXISTE',
            'observacoes' => 'Teste de cadastro de empresa',
            'orgaoemissor' => 'NA',
            'ufemissor' => 'NA',
            'dataemissao' => now(),
            'sexo' => 1,
            'nomepai' => 'Senpai',
            'nomemae' => 'Senmain',
            'grauinstrucao' => 11,
            'cnhnumero' => '',
            'cnhcategoria' => '',
            'cnhobservacao' => '',
            'cnhvalidade' => now()->addYears(2),
            'enderecos' => [],
            'contatos' => [],
        ]);

        $response->assertStatus(200);
        $this->assertStringContainsString('Importa\u00e7\u00e3o da pessoa realizada com sucesso.', $response->content());
    }
}
