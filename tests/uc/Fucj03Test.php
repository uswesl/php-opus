<?php

namespace capesesp;

use capesesp\uc\Fucj03;
use capesesp\json\OpusJsonTestCase;


/**
 * Testa programas Opus/JSON do Modulo UC do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fucj03Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setup();
        $this->schemaPath = './src/uc/schemas/fucj03.schema.json';
    }

    public function testSchema()
    {
        $jsonObj = Fucj03::executa();
        $this->assertSchema($jsonObj, $this->schemaPath);
    }
}
?>
