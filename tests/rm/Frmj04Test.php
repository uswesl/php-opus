<?php

namespace capesesp;

use capesesp\rm\Frmj04;
use capesesp\json\OpusJsonTestCase;

/**
 * Teste para o programa Opus/Json do módulo RM do Sistema Central
 */

class Frmj04Teste extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/rm/schemas/frmj04.schema.json';
    }

    public function testSchema()
    {
        $args = array('20160101');
        $jsonObj = Frmj04::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    /**
     * Verificar o parametro passado, pois e uma data de credito se nao estiver no banco ira retornar codigo 2 e nao passara no teste
     */
    public function testRegistrosEncontrados()
    {
        $args = array('20170125');
        $jsonObj = Frmj04::executa($args);
        $this->assertCodigo($jsonObj, Frmj04::REGISTROS_ENCONTRADOS, $args);
    }

    public function testNenhumRegistroEntrado()
    {
        $args = array('19000101');
        $jsonObj = Frmj04::executa($args);
        $this->assertCodigo($jsonObj, Frmj04::NENHUM_REGISTRO_ENCONTRADO, $args);
    }

    public function testDataInvalida()
    {
        $args = array('asdasd');
        $jsonObj = Frmj04::executa($args);
        $this->assertCodigo($jsonObj, Frmj04::DATA_INVALIDA, $args);
    }

}
