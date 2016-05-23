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
    public static function validate($argument, $throwException = true, $types = [])
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

    public static function validateAssociativeArray($array = [], $throwException = true)
    {
        $valid = self::hasStringkeys($array);
        if(!$valid) {
            throw new \InvalidArgumentException("Associate array with string keys required.");
        }
        return $valid;
    }

    /**
     * Returns true if array is only associative
     * @param $args 
     */
    public static function hasStringKeys($array = []) {
        return count(array_filter(array_keys($array), 'is_string')) > 0;
    }

    /**
     * Prioritize the first non empty element from array
     * @param $args Array with arguments
     * @return element value or null if all are empty
     */
    public static function prioritize($args = [])
    {
        $value = null;
        foreach($args as $arg) {
            if(!empty($arg)) {
                $value = $arg;
                break;
            }
        }
        return $value;
    }

    public static function notNull($argValue, $argName = '')
    {
        $valid = ($argValue !== null);
        if(!$valid) {
            throw new \InvalidArgumentException("Argument $argName must not be null");
        }
        return $valid;
    }
}
