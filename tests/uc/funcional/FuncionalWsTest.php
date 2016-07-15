<?php

namespace capesesp;

use capesesp\Config;
use capesesp\soap\SoapTestCase;
use capesesp\uc\funcional\FuncionalWs;
use capesesp\util\Faker;

/**
 * Testes do Web Service de "Movimentação de usuário" da Funcional Card
 */
class FuncionalWsTest extends SoapTestCase
{
    /**
     * Executado antes de cada teste
     */
    public function setUp()
    {
        putenv('ENVIRONMENT=test');
        $this->rootElementName = 'MovimentacaoUsuarioResult';
        $this->soapClient = FuncionalWs::getSoapClient();
    }

    /**
     * Executado ao final de cada teste
     */
    public function tearDown()
    {
        putenv('ENVIRONMENT'); // = unset
    }

    /**
     * Retorna dados para requisição ao web service
     * @param $name nome do arquivo json com dados da requisicao
     * @return Objeto PHP com dados do request
     */
    public function getRequest($name)
    {
        $path = "./tests/uc/funcional/fixtures/$name.json";
        $contents = file_get_contents($path);
        $request = json_decode($contents);
        return $request;
    }

    public function testNaoAutenticadoLoginOuSenhaInvalido()
    {
        $request  = $this->getRequest('nao-autenticado-login-ou-senha-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::NAO_AUTENTICADO_LOGIN_OU_SENHA_INVALIDO);
    }

    public function testBeneficiarioIncluidoComSucesso()
    {
        $request  = $this->getRequest('beneficiario-incluido-com-sucesso');
        $request->cpf = Faker::cpf();
        $request->matricula = Faker::matricula();
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::BENEFICIARIO_INCLUIDO_COM_SUCESSO);
    }

    public function testBeneficiarioAtualizadoComSucesso()
    {
        $request  = $this->getRequest('beneficiario-atualizado-com-sucesso');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::BENEFICIARIO_ATUALIZADO_COM_SUCESSO);
    }

    public function testBeneficiarioBloqueadoComSucesso()
    {
        $request  = $this->getRequest('beneficiario-bloqueado-com-sucesso');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::BENEFICIARIO_BLOQUEADO_COM_SUCESSO);
    }

}
