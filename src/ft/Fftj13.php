<?php

namespace capesesp\ft;

use capesesp\json\OpusJson;

/**
 * Classe que representa o programa Opus/JSON fftj13
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:ft:fftj13
 */
abstract class Fftj13
{
    /** Nome do programa Opus/JSON representado pela classe */
    const PROGRAMA = 'fftj13';

    /** Codigo de retorno para matricula invalida */
    const MATRICULA_INVALIDA = 1;
    /** Codigo de retorno para sequencial invalido */
    const SEQUENCIAL_INVALIDO = 2;
    /** Codigo de retorno para categoria de despesa invalida */
    const CATEGORIA_DESPESA_INVALIDA = 3;
    /** Codigo de retorno para ano invalido */
    const ANO_INVALIDO = 4;
    /** Codigo de retorno para semestre invalido */
    const SEMESTRE_INVALIDO = 5;
    /** Codigo de retorno para beneficiario nao encontrado */
    const BENEFICIARIO_NAO_ENCONTRADO = 6;
    /** Codigo de retorno para nao ha procedimentos faturados neste periodo */
    const NAO_HA_PROCEDIMENTOS_NO_PERIODO = 7;
    /** Codigo de retorno para dados retornados */
    const DADOS_RETORNADOS = 8;
    /** Codigo de retorno para erro interno do programa */
    const FATAL = 0;

    /**
     * Retorno de demonstrativo de procedimentos faturados no plano assistencial
     * @param $args Array com parametros de linha de comando:
     * - matricula 
     * - sequencial
     * - grupo de procedimentos
     * - ano de utilizacao
     * - semestre de utilizacao
     * @param $decode Boolean se falso não converte string para Objeto JSON
     * @return Objeto JSON
     */
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa(self::PROGRAMA, $args, $decode);
    }
}
?>
