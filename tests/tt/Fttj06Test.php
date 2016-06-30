<?php

namespace capesesp;

use capesesp\tt\Fttj06;
use capesesp\json\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo TT do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fttj06Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/tt/schemas/fttj06.schema.json';
        $this->rootElementName = 'saidaFttj06';
    }

    public function testSchema()
    {
        $args = [1, 1];
        $jsonObj = Fttj06::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testIdObrigatorio()
    {
        $args = ['',''];
        $jsonObj = Fttj06::executa($args);
        $this->assertCodigo($jsonObj, Fttj06::ID_EVENTO_OBRIGATORIO, $args);
    }

    public function testReciboObrigatorio()
    {
        $args = [1];
        $jsonObj = Fttj06::executa($args);
        $this->assertCodigo($jsonObj, Fttj06::RECIBO_OBRIGATORIO, $args);
    }

    public function testEventoInvalido()
    {
        $args = [999, 1];
        $jsonObj = Fttj06::executa($args);
        $this->assertCodigo($jsonObj, Fttj06::EVENTO_INVALIDO_OU_NAO_ENCONTRADO, $args);
    }

    public function testReciboInvalido()
    {
        $args = ['1', '1-1-1-1'];
        $jsonObj = Fttj06::executa($args);
        $this->assertCodigo($jsonObj, Fttj06::RECIBO_COM_MENOS_DE_15_CARACTERES, $args);

        $args = ['1', '012345678901234567890123456789012345678901234567890123456789'];
        $jsonObj = Fttj06::executa($args);
        $this->assertCodigo($jsonObj, Fttj06::RECIBO_COM_MAIS_DE_49_CARACTERES, $args);
    }
}
?>
