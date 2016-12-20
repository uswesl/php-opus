<?php

namespace capesesp;

use capesesp\ft\Fftj13;
use capesesp\json\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo FT do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fftj13Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/ft/schemas/fftj13.schema.json';
    }

    public function testSchema()
    {
        $args = array(46, 00, "consulta", 2016, 1);
        $jsonObj = Fftj13::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testEventosEncontrados()
    {
        $args = array(46, 00, "consulta", 2016, 1);
        $jsonObj = Fftj13::executa($args);
        $this->assertCodigo($jsonObj, Fftj13::DADOS_RETORNADOS, $args);
    }
    public function testMatriculaInvalida()
    {
        $args = array("9x9", 00, "consulta", 2016, 1);
        $jsonObj = Fftj13::executa($args);
        $this->assertCodigo($jsonObj, Fftj13::MATRICULA_INVALIDA, $args);
    }
    public function testSequencialInvalido()
    {
        $args = array(46, "9x9", "consulta", 2016, 1);
        $jsonObj = Fftj13::executa($args);
        $this->assertCodigo($jsonObj, Fftj13::SEQUENCIAL_INVALIDO, $args);
    }
    public function testCategoriaDespesaInvalida()
    {
        $args = array(46, 00, "teste", 2016, 1);
        $jsonObj = Fftj13::executa($args);
        $this->assertCodigo($jsonObj, Fftj13::CATEGORIA_DESPESA_INVALIDA, $args);
    }
    public function testAnoInvalido()
    {
        $args = array(46, 00, "consulta", "3x00", 1);
        $jsonObj = Fftj13::executa($args);
        $this->assertCodigo($jsonObj, Fftj13::ANO_INVALIDO, $args);
    }
    public function testSemestreInvalido()
    {
        $args = array(46, 00, "consulta", 2016, "x");
        $jsonObj = Fftj13::executa($args);
        $this->assertCodigo($jsonObj, Fftj13::SEMESTRE_INVALIDO, $args);
    }
    public function testBeneficiarioNaoEncontrado()
    {
        $args = array(999999, 00, "consulta", 2016, 1);
        $jsonObj = Fftj13::executa($args);
        $this->assertCodigo($jsonObj, Fftj13::BENEFICIARIO_NAO_ENCONTRADO, $args);
    }
    public function testNaoHaEventosNoPeriodo()
    {
        $args = array(46, 00, "consulta", 1960, 1);
        $jsonObj = Fftj13::executa($args);
        $this->assertCodigo($jsonObj, Fftj13::NAO_HA_PROCEDIMENTOS_NO_PERIODO, $args);
    }
}
?>
