<?php

namespace capesesp;

use capesesp\rm\Frmj02;
use capesesp\json\OpusJsonTestCase;

/**
 * Teste para o programa Opus/Json do módulo RM do Sistema Central
 */

class Frmj02Teste extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/rm/schemas/frmj02.schema.json';
    }

    public function testSchema()
    {
        $args = array('20160101');
        $jsonObj = Frmj02::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testRegistrosEncontrados()
    {
        $args = array('20170127');
        $jsonObj = Frmj02::executa($args);
        $this->assertCodigo($jsonObj, Frmj02::REGISTROS_ENCONTRADOS, $args);
    }

    public function testNenhumRegistroEntrado()
    {
        $args = array('19000101');
        $jsonObj = Frmj02::executa($args);
        $this->assertCodigo($jsonObj, Frmj02::NENHUM_REGISTRO_ENCONTRADO, $args);
    }

    public function testDataInvalida()
    {
        $args = array('asdasd');
        $jsonObj = Frmj02::executa($args);
        $this->assertCodigo($jsonObj, Frmj02::DATA_INVALIDA, $args);
    }

}
