<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj17
*/

abstract class Fpbj17
{
    const RETORNADOS_BENEFICIARIOS = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj17', $args, $decode);

    }
}
