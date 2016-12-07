<?php

namespace capesesp;

use capesesp\sn\Fsnj02;
use capesesp\json\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo FT do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fsnj02Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/sn/schemas/fsnj02.schema.json';
    }

    public function testSchema()
    {
        $args = array(27901222000131);
        $jsonObj = Fsnj02::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testSenhasRetornadas()
    {
        $args = array(27901222000131);
        $jsonObj = Fsnj02::executa($args);
        $this->assertCodigo($jsonObj, Fsnj02::SENHAS_RETORNADAS, $args);
    }
    public function testPrestadorNaoEncontrado()
    {
        $args = array(27901222000111);
        $jsonObj = Fsnj02::executa($args);
        $this->assertCodigo($jsonObj, Fsnj02::PRESTADOR_NAO_ENCONTRADO, $args);
    }
    public function testBeneficiarioNaoEncontrado()
    {
        $args = array(27901222000131, 4600);
        $jsonObj = Fsnj02::executa($args);
        $this->assertCodigo($jsonObj, Fsnj02::BENEFICIARIO_NAO_ENCONTRADO, $args);
    }
    public function testSenhaNaoEncontrada()
    {
        $args = array(27901222000131, 90303800, 056013);
        $jsonObj = Fsnj02::executa($args);
        $this->assertCodigo($jsonObj, Fsnj02::SENHA_NAO_ENCONTRADA, $args);
    }
    public function testNaoForamEncontradasSenhas()
    {
        $args = array(27901222000131, 4600, 2165103);
        $jsonObj = Fsnj02::executa($args);
        $this->assertCodigo($jsonObj, Fsnj02::NAO_FORAM_ENCONTRADAS_SENHAS_90_DIAS, $args);
    }
}
?>
