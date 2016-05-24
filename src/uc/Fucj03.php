<?php

namespace capesesp\uc;

use capesesp\json\OpusJson;

/**
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj03
 */
abstract class Fucj03
{
    const ENCONTRADOS_ASSOCIADOS = 2;
    const NAO_FORAM_ENCONTRADOS_ASSOCIADOS = 1;
    const FATAL = 0;

    /**
     * Retorna a lista de associados que possuem AMUC e precisam ser atualizados no cadastro da empresa Funcional
     * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj03
     * @return JSON
     */
    public static function executa($decode = true)
    {
        return OpusJson::executa('fucj03', [], $decode);
    }
}
?>
