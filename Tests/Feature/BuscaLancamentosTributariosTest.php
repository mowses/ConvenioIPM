<?php

namespace Modules\ConvenioIPM\Tests\Feature;

use Tests\TestCase;

class BuscaLancamentosTributariosTest extends TestCase
{
    const ENDPOINT = 'api/convenio-ipm/buscaLancamentosTributarios';

    public function test_buscaLancamentosTributarios_deve_dar_erro_validacao()
    {
        $response = $this->post(self::ENDPOINT, []);
        $response->assertInvalid([
            'ano_lancamento' => 'The ano lancamento field is required.',
        ]);
    }

    public function test_buscaLancamentosTributarios_deve_retornar_sucesso()
    {
        $response = $this->post(self::ENDPOINT, [
            'ano_lancamento' => 2022,
            'codigo_sub_receita' => 439,
            'cpf_cnpj_pessoa' => $cnpj = '009.145.819-61',
            'detalhado' => true,
            'cadastro' => null,
            'identificador_proprio' => null,
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('lancamentos_blt.item.0.dados_pessoa_blt.cpf_cnpj', $cnpj);
    }
}
