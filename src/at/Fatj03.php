<?php

namespace capesesp\at;

use capesesp\json\OpusJson;

abstract class Fatj03
{

    const TELEFONE_IDENTIFICADO = 4;
    const TELEFONE_NAO_IDENTIFICADO = 3;
    const DDD_INVALIDO = 2;
    const NUMERO_INVALIDO = 1;

    public static function executa($args, $decode = true)
    {
      return OpusJson::executa("fatj03", $args, $decode);
    }

}
