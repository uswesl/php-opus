<?php

namespace capesesp;

use capesesp\uc\Fucj06;
use capesesp\json\OpusJsonTestCase;


/**
 * Testa programas Opus/JSON do Modulo UC do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fucj06Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/uc/schemas/fucj06.schema.json';
    }

    public function testSchema()
    {
        $args = [879, 0];
        $jsonObj = Fucj06::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testDadosRetornadosComSucesso()
    {
        $args = [879, 0];
        $jsonObj = Fucj06::executa($args);
        $this->assertCodigo($jsonObj, Fucj06::DADOS_RETORNADOS_COM_SUCESSO, $args);
    }

    public function testNaoForamEncontradosDados()
    {
        $args = [903626, 0];
        $jsonObj = Fucj06::executa($args);
        $this->assertCodigo($jsonObj, Fucj06::NAO_FORAM_ENCONTRADOS_DADOS, $args);
    }
    
    public function testSequencialInvalido()
    {
        $args = [903626, 'aa'];
        $jsonObj = Fucj06::executa($args);
        $this->assertCodigo($jsonObj, Fucj06::SEQUENCIAL_INVALIDO, $args);
    }

    public function testMatriculaInvalida()
    {
        $args = ['9s0a3626', 0];
        $jsonObj = Fucj06::executa($args);
        $this->assertCodigo($jsonObj, Fucj06::SEQUENCIAL_INVALIDO, $args);
    }
}
?>
