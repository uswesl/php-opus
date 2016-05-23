<?php

namespace capesesp;

abstract class Arguments
{
    /**
     * Utilitario para validar argumento
     * @param $argument qualquer valor
     * @param $throwException Boolean, se verdadeiro, lanca excecao caso o parametro nao seja do tipo desejado
     * @param $types Array de strings com tipos esperados. Tipos validos em http://php.net/manual/en/function.gettype.php
     */
    public static function validate($argument, $throwException, $types = [])
    {
        $valid = false;
        foreach($types as $type) {
            if(strcasecmp(gettype($argument), $type) == 0) {
                $valid = true;
                break;
            }
        }
        if(!$valid && $throwException) {
            throw new \InvalidArgumentException(implode(" or ", $types) . " required. " . gettype($argument) . " given.");
        }
        return $valid;
    }
}
