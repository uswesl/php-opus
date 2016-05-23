<?php

namespace capesesp;

use capesesp\uc\Fucj04;
use capesesp\OpusJsonTestCase;


/**
 * Testa programas Opus/JSON do Modulo UC do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fucj04Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setup();
        $this->schemaPath = './src/uc/schemas/fucj04.schema.json';
    }

    public function testSchema()
    {
        $args = [903626, 0];
        $jsonObj = Fucj04::executa($args);
        $this->assertSchema($jsonObj, './src/uc/schemas/fucj04.schema.json', $args);
    }
}
?>
