<?php

namespace capesesp\tt;

use capesesp\json\OpusJson;

/**
 * Classe que representa o programa Opus/JSON fttj06
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fttj06
 */
abstract class Fttj06
{
    /** Nome do programa Opus representado pela classe */
    const PROGRAMA = 'fttj06';

    /** Codigo das mensagens de retorno */
    const RECIBO_GRAVADO_COM_SUCESSO        = 1;
    const ID_EVENTO_OBRIGATORIO             = 2;
    const RECIBO_OBRIGATORIO                = 3;
    const EVENTO_INVALIDO_OU_NAO_ENCONTRADO = 4;
    const RECIBO_COM_MENOS_DE_15_CARACTERES = 5;
    const RECIBO_COM_MAIS_DE_49_CARACTERES  = 6;
    const FATAL                             = 0;

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
