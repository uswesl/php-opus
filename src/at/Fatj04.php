<?php

namespace capesesp\at;

use capesesp\json\OpusJson;

abstract class Fatj04
{

    const PROTOCOLO_ATUALIZADO = 1;
    const SISTEMA_ORIGEM_INVALIDO = 4;
    const UID_ORIGEM_INVALIDO = 8;
    const TIPO_SOLICITANTE_INVALIDO = 16;
    const TIPO_ID_SOLICITANTE_INVALIDO = 24;
    const TIPO_NOME_INVALIDO = 32;
    const TIPO_MELHOR_NOME_INVALIDO = 64;
    const TIPO_PROTOCOLO_URA_INVALIDO = 96;
    const NAO_FOI_POSSIVEL_ATUALIZAR_NOVAMENTE = 128;


    public static function executa($args, $decode = true)
    {
      return OpusJson::executa("fatj04", $args, $decode);
    }

}
