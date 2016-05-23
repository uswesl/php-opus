<?php

namespace capesesp;

use capesesp\uc\Fucj05;
use capesesp\OpusJsonTestCase;


/**
 * Testa programas Opus/JSON do Modulo UC do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fucj05Test extends OpusJsonTestCase
{
    public function setUp()
    {
        $this->schemaPath = './src/uc/schemas/fucj05.schema.json';
    }

    public function testSchema()
    {
        $args = [903626, 0, '20150428', '235959'];
        $jsonObj = Fucj05::executa($args);
        $this->assertSchema($jsonObj, './src/uc/schemas/fucj05.schema.json', $args);
    }
}
?>
