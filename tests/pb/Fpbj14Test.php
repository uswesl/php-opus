<?php

namespace capesesp;

use capesesp\pb\Fpbj14;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj14Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj14.schema.json';
    }

    public function testSchema()
    {
        $args = array(903586,0);
        $jsonObj = Fpbj14::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testDadosPrevidenciaisEncontrados()
    {
        $args = array(46,0);
        $jsonObj = Fpbj14::executa($args);
        $this->assertCodigo($jsonObj, Fpbj14::DADOS_PREVIDENCIAIS_ENCONTRADOS, $args);
    }

    public function testDadosPrevidenciaisNaoEncontrados()
    {
        $args = array(903626,14);
        $jsonObj = Fpbj14::executa($args);
        $this->assertCodigo($jsonObj, Fpbj14::DADOS_PREVIDENCIAIS_NAO_ENCONTRADOS, $args);
    }

    public function testSequencialInvalido()
    {
        $args = array(903586, 142);
        $jsonObj = Fpbj14::executa($args);
        $this->assertCodigo($jsonObj, Fpbj14::SEQUENCIAL_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array("9asdf03586",0);
        $jsonObj = Fpbj14::executa($args);
        $this->assertCodigo($jsonObj, Fpbj14::MATRICULA_INVALIDA, $args);
    }

    public function testMatriculaObrigatorio()
    {
        $args = array();
        $jsonObj = Fpbj14::executa($args);
        $this->assertCodigo($jsonObj, Fpbj14::MATRICULA_OBRIGATORIO, $args);
    }

}
