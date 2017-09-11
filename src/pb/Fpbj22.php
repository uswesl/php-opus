<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj22
*/

abstract class Fpbj22
{

    const PEDIDOS_ENCONTRADOS = 4;
    const PEDIDOS_NAO_ENCONTRADOS = 3;
    const MATRICULA_NAO_ENCONTRADA = 2;
    const MATRICULA_INVALIDA = 1;
    
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj22', $args, $decode);

    }
}
