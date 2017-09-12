<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj23
*/

abstract class Fpbj23
{

    const DADOS_RETORNADOS = 3;
    const MATRICULA_NAO_ENCONTRADA = 2;
    const MATRICULA_INVALIDA = 1;
    
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj23', $args, $decode);

    }
}
