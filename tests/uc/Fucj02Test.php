<?php

namespace capesesp;

use capesesp\uc\Fucj02;
use capesesp\json\OpusJsonTestCase;


/**
 * Testa programas Opus/JSON do Modulo UC do Sistema Central
 *
 * O teste executa o programa Opus/JSON em ambiente de desenvolvimento, validando o resultado
 * contra um arquivo JSON Schema (http://json-schema.org/).
 */
class Fucj02Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/uc/schemas/fucj02.schema.json';
    }

    public function testSchema()
    {
        $args = [mt_rand(0,9999999), 46, 0, "RJ", 11111, "Nome", "20160101", 20, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }

    public function testVersaoInvalida()
    {
        $args = [mt_rand(0,9999999), 46, 0, 'RJ', 11111, 'Nome', '20160101', 20, 3];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::VERSAO_INVALIDA,$args);

    }

    public function testCodDeferimentoInvalido()
    {
        $args = [mt_rand(0,9999999), 46, 0, 'RJ', 11111, 'Nome', '20160101', 500, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::COD_DEFERIMENTO_INVALIDO,$args);

    }

    public function testDataReceitaInvalida()
    {
        $args = [mt_rand(0,9999999), 46, 0, 'RJ', 11111, 'Nome', '201sdf01', 20, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::DATA_RECEITA_INVALIDA,$args);

    }

    public function testNomeMedicoObrigatorio()
    {
        $args = [mt_rand(0,9999999), 46, 0, 'RJ', 11111];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::NOME_MEDICO_OBRIGATORIO,$args);

    }

    public function testCrmInvalido()
    {
        $args = [mt_rand(0,9999999), 46, 0, 'RJ', 'aaa', 'Nome', '20160101', 20, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::CRM_INVALIDO,$args);

    }

    public function testUfCrmInvalido()
    {
        $args = [mt_rand(0,9999999), 46, 0, 'XX', 11111, 'Nome', '20160101', 20, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::UFCRM_INVALIDO,$args);

    }

    public function testSequencialInvalido()
    {
        $args = [mt_rand(0,9999999), 46, 'a', 'RJ', 11111, 'Nome', '20160101', 20, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::SEQUENCIAL_INVALIDO,$args);

    }
    
    public function testMatriculaInvalida()
    {
        $args = [mt_rand(0,9999999), 'a46', 0, 'RJ', 11111, 'Nome', '20160101', 20, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::MATRICULA_INVALIDA,$args);

    }

    public function testProcessoInvalido()
    {
        $args = [mt_rand(0,9999999999), 46, 0, 'RJ', 11111, 'Nome', '20160101', 20, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::PROCESSO_INVALIDO,$args);

    }

    public function testBeneficiarioNaoEncontrado()
    {
        $args = [mt_rand(0,9999999), 8, 0, 'RJ', 11111, 'Nome', '20160101', 20, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::BENEFICARIO_NAO_ENCONTRADO,$args);

    }

    public function testProcessoAtualizado()
    {
        $args = [mt_rand(0,9999999), 46, 0, 'RJ', 11111, 'Nome', '20160101', 20, 2];
        $jsonObj = Fucj02::executa($args);
        $this->assertCodigo($jsonObj,Fucj02::PROCESSO_ATUALIZADO_SUCESSO,$args);

    }

}

