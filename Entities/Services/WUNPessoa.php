<?php

namespace Modules\ConvenioIPM\Entities\Services;

use SimpleXMLElement;
use SoapClient;
use stdClass;
use Throwable;

/**
 * Wrapper da API SOAP da IPM. Nota Técnica nº 172/2019
 * Pesquisa diversos serviços da API através dos parâmetros passados para esta classe.
 *
 * @link https://t12928870.p.clickup-attachments.com/t12928870/0f0513ad-a538-420b-8792-7666371cb633/Nota%20T%C3%A9cnica%20n%C2%BA%20172.2019.pdf
 */
class WUNPessoa
{
    const METHOD_GET_PESSOA = 'getPessoa';
    const METHOD_GET_PESSOA_BASICO = 'getPessoaBasico';
    const METHOD_GET_PESSOA_FISICA = 'getPessoaFisica';
    const METHOD_DO_IMPORTA_PESSOA = 'doImportaPessoa';
    const METHOD_DO_IMPORTA_PESSOA_FISICA = 'doImportaPessoaFisica';

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
            'location' => $endpoint = $this->endpoint ?: config('convenioipm.services.WUNPessoa.endpoint'),
            'uri' => $endpoint,
            'login' => $this->username ?: config('convenioipm.services.WUNPessoa.username'),
            'password' => $this->password ?: config('convenioipm.services.WUNPessoa.password'),
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
