<?php

/*
 * This file is part of the JsonSchema package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JsonSchema\Constraints;
use JsonSchema\Rfc3339;

/**
 * Validates against the "format" property
 *
 * @author Justin Rainbow <justin.rainbow@gmail.com>
 * @link   http://tools.ietf.org/html/draft-zyp-json-schema-03#section-5.23
 */
class FormatConstraint extends Constraint
{
    /**
     * {@inheritDoc}
     */
    public function check($element, $schema = null, $path = null, $i = null)
    {
        if (!isset($schema->format)) {
            return;
        }

        switch ($schema->format) {
            case 'date':
                if (!$date = $this->validateDateTime($element, 'Y-m-d')) {
                    $this->addError($path, sprintf('Data invalida %s, esperado formato YYYY-MM-DD', json_encode($element)), 'format', array('format' => $schema->format,));
                }
                break;

            case 'time':
                if (!$this->validateDateTime($element, 'H:i:s')) {
                    $this->addError($path, sprintf('Hora invalida %s, esperado formato hh:mm:ss', json_encode($element)), 'format', array('format' => $schema->format,));
                }
                break;

            case 'date-time':
                if (null === Rfc3339::createFromString($element)) {
                    $this->addError($path, sprintf('Data-hora invalida %s, esperado formato YYYY-MM-DDThh:mm:ssZ ou YYYY-MM-DDThh:mm:ss+hh:mm', json_encode($element)), 'format', array('format' => $schema->format,));
                }
                break;

            case 'utc-millisec':
                if (!$this->validateDateTime($element, 'U')) {
                    $this->addError($path, sprintf('Hora invalida %s, esperado inteiro ou millisegundos Epoch', json_encode($element)), 'format', array('format' => $schema->format,));
                }
                break;

            case 'regex':
                if (!$this->validateRegex($element)) {
                    $this->addError($path, 'Expressao regular invalida ' . $element, 'format', array('format' => $schema->format,));
                }
                break;

            case 'color':
                if (!$this->validateColor($element)) {
                    $this->addError($path, "Cor invalida", 'format', array('format' => $schema->format,));
                }
                break;

            case 'style':
                if (!$this->validateStyle($element)) {
                    $this->addError($path, "Estilo invalido", 'format', array('format' => $schema->format,));
                }
                break;

            case 'phone':
                if (!$this->validatePhone($element)) {
                    $this->addError($path, "Telefone invalido", 'format', array('format' => $schema->format,));
                }
                break;

            case 'uri':
                if (null === filter_var($element, FILTER_VALIDATE_URL, FILTER_NULL_ON_FAILURE)) {
                    $this->addError($path, "URL invalida", 'format', array('format' => $schema->format,));
                }
                break;

            case 'email':
                if (null === filter_var($element, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE)) {
                    $this->addError($path, "Email invalido", 'format', array('format' => $schema->format,));
                }
                break;

            case 'ip-address':
            case 'ipv4':
                if (null === filter_var($element, FILTER_VALIDATE_IP, FILTER_NULL_ON_FAILURE | FILTER_FLAG_IPV4)) {
                    $this->addError($path, "Endereco IP invalido", 'format', array('format' => $schema->format,));
                }
                break;

            case 'ipv6':
                if (null === filter_var($element, FILTER_VALIDATE_IP, FILTER_NULL_ON_FAILURE | FILTER_FLAG_IPV6)) {
                    $this->addError($path, "Endereco IP invalido", 'format', array('format' => $schema->format,));
                }
                break;

            case 'host-name':
            case 'hostname':
                if (!$this->validateHostname($element)) {
                    $this->addError($path, "Nome de Host invalido", 'format', array('format' => $schema->format,));
                }
                break;

            default:
                // Empty as it should be:
                // The value of this keyword is called a format attribute. It MUST be a string.
                // A format attribute can generally only validate a given set of instance types.
                // If the type of the instance to validate is not in this set, validation for
                // this format attribute and instance SHOULD succeed.
                // http://json-schema.org/latest/json-schema-validation.html#anchor105
                break;
        }
    }

    protected function validateDateTime($datetime, $format)
    {
        $dt = \DateTime::createFromFormat($format, $datetime);

        if (!$dt) {
            return false;
        }

        return $datetime === $dt->format($format);
    }

    protected function validateRegex($regex)
    {
        return false !== @preg_match('/' . $regex . '/', '');
    }

    protected function validateColor($color)
    {
        if (in_array(strtolower($color), array('aqua', 'black', 'blue', 'fuchsia',
            'gray', 'green', 'lime', 'maroon', 'navy', 'olive', 'orange', 'purple',
            'red', 'silver', 'teal', 'white', 'yellow'))) {
            return true;
        }

        return preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', $color);
    }

    protected function validateStyle($style)
    {
        $properties     = explode(';', rtrim($style, ';'));
        $invalidEntries = preg_grep('/^\s*[-a-z]+\s*:\s*.+$/i', $properties, PREG_GREP_INVERT);

        return empty($invalidEntries);
    }

    protected function validatePhone($phone)
    {
        return preg_match('/^\+?(\(\d{3}\)|\d{3}) \d{3} \d{4}$/', $phone);
    }

    protected function validateHostname($host)
    {
        return preg_match('/^[_a-z]+\.([_a-z]+\.?)+$/i', $host);
    }
}
