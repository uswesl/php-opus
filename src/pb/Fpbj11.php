<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj11
*/

abstract class Fpbj11
{
    const DADOS_FUNCIONAIS_ENCONTRADOS = 5;
    const DADOS_FUNCIONAIS_NAO_ENCONTRADOS = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const MATRICULA_OBRIGATORIO = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj11', $args, $decode);

    }
}
