<?php

namespace Modules\ConvenioIPM\Entities\Services;

use SimpleXMLElement;
use SoapClient;
use stdClass;
use Throwable;

/**
 * Wrapper da API SOAP da IPM.
 * O serviço WGTLancamentoTributario tem a finalidade de integração com a geração e
 * manutenção de lançamentos tributários do módulo "Arrecadação" no sistema Atende.net.
 *
 * @link https://1drv.ms/b/s!AhC823ej85MGn1OnWRh8MOcSjSvQ?e=lpV13C
 */
class WGTLancamentoTributario
{
    const METHOD_INSERE_LANCAMENTO_TRIBUTARIO_EXERCICIO = 'insereLancamentoTributarioExercicio';
    const METHOD_ALTERA_VALORES_PARCELA = 'alteraValoresParcela';
    const METHOD_REALIZA_CALCULO_TRIBUTARIO_INDIVIDUAL = 'realizaCalculoTributarioIndividual';
    const METHOD_BUSCA_SITUACAO_PARCELA = 'buscaSituacaoParcela';
    const METHOD_BUSCA_LANCAMENTOS_TRIBUTARIOS = 'buscaLancamentosTributarios';
    const METHOD_EMITE_CARNE = 'emiteCarne';
    const METHOD_BUSCA_DADOS_CARNE = 'buscaDadosCarne';
    const METHOD_INSERE_REPARCELAMENTO_LANCAMENTO_TRIBUTARIO = 'insereReparcelamentoLancamentoTributario';
    const METHOD_CANCELA_REPARCELAMENTO_LANCAMENTO_TRIBUTARIO = 'cancelaReparcelamentoLancamentoTributario';
    const METHOD_CANCELA_PARCELAMENTO_LANCAMENTO_TRIBUTARIO = 'cancelaParcelaLancamentoTributario';
    const METHOD_ESTORNA_CANCELAMENTO_PARCELA_LANCAMENTO_TRIBUTARIO = 'estornaCancelamentoParcelaLancamentoTributario';

    /** @var bool */
    public $hasErrors;
    /** @var stdClass|null $response */
    public $response;
    /** @var string */
    public $rawResponse;

    private $username;
    private $password;
    private $method;
    private $input;
    private $endpoint;

    public function __construct(
        string $method,
        array $input,
        string $username = null,
        string $password = null,
        string $endpoint = null
    )
    {
        $this->method = $method;
        $this->input = $input;
        $this->username = $username;
        $this->password = $password;
        $this->endpoint = $endpoint;
    }

    public function sendRequest()
    {
        $soapClient = new SoapClient(null, [
            'location' => $endpoint = $this->endpoint ?: config('convenioipm.services.WGTLancamentoTributario.endpoint'),
            'uri' => $endpoint,
            'login' => $this->username ?: config('convenioipm.services.WGTLancamentoTributario.username'),
            'password' => $this->password ?: config('convenioipm.services.WGTLancamentoTributario.password'),
        ]);

        /*
         * A API da IPM pode responder com:
         * - String contendo mensagem de erro de validação
         * - String com erros e exceções do PHP
         * - XML contendo o retorno dos dados
         * - XML contendo mensagem de erro do retorno dos dados (Fault)
         */
        $this->rawResponse = $soapClient->__doRequest($this->generateEnvelope(), $endpoint, null, SOAP_1_1);

        try {
            $xmlObject = simplexml_load_string($this->rawResponse);
        } catch (Throwable $e) {
            $this->hasErrors = true;
            return $this->response = $this->rawResponse;
        }

        try {
            $return = $xmlObject->xpath('//return')[0];
            return $this->response = json_decode(json_encode($return));
        } catch (Throwable $e) {
            $return = $xmlObject->xpath('//SOAP-ENV:Fault')[0];
            $this->hasErrors = true;
            return $this->response = json_decode(json_encode($return));
        }
    }

    protected function generateEnvelope(): string
    {
        return
            '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:net="net.atende">' .
            '<soapenv:Header/>' .
            '<soapenv:Body>' .
            '<net:' . $this->method . ' soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">' .
            $this->generateXmlParams() .
            '</net:' . $this->method . '>' .
            '</soapenv:Body>' .
            '</soapenv:Envelope>';
    }

    protected function generateXmlParams(): string
    {
        $xml = new SimpleXMLElement('<parametro/>');
        $this->recursiveXml($xml, $this->input);

        $dom = dom_import_simplexml($xml);

        return $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);
    }

    private function recursiveXml(SimpleXMLElement $object, array $data)
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = "item_$key";
            }
            if (is_array($value)) {
                $new_object = $object->addChild($key);
                $this->recursiveXml($new_object, $value);
            } else {
                // if the key is an integer, it needs text with it to actually work.
                if ($key != 0 && $key == (int)$key) {
                    $key = "key_$key";
                }

                $object->addChild($key, $value);
            }
        }
    }
}
