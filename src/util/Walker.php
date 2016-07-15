<?php

namespace capesesp\util;

use robotdance\Console;
use robotdance\Arguments;

/**
 * Utilitarios para objetos PHP
 */
abstract class Walker
{
    /**
     * Acessa elemento do objeto PHP a partir de um caminho (path)
     * Exemplo:
     * $path = "statusExecucao.mensagens.mensagem[0].codigo";
     * $value = traverse($obj, $path); 
     * $value irá retornar o valor do elemento "codigo"
     * @param $obj Objeto PHP
     * @param $path String com caminho no estilo "jq"
     * @return Valor do elemento
     */
    public static function traverse($obj, $path)
    {
        $props = explode(".", $path);
        $obj = $obj;
        foreach($props as $prop) {
            $propExploded = explode("[", $prop);
            $propName = $propExploded[0];
            if(property_exists($obj, $propName)) {
                if(is_array($obj->$propName)) {
                    eval("\$obj = \$obj->" . $prop . ";");
                } else {
                    $obj = $obj->$propName;
                }
                $value = $obj;
            } else {
                $value = null;
                break;
            }
        }
        return $value;
    }
}
