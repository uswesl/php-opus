<?php

namespace capesesp;

use capesesp\pb\Fpbj21;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj21Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj21.schema.json';
    }

    public function testSchema()
    {
        $args = array("46","0",'324477'. date("Ymd") . mt_rand(0,999999),"20170101120008", "A" );
        $jsonObj = Fpbj21::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testRegistroRealizado()
    {
        $args = array("46","0",'324477'. date("Ymd") . mt_rand(0,999999),"20170101120008", "A" );
        $jsonObj = Fpbj21::executa($args);
        $this->assertCodigo($jsonObj, Fpbj21::REGISTRO_REALIZADO, $args);
    }

    public function testRegistroNaoRealizado()
    {
        $args = array("46","0","32447720170718123456","20170101120008", "A" );
        $jsonObj = Fpbj21::executa($args);
        $this->assertCodigo($jsonObj, Fpbj21::REGISTRO_NAO_REALIZADO, $args);
    }

    public function testMatriculaNaoEncontrada()
    {
        $args = array("45","0",'324477'.date("Ymd").mt_rand(0,999999),"20170101120008", "A" );
        $jsonObj = Fpbj21::executa($args);
        $this->assertCodigo($jsonObj, Fpbj21::MATRICULA_NAO_ENCONTRADA, $args);
    }
    
    public function testSequencialNaoEncontrado()
    {
        $args = array("4","12",'324477'.date("Ymd").mt_rand(0,999999),"20170101120008", "A" );
        $jsonObj = Fpbj21::executa($args);
        $this->assertCodigo($jsonObj, Fpbj21::SEQUENCIAL_NAO_ENCONTRADO, $args);
    }
 
    public function testAssociadoNaoPossuiiPlanoAssistencial()
    {
        $args = array("4","0",'324477'.date("Ymd").mt_rand(0,999999),"20170101120008", "A" );
        $jsonObj = Fpbj21::executa($args);
        $this->assertCodigo($jsonObj, Fpbj21::SEM_PLANO_ASSISTENCIAL, $args);
    }
    
    public function testSegmentacaoInvalida()
    {
        $args = array("46","0",'324477'. date("Ymd") . mt_rand(0,999999),"20170101120008", "D" );
        $jsonObj = Fpbj21::executa($args);
        $this->assertCodigo($jsonObj, Fpbj21::SEGMENTACAO_INVALIDA, $args);
    }

    public function testDataHoraInvalida()
    {
        $args = array("46","0",'324477'. date("Ymd") . mt_rand(0,999999),"01120008", "O" );
        $jsonObj = Fpbj21::executa($args);
        $this->assertCodigo($jsonObj, Fpbj21::DATA_HORA_INVALIDA, $args);
    }

    public function testProtocoloInvalido()
    {
        $args = array("46","0","aaaa","20170101120008", "A" );
        $jsonObj = Fpbj21::executa($args);
        $this->assertCodigo($jsonObj, Fpbj21::PROTOCOLO_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array("4i6","0",'324477'. date("Ymd") . mt_rand(0,999999),"20170101120008", "A" );
        $jsonObj = Fpbj21::executa($args);
        $this->assertCodigo($jsonObj, Fpbj21::MATRICULA_INVALIDA, $args);
    }

}
