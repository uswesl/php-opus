<?php

namespace capesesp\uc;

use capesesp\json\OpusJson;

/**
 * Classe para acesso ao FUCJ04
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj04
 */
abstract class Fucj06
{
    const DADOS_RETORNADOS_COM_SUCESSO = 5;
    const BENEFICIARIO_NAO_POSSUI_AMUC = 4;
    const NAO_FORAM_ENCONTRADOS_DADOS = 3;
    const SEQUENCIAL_INVALIDO = 2;
    const MATRICULA_INVALIDA = 1;
    const FATAL = 0;

    /**
     * Retorna informações necessárias de um associado que possui AMUC
     * @param $args Array de argumentos:
     * - $matricula Integer
     * - $sequencial Integer
     * @return JSON
     */
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fucj06', $args, $decode);
    }
}
?>
