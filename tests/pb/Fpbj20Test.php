<?php

namespace capesesp;

use capesesp\pb\Fpbj20;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj20Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj20.schema.json';
    }

    public function testSchema()
    {
        $args = array("903586","0");
        $jsonObj = Fpbj20::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testTransacoesRetornadas()
    {
        $args = array("903586", "0");
        $jsonObj = Fpbj20::executa($args);
        $this->assertCodigo($jsonObj, Fpbj20::INFORMACOES_RETORNADAS, $args);
    }

    public function testTransacoesNaoEncontradas()
    {
        $args = array("123123", "0");
        $jsonObj = Fpbj20::executa($args);
        $this->assertCodigo($jsonObj, Fpbj20::INFORMACOES_NAO_RETORNADAS, $args);
    }
    
    public function testSequencialInvalido()
    {
        $args = array("903586", "aa");
        $jsonObj = Fpbj20::executa($args);
        $this->assertCodigo($jsonObj, Fpbj20::SEQUENCIAL_INVALIDO, $args);
    }
    
    public function testMatriculaInvalida()
    {
        $args = array("aaaaaa", 1);
        $jsonObj = Fpbj20::executa($args);
        $this->assertCodigo($jsonObj, Fpbj20::MATRICULA_INVALIDA, $args);
    }

}
