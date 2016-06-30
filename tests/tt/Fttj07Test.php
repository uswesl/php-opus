<?php

namespace capesesp;

use capesesp\tt\Fttj07;
use capesesp\json\OpusJsonTestCase;

/**
 * Testa programas Opus/JSON do Modulo TT do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fttj07Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/tt/schemas/fttj07.schema.json';
        $this->rootElementName = 'saidaFttj07';
    }

    public function testSchema()
    {
        $args = [1, 1, 'tpPgto', '012345', 'Exemplo de descricao de ocorrencia'];
        $jsonObj = Fttj07::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testOcorrenciaOk()
    {
        $args = [1, 1, 'tpPgto', '012345', 'Exemplo de descricao de ocorrencia'];
        $jsonObj = Fttj07::executa($args);
        $this->assertCodigo($jsonObj, Fttj07::OCORRENCIA_GRAVADA_COM_SUCESSO, $args);
    }

    public function testEventoInvalido()
    {
        $args = ['999'];
        $jsonObj = Fttj07::executa($args);
        $this->assertCodigo($jsonObj, Fttj07::EVENTO_INVALIDO_OU_NAO_ENCONTRADO, $args);
    }

    public function testTipoOcorrenciaInvalido()
    {
        $args = [1, 345, 'tpPgto', '012345', 'Exemplo de descricao de ocorrencia'];
        $jsonObj = Fttj07::executa($args);
        $this->assertCodigo($jsonObj, Fttj07::TIPO_DE_OCORRENCIA_INVALIDO, $args);
    }

    public function testCampoObrigatorio()
    {
        $args = [1, 1];
        $jsonObj = Fttj07::executa($args);
        $this->assertCodigo($jsonObj, Fttj07::PARAMETRO_CAMPO_OBRIGATORIO, $args);
    }

    public function testCodigoObrigatorio()
    {
        $args = [1, 1, 'tpPgto'];
        $jsonObj = Fttj07::executa($args);
        $this->assertCodigo($jsonObj, Fttj07::PARAMETRO_CODIGO_OBRIGATORIO, $args);
    }

    public function testDescricaoObrigatorio()
    {
        $args = [1, 1, 'tpPgto'];
        $jsonObj = Fttj07::executa($args);
        $this->assertCodigo($jsonObj, Fttj07::PARAMETRO_CODIGO_OBRIGATORIO, $args);
    }
}
?>
