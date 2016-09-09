<?php

namespace capesesp;

use capesesp\pb\Fpbj10;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj10Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj10.schema.json';
    }

    public function testSchema()
    {
        $args = array(903586,0);
        $jsonObj = Fpbj10::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testDadosPessoaisEncontrados()
    {
        $args = array(903586,0);
        $jsonObj = Fpbj10::executa($args);
        $this->assertCodigo($jsonObj, Fpbj10::DADOS_PESSOAIS_ENCONTRADOS, $args);
    }

    public function testDadosPessoaisNaoEncontrados()
    {
        $args = array(903586,10);
        $jsonObj = Fpbj10::executa($args);
        $this->assertCodigo($jsonObj, Fpbj10::DADOS_PESSOAIS_NAO_ENCONTRADOS, $args);
    }

    public function testSequencialInvalido()
    {
        $args = array(903586, 112);
        $jsonObj = Fpbj10::executa($args);
        $this->assertCodigo($jsonObj, Fpbj10::SEQUENCIAL_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array("9asdf03586",0);
        $jsonObj = Fpbj10::executa($args);
        $this->assertCodigo($jsonObj, Fpbj10::MATRICULA_INVALIDA, $args);
    }

    public function testMatriculaObrigatorio()
    {
        $args = array('', 0);
        $jsonObj = Fpbj10::executa($args);
        $this->assertCodigo($jsonObj, Fpbj10::MATRICULA_OBRIGATORIO, $args);
    }

}
