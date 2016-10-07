<?php

namespace capesesp;

use capesesp\pb\Fpbj12;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj12Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj12.schema.json';
    }

    public function testSchema()
    {
        $args = array(903586,0);
        $jsonObj = Fpbj12::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testDadosBancariosEncontrados()
    {
        $args = array(903586,0);
        $jsonObj = Fpbj12::executa($args);
        $this->assertCodigo($jsonObj, Fpbj12::DADOS_BANCARIOS_ENCONTRADOS, $args);
    }

    public function testDadosBancariosNaoEncontrada()
    {
        $args = array(903586,12);
        $jsonObj = Fpbj12::executa($args);
        $this->assertCodigo($jsonObj, Fpbj12::DADOS_BANCARIOS_NAO_ENCONTRADOS, $args);
    }

    public function testSequencialInvalido()
    {
        $args = array(903586, 122);
        $jsonObj = Fpbj12::executa($args);
        $this->assertCodigo($jsonObj, Fpbj12::SEQUENCIAL_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array("9asdf03586",0);
        $jsonObj = Fpbj12::executa($args);
        $this->assertCodigo($jsonObj, Fpbj12::MATRICULA_INVALIDA, $args);
    }

    public function testMatriculaObrigatorio()
    {
        $args = array();
        $jsonObj = Fpbj12::executa($args);
        $this->assertCodigo($jsonObj, Fpbj12::MATRICULA_OBRIGATORIO, $args);
    }

}
