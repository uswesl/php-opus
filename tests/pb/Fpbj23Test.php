<?php

namespace capesesp;

use capesesp\pb\Fpbj23;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj23Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj23.schema.json';
    }

    public function testSchema()
    {
        $args = array("46","0");
        $jsonObj = Fpbj23::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testDadosRetornados()
    {
        $args = array("46","0");
        $jsonObj = Fpbj23::executa($args);
        $this->assertCodigo($jsonObj, Fpbj23::DADOS_RETORNADOS, $args);
    }


    public function testMatriculaNaoEncontrada()
    {
        $args = array("333","0");
        $jsonObj = Fpbj23::executa($args);
        $this->assertCodigo($jsonObj, Fpbj23::MATRICULA_NAO_ENCONTRADA, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array("4444444444", "1");
        $jsonObj = Fpbj23::executa($args);
        $this->assertCodigo($jsonObj, Fpbj23::MATRICULA_INVALIDA, $args);
    }
    
}
