<?php

namespace capesesp;

use capesesp\pb\Fpbj22;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj22Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj22.schema.json';
    }

    public function testSchema()
    {
        $args = array("46");
        $jsonObj = Fpbj22::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testPedidosEncontrados()
    {
        $args = array("46");
        $jsonObj = Fpbj22::executa($args);
        $this->assertCodigo($jsonObj, Fpbj22::PEDIDOS_ENCONTRADOS, $args);
    }


    public function testPedidosNaoEncontrados()
    {
        $args = array("4");
        $jsonObj = Fpbj22::executa($args);
        $this->assertCodigo($jsonObj, Fpbj22::PEDIDOS_NAO_ENCONTRADOS, $args);
    }

    public function testMatriculaNaoEncontrada()
    {
        $args = array("333");
        $jsonObj = Fpbj22::executa($args);
        $this->assertCodigo($jsonObj, Fpbj22::MATRICULA_NAO_ENCONTRADA, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array("4444444444");
        $jsonObj = Fpbj22::executa($args);
        $this->assertCodigo($jsonObj, Fpbj22::MATRICULA_INVALIDA, $args);
    }
    
}
