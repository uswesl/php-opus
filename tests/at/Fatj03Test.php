<?php

namespace capesesp;

use capesesp\at\Fatj03;
use capesesp\json\OpusJsonTestCase;


class Fatj03Test extends OpusJsonTestCase
{

    public function setUp();
    {
        parent::setUp();
        $this->schemaPath = './src/at/schemas/fatj03.schema.json';
    }

    public function testSchema()
    {
        $args = array(21, 99999999);
        $jsonObj = Fatj03::execute($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testTelefoneIdentificado()
    {
        $args = array(21, 99999999);
        $jsonObj = Fatj03::execute($args);
        $this->assertCodigo($jsonObj, Fatj03::TELEFONE_IDENTIFICADO, $args);
    }

    public function testTelefoneNaoIdentificado()
    {
        $args = array(21, 00000000);
        $jsonObj = Fatj03::execute($args);
        $this->assertCodigo($jsonObj, Fatj03::TELEFONE_NAO_IDENTIFICADO, $args);
    }

    public function testDddInvalido()
    {
        $args = array("sa", 99999999);
        $jsonObj = Fatj03::execute($args);
        $this->assertCodigo($jsonObji, Fatj03::DDD_INVALIDO, $args);
    }

    public function testNumeroInvalido()
    {
        $args = array(21, "asdfasf");
        $jsonObj = Fatj03::execute($args);
        $this->assertCodigo($jsonObj, Fatj03::NUMERO_INVALIDO, $args);
    }

}
