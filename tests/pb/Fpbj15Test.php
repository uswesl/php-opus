<?php

namespace capesesp;

use capesesp\pb\Fpbj15;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj15Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj15.schema.json';
    }

    public function testSchema()
    {
        $args = array(20160101000000,20160101160000);
        $jsonObj = Fpbj15::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testPessoasEncontradas()
    {
        $args = array(20160101000000,2016010116000000);
        $jsonObj = Fpbj15::executa($args);
        $this->assertCodigo($jsonObj, Fpbj15::PESSOAS_ENCONTRADAS, $args);
    }

    public function testPessoaNaoEncontrada()
    {
        $args = array(20161101101010,20161110101010);
        $jsonObj = Fpbj15::executa($args);
        $this->assertCodigo($jsonObj, Fpbj15::PESSOAS_NAO_ENCONTRADAS, $args);
    }

    public function testDataInicialInvalida()
    {
        $args = array(231513,20161110101010);
        $jsonObj = Fpbj15::executa($args);
        $this->assertCodigo($jsonObj, Fpbj15::DATA_INICIAL_INVALIDA, $args);
    }

    public function testDataFinalInvalida()
    {
        $args = array(20161101101010,1245);
        $jsonObj = Fpbj15::executa($args);
        $this->assertCodigo($jsonObj, Fpbj15::DATA_FINAL_INVALIDA, $args);
    }

    public function testDataInicialObrigatorio()
    {
        $args = array();
        $jsonObj = Fpbj15::executa($args);
        $this->assertCodigo($jsonObj, Fpbj15::DATA_INICIAL_OBRIGATORIA, $args);
    }

    public function testDataFinalObrigatorio()
    {
        $args = array(20160101101010, '');
        $jsonObj = Fpbj15::executa($args);
        $this->assertCodigo($jsonObj, Fpbj15::DATA_FINAL_OBRIGATORIA, $args);
    }

}
