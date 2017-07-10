<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj17
*/

abstract class Fpbj17
}
    const TRANSACOES_RETORNADAS = 4;
    const TRANSACOES_NAO_ENCONTRADAS = 3;
    const SEQUENCIAL_INVALIDO = 2;
    const MATRICULA_INVALIDA = 1;
    const FATAL = 0;
    
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj19', $args, $decode);

    }
}
