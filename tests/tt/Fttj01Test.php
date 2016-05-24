<?php

namespace capesesp;

use capesesp\tt\Fttj01;
use capesesp\json\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo TT do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fttj01Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/tt/schemas/fttj01.schema.json';
        $this->rootElementName = 'saidaFttj01';
    }

    public function testSchema()
    {
        $args = array(201512, 0, 100, 1);
        $jsonObj = Fttj01::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }


    /*
    public function testRandomExample(){
        exec('node jsf.js ./src/tt/schemas/fttj01.schema.json', $result);
        $jsonObj = json_decode(implode($result));
        $this->assertSchema($jsonObj);
    }

    public function testEventosEncontrados()
    {
        $args = array('201512', 0, 100, 1);
        $jsonObj = Fttj01::executa($args);
        $this->assertCodigo($jsonObj, Fttj01::EVENTOS_ENCONTRADOS, $args);
    }
    public function testNenhumEventoEncontrado()
    {
        $args = array('201609', 0, 100, 1);
        $jsonObj = Fttj01::executa($args);
        $this->assertCodigo($jsonObj, Fttj01::NENHUM_EVENTO_ENCONTRADO, $args);
    }

    public function testCompetenciaInicialInvalida()
    {
        $jsonObj = Fttj01::executa('2016', 0, 100, 1);
        $this->assertCodigo($jsonObj, Fttj01::COMPETENCIA_INICIAL_INVALIDA);
    }

    public function testCompetenciaFinalInvalida()
    {
        $jsonObj = Fttj01::executa('201601', '-1', 100, 1);
        $this->assertCodigo($jsonObj, Fttj01::COMPETENCIA_INICIAL_INVALIDA);
    }

    public function testItensPorPaginaInvalido()
    {
        $jsonObj = Fttj01::executa('201601', '201605', -1, 1);
        $this->assertCodigo($jsonObj, Fttj01::ITENS_POR_PAGINA_INVALIDO);
    }

    public function testNumeroDePaginaInvalido()
    {
        $jsonObj = Fttj01::executa('201601', '201605', 100, -1);
        $this->assertCodigo($jsonObj, Fttj01::NUMERO_DE_PAGINA_INVALIDO);
    }
    */
}
?>
