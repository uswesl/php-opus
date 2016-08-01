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

    public function testBeneficiarioDesBloqueadoComSucesso()
    {
        $request  = $this->getRequest('beneficiario-desbloqueado-com-sucesso');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::BENEFICIARIO_DESBLOQUEADO_COM_SUCESSO);
    }

    public function testCodigoClienteInvalido()
    {
        $request  = $this->getRequest('codigo-cliente-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CODIGO_DE_CLIENTE_INVALIDO);

	$request->codcli = "x";
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CODIGO_DE_CLIENTE_INVALIDO);
    }

   public function testCodigoBeneficiarioNaoEncontrado()
    {
        $request  = $this->getRequest('codigo-beneficiario-nao-encontrado');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CODIGO_DE_BENEFICIARIO_NAO_ENCONTRADO);
    }

    public function testChaveNaoEncontrada()
    {
        $request  = $this->getRequest('chave-nao-encontrada');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CHAVE_CPF_CODCLIENTE_NUMDEP_NAO_ENCONTRADO);

	$request->instrucao="A";
	$response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CHAVE_CPF_CODCLIENTE_NUMDEP_NAO_ENCONTRADO);

	$request->instrucao="E";
	$response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CHAVE_CPF_CODCLIENTE_NUMDEP_NAO_ENCONTRADO);
    }

    public function testChaveDuplicada()
    {
        $request  = $this->getRequest('chave-duplicada');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CHAVE_CPF_CODCLIENTE_NUMDEP_DUPLICADA);
    }

    public function testLogradouroInvalido()
    {
        $request  = $this->getRequest('logradouro-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::LOGRADOURO_INVALIDO_OU_INEXISTENTE);
    }

    public function testBairroInvalido()
    {
        $request  = $this->getRequest('bairro-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::BAIRRO_INVALIDO_OU_INEXISTENTE);
    }

    public function testBeneficiarioNaoEncontradoDiferenteInclusao()
    {
        $request  = $this->getRequest('codigo-beneficiario-nao-encontrado');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::BENEFICIARIO_NAO_ENCONTRADO_PARA_OPERACAO_DIFERENTE_DE_INCLUSAO);
    }

    public function testCepEntregaInvalido()
    {
        $request  = $this->getRequest('cep-entrega-invalido');

        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CEP_ENTREGA_INVALIDO);
    }

    public function testUFEntregaInvalida()
    {
        $request  = $this->getRequest('uf-entrega-invalida');

        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::UF_ENTREGA_INVALIDA);

	$request->uf_entrega = "XU";
	$response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::UF_ENTREGA_INVALIDA);
    }

    public function testCidadeEntregaInvalida()
    {
        $request  = $this->getRequest('cidade-entrega-invalida');

        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CIDADE_ENTREGA_INVALIDA);
    }

    public function testMatriculaPossuiLimite()
    {
        $request  = $this->getRequest('matricula-possui-limite');

        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::MATRICULA_POSSUI_LIMITE_DE_7_CARACTERES);
    }

    public function testDebitoFolhaInvalido()
    {
        $request  = $this->getRequest('debito-folha-invalido');

        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::DEBITO_FOLHA_INVALIDO);
    }

    public function testAmucInvalido()
    {
        $request  = $this->getRequest('amuc-invalido');

        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::AMUC_INVALIDO);
    }

    public function testAutorizaContatoInvalido()
    {
        $request  = $this->getRequest('autoriza-contato-invalido');

        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::AUTORIZA_CONTATO_INVALIDO);
    }

    public function testLimiteInvalido()
    {
        $request  = $this->getRequest('limite-invalido');

        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::LIMITE_INVALIDO);
    }

    public function testValoresNegativos()
    {

	$non_negative_fields = array(
                        "cpf", 
                        "numdep",
                        "codcli",
                        "codcartao",
                        "matricula",
                        "filial",
                        "limite",
                        "endereco_numero",
                        "cpf_dependente",
                        "endereco_numero_entrega",
                        "codcli_destino",
                        "grc_codigo"
                        );

        foreach($non_negative_fields as $field){

                $request  = $this->getRequest('beneficiario-atualizado-com-sucesso');
                $request->{$field} = -1;
                $response = $this->soapClient->MovimentacaoUsuario($request);
                $this->assertCodigo($request, $response, FuncionalWs::CAMPO_NAO_PERMITE_VALORES_MENORES_QUE_ZERO);

        }

    }


    public function testValoresNulos()
    {

	$non_nullable_fields = array(
			"login",
			"password",
			"cpf", 
			"numdep",
			"codcli",
			"instrucao",
  			"codcartao",
  			"matricula",
  			"nomusu",
  			"sexo",
  			"amuc",
  			"datanasc",
  			"filial",
  			"setor",
  			"limite",
  			"tipo_logradouro",
  			"endereco",
  			"endereco_numero",
  			"complemento",
  			"bairro",
  			"cidade",
  			"uf",
  			"cep",
  			"telefone",
  			"celular",
  			"email",
  			"autorizaContato",
  			"cpf_dependente",
  			"debito_folha",
 			"tipo_logradouro_entrega",
  			"endereco_entrega",
  			"endereco_numero_entrega",
  			"complemento_entrega",
  			"bairro_entrega",
  			"cidade_entrega",
  			"uf_entrega",
  			"cep_entrega",
  			"codcli_destino",
  			"grc_codigo"
			);

	foreach($non_nullable_fields as $field){

        	$request  = $this->getRequest('beneficiario-atualizado-com-sucesso');
        	$request->{$field} = "";
        	$response = $this->soapClient->MovimentacaoUsuario($request);
        	$this->assertCodigo($request, $response, FuncionalWs::CAMPO_NAO_PERMITE_VALORES_NULOS);

	}

    }


    public function testLimiteCaracteres()
    {

        $limited_fields = array(
                        "login",
                        "password",
                        "cpf", 
                        "numdep",
                        "codcli",
                        "instrucao",
                        "codcartao",
                        "matricula",
                        "nomusu",
                        "sexo",
                        "amuc",
                        "datanasc",
                        "filial",
                        "setor",
                        "limite",
                        "tipo_logradouro",
                        "endereco",
                        "endereco_numero",
                        "complemento",
                        "bairro",
                        "cidade",
                        "uf",
                        "cep",
                        "telefone",
                        "celular",
                        "email",
                        "autorizaContato",
                        "cpf_dependente",
                        "debito_folha",
                        "tipo_logradouro_entrega",
                        "endereco_entrega",
                        "endereco_numero_entrega",
                        "complemento_entrega",
                        "bairro_entrega",
                        "cidade_entrega",
                        "uf_entrega",
                        "cep_entrega",
                        "codcli_destino",
                        "grc_codigo"
                        );

        foreach($limited_fields as $field){

                $request  = $this->getRequest('beneficiario-atualizado-com-sucesso');
                $request->{$field} = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam dictum ultrices dignissim. Nam dapibus amet.";
                $response = $this->soapClient->MovimentacaoUsuario($request);
                $this->assertCodigo($request, $response, FuncionalWs::CAMPO_POSSUI_LIMITE_DE_CARACTERES);
	}

   }



    public function testValoresForaFaixa()
    {

 	$request  = $this->getRequest('valores-fora-da-faixa');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CAMPO_VALOR_FORA_DA_FAIXA);

    }

    public function testNaoFoiPossivelAbreviarNomeFornecido()
    {

        $request  = $this->getRequest('nao-foi-possivel-abreviar-nome-fornecido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::NAO_FOI_POSSIVEL_ABREVIAR_O_NOME_FORNECIDO);

    }

    public function testTitularDeveSerCadastradoAntesDosDependentes()
    {
        $request  = $this->getRequest('titular-deve-ser-cadastrado-antes-dos-dependentes');

        $request->cpf = Faker::cpf();
        $request->matricula = Faker::matricula();

        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::TITULAR_DEVE_SER_CADASTRADO_ANTES_DOS_DEPENDENTES);
    }


    public function testNumDepInvalido()
    {

        $request  = $this->getRequest('num-dep-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::NUMDEP_INVALIDO);

    }

    public function testCodigoCartaoInvalido()
    {

        $request  = $this->getRequest('codigo-cartao-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CODIGO_DO_CARTAO_INVALIDO);

    }

    public function testFilialInvalida()
    {

        $request  = $this->getRequest('filial-invalida');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::FILIAL_INVALIDA);

    }

    public function testMatriculaInvalida()
    {

        $request  = $this->getRequest('matricula-invalida');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::MATRICULA_INVALIDA);

    }

    public function testSetorInvalido()
    {

        $request  = $this->getRequest('setor-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::SETOR_INVALIDO);

    }

    public function testCidadeInvalida()
    {

        $request  = $this->getRequest('cidade-invalida');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CIDADE_INVALIDA);

    }

    public function testNomeUsuarioInvalido()
    {

        $request  = $this->getRequest('nome-usuario-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::NOME_DE_USUARIO_INVALIDO);

	$request->nomusu = "999";
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::NOME_DE_USUARIO_INVALIDO);

    }

    public function testCpfInvalido()
    {

        $request  = $this->getRequest('cpf-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CPF_INVALIDO);

	$request->cpf="1252002831x";
	$response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CPF_INVALIDO);

    }

   public function testCodcliDestinoNaoInformado()
    {

        $request  = $this->getRequest('codcli-destino-nao-informado');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CODCLI_DESTINO_DO_BENEFICIARIO_NAO_INFORMADO);

    }

    public function testInstrucaoInvalida()
    {

        $request  = $this->getRequest('instrucao-invalida');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::INSTRUCAO_INVALIDA);

    }

    public function testDataNascimentoInvalida()
    {

        $request  = $this->getRequest('data-nascimento-invalida');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::DATA_DE_NASCIMENTO_INVALIDA);

	$request->datanasc = "x";
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::DATA_DE_NASCIMENTO_INVALIDA);

	$request->datanasc = "12/22/1990";
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::DATA_DE_NASCIMENTO_INVALIDA);

    }

    public function testCEPInvalido()
    {

        $request  = $this->getRequest('cep-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CEP_INVALIDO);

	$request->cep = "2629834";
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CEP_INVALIDO);

        $request->cep = "262";
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CEP_INVALIDO);

    }

    public function testUFInvalida()
    {

        $request  = $this->getRequest('uf-invalida');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::UF_INVALIDA);

	$request->cep = "28";
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::UF_INVALIDA);

    }

    public function testTelefoneInvalido()
    {

        $request  = $this->getRequest('telefone-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::TELEFONE_RESIDENCIAL_INVALIDO);

	$request->telefone = "123";
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::TELEFONE_RESIDENCIAL_INVALIDO);

    }

    public function testCelularInvalido()
    {

        $request  = $this->getRequest('celular-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CELULAR_INVALIDO);

        $request->celular = "123";
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CELULAR_INVALIDO);

    }

    public function testSexoInvalido()
    {

        $request  = $this->getRequest('sexo-invalido');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::SEXO_INVALIDO);

    }

    public function testCodigoCartaoDuplicado()
    {

        $request  = $this->getRequest('codigo-cartao-duplicado');
        $response = $this->soapClient->MovimentacaoUsuario($request);
        $this->assertCodigo($request, $response, FuncionalWs::CODIGO_DO_CARTAO_DUPLICADO);

    }

    
}
