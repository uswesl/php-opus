<?php

namespace capesesp;

use capesesp\co\Fcoj01;
use capesesp\json\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo UC do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fcoj01Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/co/schemas/fcoj01.schema.json';
    }

    public function testSchema()
    {
        $args = array(date("Ymd"), '903586','0');
        $jsonObj = Fcoj01::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

/*    
    public function testResultadosEncontrados()
    {
        $args = array(date("Ymd"), '46','0');
        $jsonObj = Fcoj01::executa($args);
        $this->assertCodigo($jsonObj, Fcoj01::RESULTADOS_ENCONTRADOS, $args);
    }
*/

    public function testBoletosEncontrados()
    {
        $args = array(date("Ymd"), '46','0');
        $jsonObj = Fcoj01::executa($args);
        $this->assertCodigo($jsonObj, Fcoj01::BOLETOS_ENCONTRADOS, $args);
    }

    public function testBoletosNaoEncontrados()
    {
        $args = array(date("Ymd"), '903586','0');
        $jsonObj = Fcoj01::executa($args);
        $this->assertCodigo($jsonObj, Fcoj01::BOLETOS_NAO_ENCONTRADOS, $args);
    }
   
    public function testAssociadoNaoEncontrado()
    {
        $args = array(date("Ymd"), '909586','0');
        $jsonObj = Fcoj01::executa($args);
        $this->assertCodigo($jsonObj, Fcoj01::ASSOCIADO_NAO_ENCONTRADO, $args);
    }

    public function testNumeroBoletoInvalido()
    {
        $args = array(date("Ymd"), '46','0','qwqwqwqwqw');
        $jsonObj = Fcoj01::executa($args);
        $this->assertCodigo($jsonObj, Fcoj01::NUMERO_BOLETO_INVALIDO, $args);
    }

    public function testSequencialInvalido()
    {
        $args = array(date("Ymd"), '46','a');
        $jsonObj = Fcoj01::executa($args);
        $this->assertCodigo($jsonObj, Fcoj01::SEQUENCIAL_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array(date("Ymd"), 'aa','0');
        $jsonObj = Fcoj01::executa($args);
        $this->assertCodigo($jsonObj, Fcoj01::MATRICULA_INVALIDA, $args);
    }

    public function testDataInvalida()
    {
        $args = array('asdfasf', '46','0');
        $jsonObj = Fcoj01::executa($args);
        $this->assertCodigo($jsonObj, Fcoj01::DATA_INVALIDA, $args);
    }






}

