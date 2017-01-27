<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj16
*/

abstract class Fpbj16
{
    const PESSOAS_ENCONTRADAS_REFINE_SUA_BUSCA = 6;
    const PESSOAS_ENCONTRADAS = 5;
    const PESSOAS_NAO_ENCONTRADAS = 4;
    const NOME_INVALIDO = 3;
    const TAMANHO_MINIMO_INVALIDO = 2;
    const NOME_OBRIGATORIO = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj16', $args, $decode);

    }
}
