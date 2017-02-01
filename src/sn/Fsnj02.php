<?php

namespace capesesp\sn;

use capesesp\json\OpusJson;

/**
 * Classe que representa o programa Opus/JSON fsnj02
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:sn:fsnj02
 */
abstract class Fsnj02
{
    /** Nome do programa Opus/JSON representado pela classe */
    const PROGRAMA = 'fsnj02';

    /** Codigo de retorno pra prestador nao encontrado */
    const PRESTADOR_NAO_ENCONTRADO = 1;
    /** Codigo de retorno para beneficiario nao encontrado */
    const BENEFICIARIO_NAO_ENCONTRADO = 2;
    /** Codigo de retorno para senha nao encontrada */
    const SENHA_NAO_ENCONTRADA = 3;
    /** Codigo de retorno para nao foram encontradas senhas nos ultimos 90 dias */
    const NAO_FORAM_ENCONTRADAS_SENHAS_90_DIAS = 4;
    /** Codigo de retorno para senhas retornadas */
    const SENHAS_RETORNADAS = 5;
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
