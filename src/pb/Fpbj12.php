<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj12
*/

abstract class Fpbj12
{
    const DADOS_BANCARIOS_ENCONTRADOS = 5;
    const DADOS_BANCARIOS_NAO_ENCONTRADOS = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const MATRICULA_OBRIGATORIO = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj12', $args, $decode);

    }
}
