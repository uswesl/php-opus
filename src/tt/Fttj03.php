<?php

namespace capesesp\tt;

use capesesp\json\OpusJson;

/**
 * Classe que representa o programa Opus/JSON fttj03
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj03
 * 3    INFO    Evento de fechamento retornado com sucesso
 * 2    ERROR   Competencia inicial inválida
 * 1    ERROR   Competencia final inválida 
 */
abstract class Fttj03
{
    /** Nome do programa Opus/JSON representado pela classe */
    const PROGRAMA = 'fttj03';

    /** Codigo de retorno para sucesso */
    const FECHAMENTO_RETORNADO_COM_SUCESSO = 3;
    /** Codigo de retorno para competencia inicial invalida */
    const COMPETENCIA_INICIAL_INVALIDA = 2;
    /** Codigo de retorno para competencia final invalida */
    const COMPETENCIA_FINAL_INVALIDA = 1;
    /** Codigo de retorno para erro interno do programa */
    const FATAL = 0;

    /**
     * Retorno de dados cadastrais do declarante da e-Financeira
     * @param $args Array com anoMesInicial e anoMesFinal
     * @param $decode se falso retorna Strino ao inves de objeto PHP
     * @return Objeto JSON ou string
     */
    public static function executa($args = [], $decode = true)
    {
        return OpusJson::executa(self::PROGRAMA, [], $decode);
    }
}
?>
