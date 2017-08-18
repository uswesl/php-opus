<?php

namespace capesesp;

use capesesp\at\Fatj03;
use capesesp\json\OpusJsonTestCase;


class Fatj03Test extends OpusJsonTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/at/schemas/fatj03.schema.json';
    }

    public function testSchema()
    {
        $args = array(550021032539017);
        $jsonObj = Fatj03::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testTelefoneIdentificado()
    {
        $args = array(550021999589912);
        $jsonObj = Fatj03::executa($args);
        $this->assertCodigo($jsonObj, Fatj03::TELEFONE_IDENTIFICADO, $args);
    }

    public function testTelefoneNaoIdentificado()
    {
        $args = array(550021016023456);
        $jsonObj = Fatj03::executa($args);
        $this->assertCodigo($jsonObj, Fatj03::TELEFONE_NAO_IDENTIFICADO, $args);
    }

    public function testNumeroInvalido()
    {
        $args = array("asdfasf");
        $jsonObj = Fatj03::executa($args);
        $this->assertCodigo($jsonObj, Fatj03::NUMERO_INVALIDO, $args);
    }

}
