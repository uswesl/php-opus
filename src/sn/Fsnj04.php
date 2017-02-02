<?php

namespace capesesp\sn;

use capesesp\json\OpusJson;

/**
 * Classe que representa o programa Opus/JSON fsnj04
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:sn:fsnj02
 */
abstract class Fsnj04
{
    /** Nome do programa Opus/JSON representado pela classe */
    const PROGRAMA = 'fsnj04';

    const SENHAS_ENCONTRADAS = 2;
    const SENHAS_NAO_ENCONTRADAS = 1;
    const FATAL = 0;

    public static function executa($args, $decode = true)
    {
        return OpusJson::executa(self::PROGRAMA, $args, $decode);
    }
}

