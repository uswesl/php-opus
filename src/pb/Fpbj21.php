<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
*   Armazena códigos de execução do programa fpbj21
*/

abstract class Fpbj21
{

    const REGISTRO_REALIZADO = 10;
    const REGISTRO_NAO_REALIZADO = 9;
    const MATRICULA_NAO_ENCONTRADA = 8;
    const SEQUENCIAL_NAO_ENCONTRADO = 7;
    const SEM_PLANO_ASSISTENCIAL = 6;
    const SEGMENTACAO_INVALIDA = 5;
    const DATA_HORA_INVALIDA = 4;
    const PROTOCOLO_INVALIDO = 3;
    const SEQUENCIAL_INVALIDO = 2;
    const MATRICULA_INVALIDA = 1;
    
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj21', $args, $decode);

    }
}
