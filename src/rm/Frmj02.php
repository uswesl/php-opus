<?php

namespace capesesp\rm;

use capesesp\json\OpusJson;

/**
 *  Armazena códigos de execução do programa frmj01
 */

abstract class Frmj02
{

    const REGISTROS_ENCONTRADOS = 3;
    const NENHUM_REGISTRO_ENCONTRADO = 2;
    const DATA_INVALIDA = 1;
    const FATAL = 0;

    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('frmj02', $args, $decode);
    }

}
