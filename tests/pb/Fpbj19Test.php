<?php

namespace capesesp;

use capesesp\pb\Fpbj19;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj19Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj19.schema.json';
    }

    public function testSchema()
    {
        $args = array();
        $jsonObj = Fpbj19::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testTransacoesRetornadas()
    {
        $args = array("903586 0");
        $jsonObj = Fpbj19::executa($args);
        $this->assertCodigo($jsonObj, Fpbj19::TRANSACOES_RETORNADAS, $args);
    }

    public function testTransacoesNaoEncontradas()
    {
        $args = array();
        $jsonObj = Fpbj17::executa($args);
        $this->assertCodigo($jsonObj, Fpbj19::TRANSACOES_NAO_RETORNADAS, $args);
    }
    
    public function testSequencialInvalido()
    {
        $args = array();
        $jsonObj = Fpbj19::executa($args);
        $this->assertCodigo($jsonObj, Fpbj19::SEQUENCIAL_INVALIDO, $args);
    }
    
    public function testMatriculaInvalida()
    {
        $args = array();
        $jsonObj = Fpbj19::executa($args);
        $this->assertCodigo($jsonObj, Fpbj19::MATRICULA_INVALIDA, $args);
    }

}
