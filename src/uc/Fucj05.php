<?php

namespace capesesp\uc;

use capesesp\json\OpusJson;

/**
 * Classe para acesso ao programa Opus FUCJ05
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj05
 */
abstract class Fucj05
{
    const DADOS_GRAVADOS_COM_SUCESSO = 8;
    const NAO_FOI_POSSIVEL_GRAVAR_DADOS_PARA_ASSOCIADO = 7;
    const ASSOCIADO_NAO_ENCONTRADO = 6;
    const MENSAGEM_NAO_IDENTIFICADA = 5;
    const HORA_INVALIDA = 4;
    const DATA_INVALIDA = 3;
    const SEQUENCIAL_INVALIDO = 2;
    const MATRICULA_INVALIDA = 1;
    const FATAL = 0;

    /**
     * Salvar a data e hora de envio dos dados do associado para PBM
     * @param $args Array de argumentos:
     * - $matricula
     * - $sequencial
     * - $dataHora YYYYMMDDhhmmss, padrao 24h
     * - $codigoFuncional 000
     * @return JSON
     */
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fucj05', $args, $decode);
    }
}
?>
