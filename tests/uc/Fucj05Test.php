<?php

namespace capesesp;

use capesesp\uc\Fucj05;
use capesesp\json\OpusJsonTestCase;


/**
 * Testa programas Opus/JSON do Modulo UC do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fucj05Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/uc/schemas/fucj05.schema.json';
    }

    public function testSchema()
    {
        $args = ['0057633', '3', '20150428235959', 0];
        $jsonObj = Fucj05::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testDadosGravadosComSucesso()
    {
        $args = ['0057633', '3', '20150428235959',1];
        $jsonObj = Fucj05::executa($args);
        $this->assertCodigo($jsonObj, Fucj05::DADOS_GRAVADOS_COM_SUCESSO);
    }

    public function testNaoFoiPossivelGravar()
    {
        $args = ['903586', '38', '20150428235959',14];
        $jsonObj = Fucj05::executa($args);
        $this->assertCodigo($jsonObj, Fucj05::ASSOCIADO_NAO_ENCONTRADO);
    }
    
    public function testHoraInvalida()
    {
        $args = ['67183', '38', '20150428aaaaaa',14];
        $jsonObj = Fucj05::executa($args);
        $this->assertCodigo($jsonObj, Fucj05::HORA_INVALIDA);
    }

    public function testDataInvalida()
    {
        $args = ['67183', '38', 'aaaaaaaa235959',15];
        $jsonObj = Fucj05::executa($args);
        $this->assertCodigo($jsonObj, Fucj05::DATA_INVALIDA);
    }

    public function testSequencialInvalido()
    {
        $args = ['67183', 'a', '20150428235959',14];
        $jsonObj = Fucj05::executa($args);
        $this->assertCodigo($jsonObj, Fucj05::SEQUENCIAL_INVALIDO);
    }

    public function testMatriculaInvalida()
    {
        $args = ['qqqqqqq', '38', '20150428235959',14];
        $jsonObj = Fucj05::executa($args);
        $this->assertCodigo($jsonObj, Fucj05::MATRICULA_INVALIDA);
    }

    public function testNaoFoiPossivelGravarDadosAssociado(){

        $args = ['0057633', '3', '20150428235959',15];
        $jsonObj = Fucj05::executa($args);
        $this->assertCodigo($jsonObj, Fucj05::NAO_FOI_POSSIVEL_GRAVAR_DADOS_PARA_ASSOCIADO);
    }

}
?>
