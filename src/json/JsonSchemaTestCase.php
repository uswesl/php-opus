<?php

namespace capesesp\json;

use capesesp\Console;
use capesesp\json\JsonValidator;

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
    public function assertSchema($jsonObj, $schemaPath, $args = NULL)
    {
        $isValid = JsonValidator::validate($jsonObj, $schemaPath, $msg);
        $this->assertEquals(true, $isValid, $msg);
    }
}
