<?php

namespace capesesp\uc\funcional;

class FuncionalWs
{
    const NAO_AUTENTICADO_LOGIN_OU_SENHA_INVALIDO = 4;
    const BENEFICIARIO_INCLUIDO_COM_SUCESSO = 1;
    const BENEFICIARIO_ATUALIZADO_COM_SUCESSO = 2;
    const BENEFICIARIO_BLOQUEADO_COM_SUCESSO = 3;
    const ERRO_INTERNO_NA_ROTINA_DE_BLOQUEIO = 5;
    const ERRO_INTERNO_NA_ROTINA_DE_ATUALIZACAO = 6;
    const ERRO_INTERNO_NA_ROTINA_DE_INCLUSAO = 7;
    const CODIGO_DE_CLIENTE_INVALIDO = 8;
    const CODIGO_DE_BENEFICIARIO_NAO_ENCONTRADO = 9;
    const CHAVE_CPF_CODCLIENTE_NUMDEP_NAO_ENCONTRADO = 13;
    const CHAVE_CPF_CODCLIENTE_NUMDEP_DUPLICADA = 14;
    const LOGRADOURO_INVALIDO_OU_INEXISTENTE = 15;
    const BAIRRO_INVALIDO_OU_INEXISTENTE = 16;
    const BENEFICIARIO_NAO_ENCONTRADO_PARA_OPERACAO_DIFERENTE_DE_INCLUSAO = 17;
    const BENEFICIARIO_DESBLOQUEADO_COM_SUCESSO = 18;
    const ERRO_INTERNO_NA_ROTINA_DE_DESBLOQUEIO = 19;
    const ERRO_DURANTE_A_ROTINA_DE_DESBLOQUEIO_DE_DEPENDENTE = 20;
    const NAO_FOI_POSSIVEL_REALIZAR_A_OPERACAO = 102;
    const CEP_ENTREGA_INVALIDO = 104;
    const UF_ENTREGA_INVALIDA = 105;
    const MATRICULA_POSSUI_LIMITE_DE_7_CARACTERES = 106;
    const GENERICO_POSSUI_LIMITE_DE_7_CARACTERES = 107;
    const DEBITO_FOLHA_INVALIDO = 108;
    const AMUC_INVALIDO = 109;
    const AUTORIZA_CONTATO_INVALIDO = 110;
    const CIDADE_ENTREGA_INVALIDA = 111;
    const ERRO_DURANTE_A_CONSULTA_DE_DADOS_DO_BENEFICIARIO = 112;
    const LIMITE_INVALIDO = 113;
    const CAMPO_NAO_PERMITE_VALORES_MENORES_QUE_ZERO = 114;
    const CAMPO_NAO_PERMITE_VALORES_NULOS = 115;
    const CAMPO_POSSUI_LIMITE_DE_CARACTERES = 116;
    const CAMPO_VALOR_FORA_DA_FAIXA = 117;
    const NAO_FOI_POSSIVEL_ABREVIAR_O_NOME_FORNECIDO = 118;
    const NAO_FOI_POSSIVEL_REALIZAR_A_OPERACAO_DESEJADA = 119;
    const TITULAR_DEVE_SER_CADASTRADO_ANTES_DOS_DEPENDENTES = 120;
    const NAO_FOI_POSSIVEL_REALIZAR_A_MOVIMENTACAO = 129;
    const NUMDEP_INVALIDO = 130;
    const CODIGO_DO_CARTAO_INVALIDO = 131;
    const FILIAL_INVALIDA = 132;
    const MATRICULA_INVALIDA = 133;
    const SETOR_INVALIDO = 134;
    const CIDADE_INVALIDA = 135;
    const NOME_DE_USUARIO_INVALIDO = 136;
    const CPF_INVALIDO = 137;
    const CODCLI_DESTINO_DO_BENEFICIARIO_NAO_INFORMADO = 138;
    const INSTRUCAO_INVALIDA = 139;
    const DATA_DE_NASCIMENTO_INVALIDA = 140;
    const CEP_INVALIDO = 141;
    const UF_INVALIDA = 142;
    const CELULAR_INVALIDO = 143;
    const TELEFONE_RESIDENCIAL_INVALIDO = 144;
    const SEXO_INVALIDO = 145;
    const CODIGO_DO_CARTAO_DUPLICADO = 146;
    const ENDERECO_NUMERO_INVALIDO = 147;
    const GRUPO_INVALIDO = 148;
    const CPF_INEXISTENTE = 149;
    const NUMDEP_INEXISTENTE = 150;
    const BENEFICIARIO_BLOQUEADO = 151;
    const BENEFICIARIO_NAO_BLOQUEADO = 152;
    const COD_CARTAO_SOMENTE_INCLUSAO = 153;
    const HOUVE_UM_ERRO_NAO_TRATADO = 9999;

    /**
     * Retorna client para acesso ao WS da funcional
     * @return SoapClient
     */
    public static function getSoapClient()
    {
        $soapClient = new \SoapClient("http://177.47.22.174:789/?wsdl", ['trace' => true]);
        return $soapClient;
    }
}

