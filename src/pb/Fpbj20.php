<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj20
*/

abstract class Fpbj20
{
    const INFORMACOES_RETORNADAS = 4;
    const INFORMACOES_NAO_RETORNADAS = 3;
    const SEQUENCIAL_INVALIDO = 2;
    const MATRICULA_INVALIDA = 1;
    const FATAL = 0;
    
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj20', $args, $decode);

    }
}
