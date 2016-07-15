<?php

namespace capesesp\json;

use robotdance\Arguments;
use robotdance\Console;
use capesesp\json\JsonValidator;
use capesesp\json\JsonSchemaTestCase;
use capesesp\util\Walker;

/**
 * Extende phpunit para validar objetos JSON
 */
abstract class OpusJsonTestCase extends JsonSchemaTestCase
{
    /**
     * Testa se o retorno do servico Opus/JSON possui o codigo de retorno
     * @param $jsonObj Objeto JSON que segue o padrão da especificação Opus/JSON
     * @param $codigo numero com o codigo de retorno a ser procurado
     * @param $args vetor de argumentos
     * @return phpunit assertion
     */
    public function assertCodigo($jsonObj, $codigo, $args = NULL)
    {
        Arguments::notNull($jsonObj, 'jsonObj');

        $elemento = implode('.', array_filter(array($this->rootElementName, 'statusExecucao.mensagens.mensagem[0].codigo')));
        $value = Walker::traverse($jsonObj, $elemento);
        if(!$value) {
            $msg = $this->wrongStructureMsg($jsonObj, $elemento, $value, $args);
        } else {
            $msg = $this->notExpectedCodeMsg($jsonObj, $elemento, $value, $codigo, $args);
        }
        $this->assertEquals($codigo, $value, $msg);
    }

    /**
     * Mensagem exibida quando o retorno não possui a estrutura esperada para pegar o codigo
     * @see assertCodigo
     */
    private function wrongStructureMsg($jsonObj, $element, $value, $args = NULL)
    {
        $msg = Console::bold("Estrutura da resposta não corresponde ao esperado") . "\n" ;
        $msg .= Console::red("Estrutura esperada: ") . $element . "\n";
        $msg .= Console::red("Verifique se um dos elementos não existe ou se está com nome incorreto.") . "\n";
        if($args) { $msg .= "Parâmetros Opus: " . implode(" ", $args) . "\n"; }
        $msg .= "Retorno:" . "\n";
        $msg .= json_encode($jsonObj, JSON_PRETTY_PRINT) . "\n";
        return $msg;
    }

    /**
     * Mensagem exibida quando o codigo de retorno não é o esperado
     * @see assertCodigo
     */
    private function notExpectedCodeMsg($jsonObj, $element, $value, $codigo, $args = NULL)
    {
        $msg = Console::bold(Console::red("Codigo de retorno não corresponde ao esperado")) . "\n";
        $msg .= Console::red("Verifique se o codigo da mensagem de retorno está de acordo com o especificado.") . "\n";
        if($args) { $msg .= "Parâmetros Opus: " . implode(" ", $args) . "\n"; }
        $msg .= "Esperado: $codigo" . "\n" ;
        $msg .= "Retorno: " . print_r($value, true) . "\n" ;
        $msg .= json_encode($jsonObj, JSON_PRETTY_PRINT) . "\n";
        return $msg;
    }

}
