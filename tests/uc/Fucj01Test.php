<?php

namespace capesesp;

use capesesp\uc\Fucj01;
use capesesp\json\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo UC do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fucj01Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/uc/schemas/fucj01.schema.json';
    }

    public function testSchema()
    {
        $args = [903626, 0];
        $jsonObj = Fucj01::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testMatriculaNaoVinculadaAoPlano()
    {
        $args = [903626, 0];
        $jsonObj = Fucj01::executa($args);
        $this->assertFalse($jsonObj->elegivel);
        $this->assertCodigo($jsonObj, Fucj01::MATRICULA_NAO_VINCULADA_AO_PLANO, $args);
    }
}
?>
