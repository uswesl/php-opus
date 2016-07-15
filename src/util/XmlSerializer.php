<?php

namespace capesesp\util;

use robotdance\Arguments;

/**
 * Serializa objetos StdClass para XML
 */
abstract class XmlSerializer
{
    /**
     * Serializa Objeto PHP para XML String
     * Atualmente limitado a XML 1.0
     * @param $obj Objeto PHP StdClass
     * @param $pp  Boolean Pretty Print da saída
     * @param $rootNodeName String. Se informado, cria um elemento raiz para o objeto
     * @return String XML formatada ou não de acordo com $pp
     */
    public static function toXml($obj, $pp = false, $rootNodeName = null)
    {
        Arguments::validate($obj, ['object']);
        $doc = new \DOMDocument();
        $doc->formatOutput = $pp;
        $doc->preserveWhitespace = $pp;
        if ($rootNodeName) {
            $obj = (object)[$rootNodeName => $obj];
        }
        self::_toXml($doc, $doc, $obj);
        return $doc->saveXml($doc->firstChild);
    }

    /**
     * Navega recursivamente pelo objeto gerando seu correspondente DomNode/DomDocument
     * @param &$doc DomDocument
     * @param &$parent DomNode nó pai
     * @param $obj mixed Valor a converter
     */
    private static function _toXml(&$doc, &$parent, $obj)
    {
        foreach ($obj as $property => $value) {
            switch(gettype($value)) {
            case 'object':
                $element = $doc->createElement($property);
                self::_toXml($doc, $element, $value);
                $parent->appendChild($element);
                break;
            case 'array':
                foreach($value as $valueElement) {
                    $elementObj = (object)[$property => $valueElement];
                    self::_toXml($doc, $parent, $elementObj);
                }
                break;
            default:
                $element = $doc->createElement($property, $value);
                $parent->appendChild($element);
            }
        }
    }
}
