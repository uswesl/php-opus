<?php

namespace capesesp\json;

use robotdance\Console;
use robotdance\Arguments;

use JsonSchema\RefResolver;
use JsonSchema\Validator;
use JsonSchema\Uri\UriRetriever;
use JsonSchema\Uri\UriResolver;

/**
 * Validador de objetos JSON
 */
abstract class JsonValidator
{
    /**
     * Testa um objeto JSON resultante de json_decode conta um schema JSON
     * @see http://json-schema.org/
     * @param $jsonObj Objeto JSON PHP
     * @param $schemaPath Caminho para o schema json
     * @return phpunit assertion
     */
    public static function validate($jsonObj, $schemaPath, &$msg)
    {
        Arguments::notNull($jsonObj, 'jsonObj');
        Arguments::notNull($schemaPath, 'schemaPath');

        $refResolver = new RefResolver(new UriRetriever(), new UriResolver());
        $schema = $refResolver->resolve('file://' . realpath($schemaPath));
        $validator = new Validator();
        $validator->check($jsonObj, $schema);

        $msg = "JSON validado com sucesso";
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
            $totalErrors = count($errors);
            $msg = Console::bold(Console::red("JSON não corresponde ao esquema. $totalErrors ocorrências encontradas:")) . "\n";
            for($i = 0; $i < $totalErrors; $i++) {
                $error = $errors[$i];
                $value = self::traverse($jsonObj, $error['property']);
                $msg .= Console::red(($i+1) . "/$totalErrors: " . $error['property']) . "\n";
                $lineBreak = (is_object($value) || is_array($value)) ? "\n" : "";
                $msg .= implode(['Retorno: ', $lineBreak, json_encode($value, JSON_PRETTY_PRINT), "\n"]);
                $msg .= ($error['message']) . "\n";
                if(array_key_exists('default', $error)) {
                    $msg .= 'Exemplo: ' . json_encode($error['default'], JSON_PRETTY_PRINT) . "\n";
                }
                $msg .= "\n";
            }
            if (!$jsonObj) {
                $msg .= "Parametro JSON de entrada nulo.";
            }
        }
        return $validator->isValid();
    }

    /**
     * Acessa elemento do objeto JSON a partir de um caminho (path)
     * Exemplo:
     * $path = "statusExecucao.mensagens.mensagem[0].codigo";
     * $value = traverse($jsonObj, $path); 
     * $value irá retornar o valor do elemento "codigo"
     * @param $jsonObj Objeto JSON resultante de json_decode com array = false
     * @param $path String com caminho no estilo "jq"
     * @return Valor do elemento
     */
    public static function traverse($jsonObj, $path)
    {
        $props = explode(".", $path);
        $obj = $jsonObj;
        foreach($props as $prop) {
            $propExploded = explode("[", $prop);
            $propName = $propExploded[0];
            if(property_exists($obj, $propName)) {
                eval("\$obj = \$obj->" . $prop . ";");
                $value = $obj;
            } else {
                $value = NULL;
                break;
            }
        }
        return $value;
    }
}
