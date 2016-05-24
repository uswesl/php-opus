<?php

namespace capesesp;

use capesesp\tt\Fttj04;
use capesesp\json\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo TT do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fttj04Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/tt/schemas/fttj04.schema.json';
        $this->rootElementName = 'saidaFttj04';
    }

    public function testSchema()
    {
        $jsonObj = Fttj04::executa();
        $this->assertSchema($jsonObj, $this->schemaPath);
    }


}
?>
