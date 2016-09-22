<?php

namespace capesesp;

use capesesp\pb\Fpbj09;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj09Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj09.schema.json';
    }

    public function testSchema()
    {
        $args = array(903586,0);
        $jsonObj = Fpbj09::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testPessoaEncontrada()
    {
        $args = array(903586,0);
        $jsonObj = Fpbj09::executa($args);
        $this->assertCodigo($jsonObj, Fpbj09::PESSOA_ENCONTRADA, $args);
    }

    public function testPessoaNaoEncontrada()
    {
        $args = array(903586,5);
        $jsonObj = Fpbj09::executa($args);
        $this->assertCodigo($jsonObj, Fpbj09::PESSOA_NAO_ENCONTRADA, $args);
    }

    public function testSequencialInvalido()
    {
        $args = array(903586,999);
        $jsonObj = Fpbj09::executa($args);
        $this->assertCodigo($jsonObj, Fpbj09::SEQUENCIAL_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array('90qwqwq3586',0);
        $jsonObj = Fpbj09::executa($args);
        $this->assertCodigo($jsonObj, Fpbj09::MATRICULA_INVALIDA, $args);
    }

    public function testMatriculaObrigatorio()
    {
        $args = array('', 0);
        $jsonObj = Fpbj09::executa($args);
        $this->assertCodigo($jsonObj, Fpbj09::MATRICULA_OBRIGATORIO, $args);
    }


}
