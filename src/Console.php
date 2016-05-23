<?php

namespace capesesp;

/**
 * Utilitario para cores no console
 * @see https://wiki.archlinux.org/index.php/Bash/Prompt_customization
 *
 * Black 0;30
 * Blue 0;34
 * Green 0;32
 * Cyan 0;36
 * Red 0;31
 * Purple 0;35
 * Brown 0;33
 * Light Gray 0;37
 * Dark Gray 1;30
 * Light Blue 1;34
 * Light Green 1;32
 * Light Cyan 1;36
 * Light Red 1;31
 * Light Purple 1;35
 * Yellow 1;33
 * White 1;37
 */
class Console
{
    //TODO refatorar
    const BOLD   = 1;
    const BLACK  = 30;
    const BLUE   = 34;
    const GREEN  = 32;
    const CYAN   = 36;
    const RED    = 31;
    const PURPLE = 35;
    const BROWN  = 33;
    const YELLOW = 33;
    const GRAY   = 37;
    const DARK_GRAY = 30;
    const LIGHT_BLUE = 34;
    const LIGHT_GREEN = 32;
    const LIGHT_CYAN = 36;
    const LIGHT_RED = 31;
    const LIGHT_PURPLE = 35;


    protected static $ANSI_CODES = array(
        "off"        => 0,
        "bold"       => 1,
        "italic"     => 3,
        "underline"  => 4,
        "blink"      => 5,
        "inverse"    => 7,
        "hidden"     => 8,
        "black"      => 30,
        "red"        => 31,
        "green"      => 32,
        "yellow"     => 33,
        "blue"       => 34,
        "magenta"    => 35,
        "cyan"       => 36,
        "white"      => 37,
        "black_bg"   => 40,
        "red_bg"     => 41,
        "green_bg"   => 42,
        "yellow_bg"  => 43,
        "blue_bg"    => 44,
        "magenta_bg" => 45,
        "cyan_bg"    => 46,
        "white_bg"   => 47
    );


    /**
     * Colore texto para verde
     * @param $str String
     * @return $tring com codigo de cor adicionado
     */
    public static function green($str)
    {
        return "\e[32m$str\e[0m";
    }

    /**
     * Colore texto para azul
     * @param $str String
     * @return $tring com codigo de cor adicionado
     */
    public static function blue($str)
    {
        return "\e[34m$str\e[0m";
    }

    /**
     * Colore texto para amarelo
     * @param $str String
     * @return $tring com codigo de cor adicionado
     */
    public static function yellow($str)
    {
        return "\e[33m$str\e[0m";
    }

    /**
     * Colore texto para vermelho
     * @param $str String
     * @return $tring com codigo de cor adicionado
     */
    public static function red($str)
    {
        return "\e[31m$str\e[0m";
    }

    /**
     * Colore texto para vermelho
     * @param $str String
     * @return $tring com codigo de cor adicionado
     */
    public static function bold($str)
    {
        return "\e[1m$str\e[0m";
    }

    /**
     * Insere N espacos à esquerda de cada linha
     * @param $string String
     * @param $spaces número de espaços
     * @return String com N espações a esquerda de cada linha
     */
    public static function indent($string, $spaces = 4){
        return str_repeat(" ", $spaces) . str_replace("\n", "\n" . str_repeat(" ", $spaces), $string);
    }
}
