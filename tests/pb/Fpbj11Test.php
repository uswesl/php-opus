<?php

namespace capesesp;

use capesesp\pb\Fpbj11;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj11Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj11.schema.json';
    }

    public function testSchema()
    {
        $args = array(46,0);
        $jsonObj = Fpbj11::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testDadosFuncionaisEncontrados()
    {
        $args = array(903586,0);
        $jsonObj = Fpbj11::executa($args);
        $this->assertCodigo($jsonObj, Fpbj11::DADOS_FUNCIONAIS_ENCONTRADOS, $args);
    }

    public function testDadosFuncionaisNaoEncontrados()
    {
        $args = array(903586,11);
        $jsonObj = Fpbj11::executa($args);
        $this->assertCodigo($jsonObj, Fpbj11::DADOS_FUNCIONAIS_NAO_ENCONTRADOS, $args);
    }

    public function testSequencialInvalido()
    {
        $args = array(903586, 112);
        $jsonObj = Fpbj11::executa($args);
        $this->assertCodigo($jsonObj, Fpbj11::SEQUENCIAL_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array("9asdf03586",0);
        $jsonObj = Fpbj11::executa($args);
        $this->assertCodigo($jsonObj, Fpbj11::MATRICULA_INVALIDA, $args);
    }

    public function testMatriculaObrigatorio()
    {
        $args = array();
        $jsonObj = Fpbj11::executa($args);
        $this->assertCodigo($jsonObj, Fpbj11::MATRICULA_OBRIGATORIO, $args);
    }

}
