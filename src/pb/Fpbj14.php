<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj14
*/

abstract class Fpbj14
{
    const DADOS_PREVIDENCIAIS_ENCONTRADOS = 5;
    const DADOS_PREVIDENCIAIS_NAO_ENCONTRADOS = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const MATRICULA_OBRIGATORIO = 1;
    const FATAL = 0;



    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj14', $args, $decode);

    }
}
