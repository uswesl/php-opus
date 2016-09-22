<?php

namespace capesesp;

use capesesp\pb\Fpbj16;
use capesesp\json\OpusJsonTestCase;

/**
* Teste o programa Opus/Json do módulo PB do Sistema Central
*
* O teste executa o programa Opus/Json em ambiente de desenvolvimento, validando o resultado
* contra um arquivo JSON Schema (http://json-schema.org/)
*/
class Fpbj16Test extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj16.schema.json';
    }

    public function testSchema()
    {
        $args = array('Max');
        $jsonObj = Fpbj16::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath);
    }

    public function testDadosPessoaisEncontrados()
    {
        $args = array('Max');
        $jsonObj = Fpbj16::executa($args);
        $this->assertCodigo($jsonObj, Fpbj16::PESSOAS_ENCONTRADAS, $args);
    }

    public function testPessoaNaoEncontrada()
    {
        $args = array('aaaaaaaaa');
        $jsonObj = Fpbj16::executa($args);
        $this->assertCodigo($jsonObj, Fpbj16::PESSOAS_NAO_ENCONTRADAS, $args);
    }

    public function testNomeInvalido()
    {
        $args = array('João 123123 & #');
        $jsonObj = Fpbj16::executa($args);
        $this->assertCodigo($jsonObj, Fpbj16::NOME_INVALIDO, $args);
    }

    public function testNomeTamanhoMinimoInvalido()
    {
        $args = array('as');
        $jsonObj = Fpbj16::executa($args);
        $this->assertCodigo($jsonObj, Fpbj16::TAMANHO_MINIMO_INVALIDO, $args);
    }

    public function testNomeObrigatorio()
    {
        $args = array('');
        $jsonObj = Fpbj16::executa($args);
        $this->assertCodigo($jsonObj, Fpbj16::NOME_OBRIGATORIO, $args);
    }

}
