<?php

namespace capesesp;

use capesesp\rm\Frmj07;
use capesesp\json\OpusJsonTestCase;

/**
 * Teste para o programa Opus/Json do módulo RM do Sistema Central
 *
 * Para todos os testes algumas verificacoes precisam ser feitas pois 
 * os dados utilizados nestes testes podem não ser validos para outros periodos.
 * Data de credito, caso mantis precisam ser revisados antes de os testes serem executados.
 *
 */

class Frmj07Teste extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/rm/schemas/frmj07.schema.json';
    }

    public function testSchema()
    {
        $args = array('RJ', '20170224','903586','00246417','21','32491200');
        $jsonObj = Frmj07::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }


    public function testProcessoRegistrado()
    {
        $args = array('RJ', '20170224','903586','00246417','21','32491200');
        $jsonObj = Frmj07::executa($args);
        $this->assertCodigo($jsonObj, Frmj07::PROCESSO_REGISTRADO , $args);
    }

    public function testProcessoNaoRegistrado()
    {
        $args = array('RJ', '20170224','909586','00246417','21','32491200');
        $jsonObj = Frmj07::executa($args);
        $this->assertCodigo($jsonObj, Frmj07::PROCESSO_NAO_REGISTRADO, $args);
    }

    public function testTelefoneInvalido()
    {
        $args = array('RJ', '20170224','903586','00246417','21','adadfasdfas');
        $jsonObj = Frmj07::executa($args);
        $jsonObj = Frmj07::executa($args);
        $this->assertCodigo($jsonObj, Frmj07::TELEFONE_INVALIDO, $args);
    }

    public function testDDDInvalido()
    {
        $args = array('RJ', '20170224','903586','00246417','AA','32491200');
        $jsonObj = Frmj07::executa($args);
        $jsonObj = Frmj07::executa($args);
        $this->assertCodigo($jsonObj, Frmj07::DDD_INVALIDO, $args);
    }

    public function testCasoInvalido()
    {
        $args = array('RJ', '20170224','903586','aasas','21','32491200');
        $jsonObj = Frmj07::executa($args);
        $jsonObj = Frmj07::executa($args);
        $this->assertCodigo($jsonObj, Frmj07::CASO_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array('RJ', '20170224','aaaaaa','00246417','21','32491200');
        $jsonObj = Frmj07::executa($args);
        $jsonObj = Frmj07::executa($args);
        $this->assertCodigo($jsonObj, Frmj07::MATRICULA_INVALIDA, $args);
    }

    public function testDataInvalida()
    {
        $args = array('RJ', 'aaaaaa','903586','00246417','21','32491200');
        $jsonObj = Frmj07::executa($args);
        $jsonObj = Frmj07::executa($args);
        $this->assertCodigo($jsonObj, Frmj07::DATA_INVALIDA, $args);
    }

    public function testUfInvalida()
    {
        $args = array('XX', '20170224','903586','00246417','21','32491200');
        $jsonObj = Frmj07::executa($args);
        $jsonObj = Frmj07::executa($args);
        $this->assertCodigo($jsonObj, Frmj07::UF_INVALIDA, $args);
    }

}   
