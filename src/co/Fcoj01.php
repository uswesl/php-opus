<?php

namespace capesesp\co;

use capesesp\json\OpusJson;

/**
 * Classe que representa o programa Opus/JSON fcoj01
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:pb:fcoj01
 */
abstract class Fcoj01
{
    const PROGRAMA = 'fcoj01';

    const RESULTADOS_ENCONTRADOS = 8;
    const BOLETOS_ENCONTRADOS = 7;
    const BOLETOS_NAO_ENCONTRADOS = 6;
    const ASSOCIADO_NAO_ENCONTRADO = 5;
    const NUMERO_BOLETO_INVALIDO = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const DATA_INVALIDA = 1;
    const FATAL = 0;

    
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa(self::PROGRAMA, $args, $decode);
    }

}

