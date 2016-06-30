<?php

namespace capesesp\tt;

use capesesp\json\OpusJson;

/**
 * Classe que representa o programa Opus/JSON fttj05
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj05
 */
abstract class Fttj07
{
    /** Nome do programa Opus representado pela classe */
    const PROGRAMA = 'fttj07';

    /** codigo das mensagens de retorno */
    const OCORRENCIA_GRAVADA_COM_SUCESSO    = 1;
    const EVENTO_INVALIDO_OU_NAO_ENCONTRADO = 2;
    const TIPO_DE_OCORRENCIA_INVALIDO       = 3;
    const PARAMETRO_CAMPO_OBRIGATORIO       = 4;
    const PARAMETRO_CODIGO_OBRIGATORIO      = 5;
    const PARAMETRO_DESCRICAO_OBRIGATORIO   = 6;
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
