<?php

namespace capesesp;

use capesesp\tt\Fttj05;
use capesesp\json\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo TT do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fttj05Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/tt/schemas/fttj05.schema.json';
        $this->rootElementName = 'saidaFttj05';
    }

    public function testSchema()
    {
        $args = array(201605, 0);
        $jsonObj = Fttj05::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testEventosEncontrados()
    {
        $args = array(201605, 0);
        $jsonObj = Fttj05::executa($args);
        $this->assertCodigo($jsonObj, Fttj05::EVENTOS_ENCONTRADOS, $args);
    }

    public function testNenhumEventoEncontrado()
    {
        $args = array(201609, 0);
        $jsonObj = Fttj05::executa($args);
        $this->assertCodigo($jsonObj, Fttj05::NENHUM_EVENTO_ENCONTRADO, $args);
    }
}
?>
