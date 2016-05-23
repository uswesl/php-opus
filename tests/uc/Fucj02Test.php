<?php

namespace capesesp;

use capesesp\uc\Fucj02;
use capesesp\OpusJsonTestCase;


/**
 * Testa programas Opus/JSON do Modulo UC do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fucj02Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setup();
        $this->schemaPath = './src/uc/schemas/fucj02.schema.json';
    }

    public function testSchema()
    {
        $args = [1, 903626, 0, 'RJ', 1, 'Nome do medico', '20160101', 20, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }
}
?>
