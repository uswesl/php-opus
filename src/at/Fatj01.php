<?php

namespace capesesp\at;

use capesesp\json\OpusJson;

abstract class Fatj01
{

    const PROCEDIMENTOS_ENCONTRADOS = 5;
    const PROCEDIMENTOS_NAO_ENCONTRADOS = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const BENEFICIARIO_NAO_ENCONTRADO = 1;

    public static function executa($args, $decode = true)
    {
      return OpusJson::executa("fatj01", $args, $decode);
    }

}
