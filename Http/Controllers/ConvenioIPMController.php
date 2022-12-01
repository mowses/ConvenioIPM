<?php

namespace Modules\ConvenioIPM\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\ConvenioIPM\Entities\Services\WGTLancamentoTributario;
use Modules\ConvenioIPM\Entities\Services\WUNPessoa;
use Modules\ConvenioIPM\Http\Requests\AlteraValoresParcelaRequest;
use Modules\ConvenioIPM\Http\Requests\BuscaDadosCarneRequest;
use Modules\ConvenioIPM\Http\Requests\BuscaLancamentosTributariosRequest;
use Modules\ConvenioIPM\Http\Requests\BuscaSituacaoParcelaRequest;
use Modules\ConvenioIPM\Http\Requests\CalculoTributarioIndividualRequest;
use Modules\ConvenioIPM\Http\Requests\CancelaParcelaLancamentoTributarioRequest;
use Modules\ConvenioIPM\Http\Requests\CancelaReparcelamentoLancamentoTributarioRequest;
use Modules\ConvenioIPM\Http\Requests\EmiteCarneRequest;
use Modules\ConvenioIPM\Http\Requests\EstornaCancelamentoParcelaLancamentoTributarioRequest;
use Modules\ConvenioIPM\Http\Requests\GetPessoaBasicoRequest;
use Modules\ConvenioIPM\Http\Requests\GetPessoaFisicaRequest;
use Modules\ConvenioIPM\Http\Requests\GetPessoaRequest;
use Modules\ConvenioIPM\Http\Requests\ImportaPessoaFisicaRequest;
use Modules\ConvenioIPM\Http\Requests\ImportaPessoaRequest;
use Modules\ConvenioIPM\Http\Requests\InsereLancamentoTributarioExercicioRequest;
use Modules\ConvenioIPM\Http\Requests\InsereReparcelamentoLancamentoTributarioRequest;
use stdClass;

class ConvenioIPMController extends Controller
{
    /**
     * Retorna os dados de uma pessoa cadastrada no "Cadastro Único".
     *
     * @param GetPessoaRequest $request
     * @return stdClass|null
     */
    public function getPessoa(GetPessoaRequest $request)
    {
        $soap = new WUNPessoa(
            WUNPessoa::METHOD_GET_PESSOA,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    /**
     * Este método busca de forma simplificada/reduzida de uma pessoa cadastrada no
     * "Cadastro Único de Pessoas" do sistema Atende.net, com base entre um intervalo de códigos,
     * conforme os filtros FiltroCodigoInicial e FiltroCodigoFinal.
     *
     * @param GetPessoaBasicoRequest $request
     * @return stdClass|null
     */
    public function getPessoaBasico(GetPessoaBasicoRequest $request)
    {
        $soap = new WUNPessoa(
            WUNPessoa::METHOD_GET_PESSOA_BASICO,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    /**
     * Este método busca os dados de uma pessoa "Física" cadastrada no "Cadastro Único de Pessoas"
     * do sistema Atende.net conforme o filtro cpf.
     *
     * @param GetPessoaFisicaRequest $request
     * @return stdClass|null
     */
    public function getPessoaFisica(GetPessoaFisicaRequest $request)
    {
        $soap = new WUNPessoa(
            WUNPessoa::METHOD_GET_PESSOA_FISICA,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    /**
     * Permite incluir e ou atualizar dados de uma pessoa cadastrada no "Cadastro Único de Pessoas".
     *
     * @param ImportaPessoaRequest $request
     * @return stdClass|null
     */
    public function importaPessoa(ImportaPessoaRequest $request)
    {
        $soap = new WUNPessoa(
            WUNPessoa::METHOD_DO_IMPORTA_PESSOA,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    /**
     * Permite atualizar dados de uma pessoa "Física" cadastrada no "Cadastro Único de Pessoas" do sistema Atende.net,
     * com base em um CPF válido. É necessário que a pessoa já esteja cadastrada no sistema.
     *
     * @param ImportaPessoaFisicaRequest $request
     * @return stdClass|null
     */
    public function importaPessoaFisica(ImportaPessoaFisicaRequest $request)
    {
        $soap = new WUNPessoa(
            WUNPessoa::METHOD_DO_IMPORTA_PESSOA_FISICA,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function insereLancamentoTributarioExercicio(InsereLancamentoTributarioExercicioRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_INSERE_LANCAMENTO_TRIBUTARIO_EXERCICIO,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function alteraValoresParcela(AlteraValoresParcelaRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_ALTERA_VALORES_PARCELA,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function calculoTributarioIndividual(CalculoTributarioIndividualRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_REALIZA_CALCULO_TRIBUTARIO_INDIVIDUAL,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function buscaSituacaoParcela(BuscaSituacaoParcelaRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_BUSCA_SITUACAO_PARCELA,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function buscaLancamentosTributarios(BuscaLancamentosTributariosRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_BUSCA_LANCAMENTOS_TRIBUTARIOS,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function emiteCarne(EmiteCarneRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_EMITE_CARNE,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function buscaDadosCarne(BuscaDadosCarneRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_BUSCA_DADOS_CARNE,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function insereReparcelamentoLancamentoTributario(InsereReparcelamentoLancamentoTributarioRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_INSERE_REPARCELAMENTO_LANCAMENTO_TRIBUTARIO,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function cancelaReparcelamentoLancamentoTributario(CancelaReparcelamentoLancamentoTributarioRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_CANCELA_REPARCELAMENTO_LANCAMENTO_TRIBUTARIO,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function cancelaParcelaLancamentoTributario(CancelaParcelaLancamentoTributarioRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_CANCELA_PARCELAMENTO_LANCAMENTO_TRIBUTARIO,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }

    public function estornaCancelamentoParcelaLancamentoTributario(EstornaCancelamentoParcelaLancamentoTributarioRequest $request)
    {
        $soap = new WGTLancamentoTributario(
            WGTLancamentoTributario::METHOD_ESTORNA_CANCELAMENTO_PARCELA_LANCAMENTO_TRIBUTARIO,
            $request->validated()
        );

        $soap->sendRequest();

        return $soap->response;
    }
}
