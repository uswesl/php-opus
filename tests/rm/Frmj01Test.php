<?php

namespace capesesp;

use capesesp\rm\Frmj01;
use capesesp\json\OpusJsonTestCase;

/**
 * Teste para o programa Opus/Json do módulo RM do Sistema Central
 */

class Frmj01Teste extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/rm/schemas/frmj01.schema.json';
    }

    public function testSchema()
    {
        $args = array('20170127');
        $jsonObj = Frmj01::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testRegistrosEncontrados()
    {
        $args = array('20170127');
        $jsonObj = Frmj01::executa($args);
        $this->assertCodigo($jsonObj, Frmj01::REGISTROS_ENCONTRADOS, $args);
    }

    public function testNenhumRegistroEntrado()
    {
        $args = array('19000101');
        $jsonObj = Frmj01::executa($args);
        $this->assertCodigo($jsonObj, Frmj01::NENHUM_REGISTRO_ENCONTRADO, $args);
    }

    public function testDataInvalida()
    {
        $args = array('asdasd');
        $jsonObj = Frmj01::executa($args);
        $this->assertCodigo($jsonObj, Frmj01::DATA_INVALIDA, $args);
    }

}
