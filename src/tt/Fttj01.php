<?php

namespace capesesp\tt;

use capesesp\json\OpusJson;

/**
 * Classe que representa o programa Opus/JSON fttj01
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj01
 */
abstract class Fttj01
{
    /** Nome do programa Opus/JSON representado pela classe */
    const PROGRAMA = 'fttj01';

    /** Codigo de retorno para eventos encontrados */
    const EVENTOS_ENCONTRADOS = 1;
    /** Codigo de retorno para nenhum evento encontrado */
    const NENHUM_EVENTO_ENCONTRADO = 2;
    /** Codigo de retorno para competencia inicial invalida */
    const COMPETENCIA_INICIAL_INVALIDA = 3;
    /** Codigo de retorno para competencia final invalida */
    const COMPETENCIA_FINAL_INVALIDA = 4;
    /** Codigo de retorno para itens por pagina invalido */
    const ITENS_POR_PAGINA_INVALIDO = 5;
    /** Codigo de retorno para numero de pagina invalido */
    const NUMERO_DE_PAGINA_INVALIDO = 6;
    /** Codigo de retorno para erro interno do programa */
    const FATAL = 0;

    /**
     * Retorno de eventos de movimentacao financeira para e-Financeira RFB
     * @param $args Array com parametros de linha de comando:
     * - competencia inicial AAAAMM
     * - competencia final AAAAMM
     * - numero de itens por pagina de retorno
     * - numero de pagina
     * @param $decode Boolean se falso não converte string para Objeto JSON
     * @return Objeto JSON
     */
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa(self::PROGRAMA, $args, $decode);
    }
}
?>
