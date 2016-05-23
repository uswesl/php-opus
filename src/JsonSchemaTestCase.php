<?php

namespace capesesp;

use capesesp\Console;

use JsonSchema\RefResolver;
use JsonSchema\Validator;
use JsonSchema\Uri\UriRetriever;
use JsonSchema\Uri\UriResolver;

use ReverseRegex\Lexer;
use ReverseRegex\Random\SimpleRandom;
use ReverseRegex\Parser;
use ReverseRegex\Generator\Scope;

/**
 * Extende phpunit para validar objetos JSON
 */
abstract class JsonSchemaTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Armazena caminho para o JSON schema
     */
    protected $schemaPath;

    /**
     * Armazena elemento raiz para JSONs que podem ser convertidos para XML
     */
    protected $rootElementName;

    /**
     * Configura o ambiente para testes
     * Certifique-se de invoar o setup caso necessite sobrescrever o metodo em uma subclasse
     */
    public function setUp()
    {
        ini_set('xdebug.max_nesting_level', 200);
        putenv('ENVIRONMENT=test');
    }

    /**
     * Testa um objeto JSON resultante de json_decode conta um schema JSON
     * @see http://json-schema.org/
     * @param $jsonObj Objeto JSON PHP
     * @param $schemaPath Caminho para o schema json
     * @return phpunit assertion
     */
    public function assertSchema($jsonObj, $schemaPath = NULL, $args = NULL)
    {
        if($schemaPath != NULL) {
            $this->schemaPath = $schemaPath;
        }
        $refResolver = new RefResolver(new UriRetriever(), new UriResolver());
        $schema = $refResolver->resolve('file://' . realpath($this->schemaPath));
        $validator = new Validator();
        $validator->check($jsonObj, $schema);

        $msg = "JSON validado com sucesso";
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
            $totalErrors = count($errors);
            $msg = Console::bold(Console::red("JSON não corresponde ao esquema. $totalErrors ocorrências encontradas:")) . "\n";
            for($i = 0; $i < $totalErrors; $i++) {
                $error = $errors[$i];
                $value = $this->traverse($jsonObj, $error['property']);
                $msg .= Console::red(($i+1) . "/$totalErrors: " . $error['property']) . "\n";
                $lineBreak = (is_object($value) || is_array($value)) ? "\n" : "";
                $msg .= implode(["Retorno:", $lineBreak, json_encode($value, JSON_PRETTY_PRINT), "\n"]);
                $msg .= ($error['message']). "\n\n";
            }
            if (!$jsonObj) {
                $msg .= "Parametro JSON de entrada nulo.";
            }
        }
        $this->assertSchemaFlag = true;
        $this->assertEquals(true, $validator->isValid(), $msg);
    }

    /**
     * Acessa elemento do objeto JSON a partir de um caminho (path)
     * Exemplo:
     * $path = "statusExecucao.mensagens.mensagem[0].codigo";
     * $value = traverse($jsonObj, $path); 
     * $value irá retornar o valor do elemento "codigo"
     * @param $jsonObj Objeto JSON resultante de json_decode com array = false
     * @param $path String com caminho no estilo "jq"
     * @return Valor do elemento
     */
    private function traverse($jsonObj, $path)
    {
        $props = explode(".", $path);
        $obj = $jsonObj;
        foreach($props as $prop) {
            $propExploded = explode("[", $prop);
            $propName = $propExploded[0];
            if(property_exists($obj, $propName)) {
                eval("\$obj = \$obj->" . $prop . ";");
                $value = $obj;
            } else {
                $value = NULL;
                break;
            }
        }
        return $value;
    }
}
