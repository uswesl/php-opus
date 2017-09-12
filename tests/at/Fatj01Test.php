<?php

namespace capesesp;

use capesesp\at\Fatj01;
use capesesp\json\OpusJsonTestCase;


class Fatj01Test extends OpusJsonTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/at/schemas/fatj01.schema.json';
    }

    public function testSchema()
    {
        $args = array("46", "0");
        $jsonObj = Fatj01::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testProcedimentosEncontrados()
    {
        $args = array("46", "0");
        $jsonObj = Fatj01::executa($args);
        $this->assertCodigo($jsonObj, Fatj01::PROCEDIMENTOS_ENCONTRADOS, $args);
    }

    public function testProcedimentosNaoEncontrados()
    {
        $args = array("4", "0");
        $jsonObj = Fatj01::executa($args);
        $this->assertCodigo($jsonObj, Fatj01::PROCEDIMENTOS_NAO_ENCONTRADOS, $args);
    }

    public function testSequencialInvalido()
    {
        $args = array("46", "a");
        $jsonObj = Fatj01::executa($args);
        $this->assertCodigo($jsonObj, Fatj01::SEQUENCIAL_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = array("qq", "0");
        $jsonObj = Fatj01::executa($args);
        $this->assertCodigo($jsonObj, Fatj01::MATRICULA_INVALIDA, $args);
    }

    public function testBeneficiarioNaoEncontrado()
    {
        $args = array("1", "0");
        $jsonObj = Fatj01::executa($args);
        $this->assertCodigo($jsonObj, Fatj01::BENEFICIARIO_NAO_ENCONTRADO, $args);
    }

}
