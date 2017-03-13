<?php

namespace capesesp;

use capesesp\rm\Frmj05;
use capesesp\json\OpusJsonTestCase;

/**
 * Teste para o programa Opus/Json do módulo RM do Sistema Central
 */

class Frmj05Teste extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/rm/schemas/frmj05.schema.json';
    }

    public function testSchema()
    {
        $args = array('20160101');
        $jsonObj = Frmj05::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    /**
     * Verificar o parametro passado, pois deve ser uma data atual
     */
    public function testRegistrosEncontrados()
    {
        $args = array('20170201');
        $jsonObj = Frmj05::executa($args);
        $this->assertCodigo($jsonObj, Frmj05::REGISTROS_ENCONTRADOS, $args);
    }

    public function testNenhumRegistroEntrado()
    {
        $args = array('19000101');
        $jsonObj = Frmj05::executa($args);
        $this->assertCodigo($jsonObj, Frmj05::NENHUM_REGISTRO_ENCONTRADO, $args);
    }

    public function testDataInvalida()
    {
        $args = array('asdasd');
        $jsonObj = Frmj05::executa($args);
        $this->assertCodigo($jsonObj, Frmj05::DATA_INVALIDA, $args);
    }

}
