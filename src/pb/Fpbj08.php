<?php

namespace capesesp\pb;

use capesesp\json\OpusJson;

/**
* Armazena códigos de execução do programa Opus fpbj08
*/

abstract class Fpbj08
{
    const LISTA_PLANOS_ASSISTENCIAIS = 5;
    const BENEFICIARIO_NAO_VINCULADO = 4;
    const BENEFICIARIO_NAO_ENCONTRADO = 3;
    const SEQUENCIAL_INVALIDO = 2;
    const MATRICULA_INVALIDA = 1;
    const FATAL = 0;
    const PLANO_ODONTO = "Odonto";
    const PLANO_MEDICO = "Saúde";
    const CODIGO_NACIONAL = "nacional";
    const CODIGO_REGIONAL = "regional";
    const CODIGO_ODONTO = "odontologico";

    //Planos Nacionais
    const ODONTOLOGICO = "456556078";
    const REFERENCIAL = "456558074";
    const ASSISTENCIA_SUPERIOR_4 = "449372049";
    const REFERENCIAL_SUPERIOR = "456557076";
    const ASSISTENCIA_SUPERIOR_3 = "433388008";
    const ASSISTENCIA_BASICA = "400394982";
    const ASSISTENCIA_SUPERIOR = "705137999";
    const ASSISTENCIA_EXECUTIVA = "705138997";
    const ASSISTENCIA_BASICA_2 = "433385003";
    const ASSISTENCIA_BASICA_3 = "433387000";
    const ASSISTENCIA_SUPERIOR_2 = "433386001";
    const ASSISTENCIA_BASICA_I = "470313138";
    const ASSISTENCIA_SUPERIOR_I = "470311131";
    const ASSISTENCIA_EXECUTIVA_I = "470312130";
    const ASSISTENCIA_BASICA_II = "475061156";
    const ASSISTENCIA_BASICA_4 = "449371041";

    //Planos Regionais
    const SOB_MEDIDA_NORTE_CENTRO_OESTE_ENFERMARIA = "464854114";
    const SOB_MEDIDA_NORTE_CENTRO_OESTE_APARTAMENTO = "464855112";
    const SOB_MEDIDA_NORDESTE_ENFERMARIA = "464844117";
    const SOB_MEDIDA_NORDESTE_APARTAMENTO = "464845115";
    const SOB_MEDIDA_DF_ENFERMARIA = "464851110";
    const SOB_MEDIDA_DF_APARTAMENTO = "464852118";
    const SOB_MEDIDA_SUDESTE_I_ENFERMARIA = "464848110";
    const SOB_MEDIDA_SUDESTE_I_APARTAMENTO = "464849118";
    const SOB_MEDIDA_SUDESTE_II_ENFERMARIA = "464853116";
    const SOB_MEDIDA_SUDESTE_II_APARTAMENTO = "464850111";
    const SOB_MEDIDA_SUL_ENFERMARIA = "464846113";
    const SOB_MEDIDA_SUL_APARTAMENTO = "464847111";
    const SOB_MEDIDA_FAMILIA_NORTE_CENTRO_OESTE_ENFERMARIA = "466837125";
    const SOB_MEDIDA_FAMILIA_NORTE_CENTRO_OESTE_APARTAMENTO = "466832124";
    const SOB_MEDIDA_FAMILIA_NORDESTE_ENFERMARIA = "466827128";
    const SOB_MEDIDA_FAMILIA_NORDESTE_APARTAMENTO = "466826120";
    const SOB_MEDIDA_FAMILIA_DF_ENFERMARIA = "466829124";
    const SOB_MEDIDA_FAMILIA_DF_APARTAMENTO = "466830128";
    const SOB_MEDIDA_FAMILIA_SUDESTE_I_ENFERMARIA = "466835129";
    const SOB_MEDIDA_FAMILIA_SUDESTE_I_APARTAMENTO = "466836127";
    const SOB_MEDIDA_FAMILIA_SUDESTE_II_ENFERMARIA = "466831126";
    const SOB_MEDIDA_FAMILIA_SUDESTE_II_APARTAMENTO = "466828126";
    const SOB_MEDIDA_FAMILIA_SUL_ENFERMARIA = "466833122";
    const SOB_MEDIDA_FAMILIA_SUL_APARTAMENTO = "466834121";

    /**
    * Retorna a lista de planos assistenciais que o associado possui
    * @see http://wiki.capesesp.net/doku.php?id=dsi:erp:sistema_central:pb:fpbj08
    * @param String matricula do associado
    * @param String sequencial do associado
    * @return String string no formato JSON com a lista de planos de associado.
    */
    public static function executa($args, $decode = true)
    {
        return OpusJson::executa('fpbj08', $args, $decode);
    }

}


