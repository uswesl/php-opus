<?php

namespace capesesp;

use capesesp\at\Fatj04;
use capesesp\json\OpusJsonTestCase;


class Fatj04Test extends OpusJsonTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/at/schemas/fatj04.schema.json';
    }

    public function testSchema()
    {
        $args = array("URA", "1312312", "CREDENCIADO", "CNPJ", "12345678912345", "Clinica", "RAZAO_SOCIAL", "33333333", "132123132132131", "2", "Credenciado");
        $jsonObj = Fatj04::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testProtocoloAtualizado()
    {
        $args = array("URA", "1312312", "CREDENCIADO", "CNPJ", "12345678912345", "Clinica", "RAZAO_SOCIAL", "33333333", "132123132132131", "2", "Credenciado");
        $jsonObj = Fatj04::executa($args);
        $this->assertCodigo($jsonObj, Fatj04::PROTOCOLO_ATUALIZADO, $args);
    }

    public function testSistemaOrigemInvalido()
    {
        $args = array("BLA", "1312312", "CREDENCIADO", "CNPJ", "12345678912345", "Clinica", "RAZAO_SOCIAL", "33333333", "132123132132131", "2", "Credenciado");
        $jsonObj = Fatj04::executa($args);
        $this->assertCodigo($jsonObj, Fatj04::SISTEMA_ORIGEM_INVALIDO, $args);
    }
  
    public function testUidOrigemInvalido()
    {
        $args = array("URA", "aaaa", "CREDENCIADO", "CNPJ", "12345678912345", "Clinica", "RAZAO_SOCIAL", "33333333", "132123132132131", "2", "Credenciado");
        $jsonObj = Fatj04::executa($args);
        $this->assertCodigo($jsonObj, Fatj04::UID_ORIGEM_INVALIDO, $args);
    }

    public function testTipoSolicitanteInvalido()
    {
        $args = array("URA", "123456", "FUNC", "CNPJ", "12345678912345", "Clinica", "RAZAO_SOCIAL", "33333333", "132123132132131", "2", "Credenciado");
        $jsonObj = Fatj04::executa($args);
        $this->assertCodigo($jsonObj, Fatj04::TIPO_SOLICITANTE_INVALIDO, $args);
    }

    public function testTipoIdSolicitanteInvalido()
    {
        $args = array("URA", "123456", "CREDENCIADO", "J", "12345678912345", "Clinica", "RAZAO_SOCIAL", "33333333", "132123132132131", "2", "Credenciado");
        $jsonObj = Fatj04::executa($args);
        $this->assertCodigo($jsonObj, Fatj04::TIPO_ID_SOLICITANTE_INVALIDO, $args);
    }
    
    public function testNomeSolicitanteInvalido()
    {
        $args = array("URA", "123456", "CREDENCIADO", "J", "12345678912345");
        $jsonObj = Fatj04::executa($args);
        $this->assertCodigo($jsonObj, Fatj04::NOME_SOLICITANTE_INVALIDO, $args);
    }

    public function testTipoNomeInvalido()
    {
        $args = array("URA", "123456", "CREDENCIADO", "J", "12345678912345", "Clinica", "RAZAO", "33333333", "132123132132131", "2", "Credenciado");
        $jsonObj = Fatj04::executa($args);
        $this->assertCodigo($jsonObj, Fatj04::TIPO_NOME_INVALIDO, $args);
    }




}
