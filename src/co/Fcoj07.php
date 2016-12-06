<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
 * Classe que representa o programa Opus/JSON fcoj07
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:pb:fcoj07
 */
abstract class Fcoj07
{
    const PROGRAMA = 'fcoj07';

    const PESSOA_ENCONTRADA = 5;
    const PESSOA_NAO_ENCONTRADA = 4;
    const SEQUENCIAL_INVALIDO = 3;
    const MATRICULA_INVALIDA = 2;
    const MATRICULA_OBRIGATORIA = 1;
    const FATAL = 0;

    /**
    * Retorna informações sobre cota extra definida em 2016
    * @param $args Array com parametros de linha de comando:
    * - Integer matricula do associado
    * - Integer sequencial do associado
    * @return String string no formato JSON com dados de cota extra
    */
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa(self::PROGRAMA, $args, $decode);
    }

}


