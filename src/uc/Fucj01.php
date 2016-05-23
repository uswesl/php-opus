<?php

namespace capesesp\uc;

use capesesp\OpusJson;

/**
 * Armazena codigos de execucao do programa Opus fucj01
 */
abstract class Fucj01
{
    const BENEFICIARIO_ELEGIVEL_AO_AMUC = 20;
    const BENEFICIARIO_DESLIGADO = 21;
    const BENEFICIARIO_SUSPENSO = 22;
    const PRODUTO_NAO_COBRE_BENEFICIO = 23;
    const INCLUSOES_SUSPESAS = 24;
    const MATRICULA_NAO_VINCULADA_AO_PLANO = 27;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const BENEFICIARIO_NAO_ENCONTRADO = 1;
    const FATAL = 0;

    /**
     * Análise de elegibilidade de um beneficiário ao AMUC
     * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj01
     * @param $matricula matricula do associado com 6 ou 7 digitos
     * @param sequencial sequencial do associado com 1 ou 2 digitos
     * @return JSON informações de elegibilidade
     */
    public static function executa($decode = true)
    {
        return OpusJson::executa('fucj01', [], $decode);
    }
}
?>
