<?php

namespace capesesp\soap;

use robotdance\Arguments;
use robotdance\Console;
use capesesp\util\Walker;
use capesesp\util\XmlSerializer;

/**
 * Extende phpunit para validar objetos JSON
 */
abstract class SoapTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Armazena elemento raiz para JSONs que podem ser convertidos para XML
     */
    protected $rootElementName;

    /**
     * Armazena client do web service
     */
    protected $soapClient;

    /**
     * pp stands for 'pretty print'
     */
    public function pp($xmlString)
    {
        $dom = new \DOMDocument;
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($xmlString);
        $dom->formatOutput = true;
        return $dom->saveXml();
    }

    /**
     * Testa se o retorno do servico Opus/JSON possui o codigo de retorno
     * @param $response Objeto PHP resultado de uma requisicao SOAP
     * @param $codigo numero com o codigo de retorno a ser procurado
     * @return phpunit assertion
     */
    public function assertCodigo($request, $response, $codigo)
    {
        Arguments::notNull($response, 'response');

        $element = implode('.', array_filter(array($this->rootElementName, 'statusExecucao.mensagens.Mensagem[0].codigo')));
        $value = Walker::traverse($response, $element);
        if(!$value) {
            $msg = $this->wrongStructureMsg($request, $response, $element, $value);
        } else {
            $msg = $this->notExpectedCodeMsg($request, $response, $element, $value, $codigo);
        }
        $this->assertEquals($codigo, $value, $msg);
    }

    /**
     * Mensagem exibida quando o retorno não possui a estrutura esperada para pegar o codigo
     * @see assertCodigo
     */
    private function wrongStructureMsg($request, $response, $element, $value)
    {
        $msg = Console::bold("Estrutura da resposta não corresponde ao esperado") . "\n" ;
        $msg .= Console::red("Estrutura esperada: ") . $element . "\n";
        $msg .= Console::red("Verifique se um dos elementos não existe ou se está com nome incorreto.") . "\n";
        $msg .= "Retorno:" . "\n";
        $msg .= XmlSerializer::toXml($response, true) . "\n";
        return $msg;
    }

    /**
     * Mensagem exibida quando o codigo de retorno não é o esperado
     * @see assertCodigo
     */
    private function notExpectedCodeMsg($request, $response, $element, $value, $codigo)
    {
        $msg = Console::bold(Console::red("Codigo de retorno não corresponde ao esperado")) . "\n";
        $msg .= Console::red("Verifique se o codigo da mensagem de retorno está de acordo com o especificado.") . "\n";
        $msg .= "Esperado: $codigo, retornou: $value" . "\n" ;
        $msg .= Console::red("Requisição:") . "\n";
        $msg .= XmlSerializer::toXml($request, true, 'xml') . "\n";
        $msg .= Console::red("Resposta:") . "\n" ;
        $msg .= XmlSerializer::toXml($response, true, 'xml') . "\n";
        return $msg;
    }

}
