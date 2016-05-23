<?php

namespace capesesp;

use capesesp\tt\Fttj02;
use capesesp\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo TT do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fttj02Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/tt/schemas/fttj02.schema.json';
        $this->rootElementName = 'saidaFttj02';
    }

    public function testSchema()
    {
        $args = array(201605, 0);
        $jsonObj = Fttj02::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testEventosEncontrados()
    {
        $args = array(201605, 0);
        $jsonObj = Fttj02::executa($args);
        $this->assertCodigo($jsonObj, Fttj02::EVENTOS_ENCONTRADOS, $args);
    }

    public function testNenhumEventoEncontrado()
    {
        $args = array(201609, 0);
        $jsonObj = Fttj02::executa($args);
        $this->assertCodigo($jsonObj, Fttj02::NENHUM_EVENTO_ENCONTRADO, $args);
    }
}
?>
