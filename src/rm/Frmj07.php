<?php

namespace capesesp\rm;

use capesesp\json\OpusJson;

/**
 *  Armazena códigos de execução do programa frmj01
 */

abstract class Frmj07
{

    const PROCESSO_REGISTRADO = 8;
    const TELEFONE_INVALIDO = 7;
    const DDD_INVALIDO = 6;
    const CASO_INVALIDO = 5;
    const PROCESSO_NAO_REGISTRADO = 4;
    const MATRICULA_INVALIDA = 3;
    const DATA_INVALIDA = 2;
    const UF_INVALIDA = 1;
    const FATAL = 0;

    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('frmj07', $args, $decode);
    }

}
