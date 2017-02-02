<?php

namespace capesesp;

use capesesp\sn\Fsnj04;
use capesesp\json\OpusJsonTestCase;


class Fsnj04Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/sn/schemas/fsnj04.schema.json';
    }

    public function testSchema()
    {
        $args = array(27901222000131);
        $jsonObj = Fsnj04::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testSenhasEncontradas()
    {
        $args = array(20170101);
        $jsonObj = Fsnj04::executa($args);
        $this->assertCodigo($jsonObj, Fsnj04::SENHAS_ENCONTRADAS, $args);
    }
    public function testSenhasNaoEncontradas()
    {
        $args = array(20200101);
        $jsonObj = Fsnj04::executa($args);
        $this->assertCodigo($jsonObj, Fsnj04::SENHAS_NAO_ENCONTRADO, $args);
    }
   
}

