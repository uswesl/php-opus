<?php

namespace capesesp\json;

use capesesp\Config;
use capesesp\Arguments;

abstract class OpusJson
{

    /**
     * Efetua um request POST usando CURL
     * @param url URL
     * @param post_data array associativo name => value;
     * @return URL response
     */
    private static function curlHttpPost($url, $post_data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * Executa programa no Opus atraves da ponte PHP-Opus
     * @param $program String nome do programa que sera executada no Opus
     * @param $parametros Array com parametros da linha de comando, ou string com parametros separados por espaço
     * @param $decode Boolean se falso retorna somente String. Se verdadeiro, retorna json_decode(String)
     * @return String JSON
     */
    public static function executa($programa, $parametros = [], $decode = true)
    {
        Arguments::validate($programa, true, ['string']);
        Arguments::validate($parametros, true, ['string', 'array']);

        if(is_array($parametros)) {
            $parametros = implode(" ", $parametros);
        }
        $url = Config::get('opus_json_url');
        $post_data = array('funcao' => $programa, 'parametros' => $parametros);
        $response = self::curlHttpPost($url, $post_data);

        if($decode) {
            $response = json_decode($response);
        }

        return $response;
    }
}
