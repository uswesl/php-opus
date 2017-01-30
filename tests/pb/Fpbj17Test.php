<?php

namespace capesesp;

use capesesp\pb\Fpbj17;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj17Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj17.schema.json';
    }

    public function testSchema()
    {
        $args = array();
        $jsonObj = Fpbj17::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testSchemaParametro()
    {
        $args = array("t");
        $jsonObj = Fpbj17::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testRetornadosBeneficiarios()
    {
        $args = array();
        $jsonObj = Fpbj17::executa($args);
        $this->assertCodigo($jsonObj, Fpbj17::RETORNADOS_BENEFICIARIOS, $args);
    }

}
