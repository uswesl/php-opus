<?php

namespace capesesp\uc;

use capesesp\json\OpusJson;

/**
 * Armazena codigos de execucao do programa Opus fucj02
 * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj02
 * TODO corrigir o programa FUCJ02, atualizar documentacao e testes
 */
abstract class Fucj02
{
    const CORRIGIR_FUCJ02 = 0;

    /**
     * Atualização de processos AMUC no sistema central
     * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:uc:fucj02
     * @param $args vetor de argumentos:
     * - $processo numero do processo na PBM
     * - $matricula matricula do associado com 6 ou 7 digitos
     * - $sequencial sequencial do associado com 1 ou 2 digitos
     * - $ufcrm UF do CRM do medico
     * - $crm CRM do medico
     * - $dataReceita String de data da receita no formato YYYYmmdd
     * - $codigoDeferimento Aceita apenas números de 20 a 47
     * - $versao Numero 1:Franquia (processo antigo), 2:Parcelas (processo atual)
     * @return JSON
     */
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fucj02', $args, $decode);
    }
}
?>
