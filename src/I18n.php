<?php
namespace capesesp;

use capesesp\Config;
use capesesp\Arguments;

/**
 * Simple I18n class for string messages
 */
abstract class I18n
{

    public static function t($key, $args = [])
    {
        $locale = self::getLocale();
        $yml = yaml_parse_file("./config/locales/$locale.yml");
        if(array_key_exists($locale, $yml) && array_key_exists($key, $yml[$locale])) {
            $value = self::format($yml[$locale][$key], $args);
        } else {
            $value = strtr($key, ["_" => " "]);
        }
        return $value;
    }

    public static function getLocale(){
        $locale = Arguments::prioritize([\Locale::acceptFromHttp(self::safeHeader('HTTP_ACCEPT_LANGUAGE')),
                                         \Locale::getDefault(),
                                         Config::get('default_locale')]);
        return $locale;
    }

    private static function format($string, $args = [])
    {
        foreach($args as $pattern => $replacement) {
            $string = preg_replace("/\%\{$pattern\}/", $replacement, $string);
        }
        return $string;
    }

    private static function safeHeader($key)
    {
        $value = null;
        if(array_key_exists($key, $_SERVER)) {
            $value = $_SERVER[$key];
        }
        return $value;
    }
}
