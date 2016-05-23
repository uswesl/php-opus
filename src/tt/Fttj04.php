<?php

namespace capesesp\tt;

use capesesp\OpusJson;

/**
 * Classe que representa o programa Opus/JSON fttj01
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj01
 */
abstract class Fttj04
{
    /** Nome do programa Opus/JSON representado pela classe */
    const PROGRAMA = 'fttj04';

    /** Codigo de retorno para sucesso */
    const DADOS_DO_DECLARANTE_RETORNADOS_COM_SUCESSO = 3;
    /** Codigo de retorno para erro interno do programa */
    const FATAL = 0;

    /**
     * Retorno de dados cadastrais do declarante da e-Financeira
     * @return Objeto JSON
     */
    public static function executa($decode = true)
    {
        return OpusJson::executa(self::PROGRAMA, [], $decode);
    }
}
?>
