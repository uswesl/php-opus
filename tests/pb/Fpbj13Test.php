<?php

namespace capesesp;

use capesesp\pb\Fpbj13;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj13Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj13.schema.json';
    }

    public function testSchema()
    {
        $args = array(903586,0);
        $jsonObj = Fpbj13::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testDadosAssistenciaisEncontrados()
    {
        $args = array(46,0);
        $jsonObj = Fpbj13::executa($args);
        $this->assertCodigo($jsonObj, Fpbj13::DADOS_ASSISTENCIAIS_ENCONTRADOS, $args);
    }

    public function testDadosAssistenciaisNaoEncontrados()
    {
        $args = array(903586,13);
        $jsonObj = Fpbj13::executa($args);
        $this->assertCodigo($jsonObj, Fpbj13::DADOS_ASSISTENCIAIS_NAO_ENCONTRADOS, $args);
    }

    public function testSequencialInvalido()
    {
        $args = array(903586, 132);
        $jsonObj = Fpbj13::executa($args);
        $this->assertCodigo($jsonObj, Fpbj13::SEQUENCIAL_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array("9asdf03586",0);
        $jsonObj = Fpbj13::executa($args);
        $this->assertCodigo($jsonObj, Fpbj13::MATRICULA_INVALIDA, $args);
    }

    public function testMatriculaObrigatorio()
    {
        $args = array();
        $jsonObj = Fpbj13::executa($args);
        $this->assertCodigo($jsonObj, Fpbj13::MATRICULA_OBRIGATORIO, $args);
    }

}
