<?php

namespace capesesp;

use capesesp\tt\Fttj01;
use capesesp\json\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo TT do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fttj01Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/tt/schemas/fttj01.schema.json';
        $this->rootElementName = 'saidaFttj01';
    }

    public function testSchema()
    {
        $args = array(250);
        $jsonObj = Fttj01::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testNenhumEventoEncontrado()
    {
        $args = array(1000);
        $jsonObj = Fttj01::executa($args);
        $this->assertCodigo($jsonObj, Fttj01::NENHUM_EVENTO_ENCONTRADO, $args);
    }

}
?>
