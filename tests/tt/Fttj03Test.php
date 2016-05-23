<?php

namespace capesesp;

use capesesp\tt\Fttj03;
use capesesp\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo TT do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fttj03Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/tt/schemas/fttj03.schema.json';
        $this->rootElementName = 'saidaFttj03';
    }

    public function testSchema()
    {
        $args = [2015, 0];
        $jsonObj = Fttj03::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }
}
?>
