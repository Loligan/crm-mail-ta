<?php
namespace LastPhrase;
class LastPhrase
{
    private static $phrase;
    public static function init()
    {
        self::$phrase = "";
    }

    /**
     * @return mixed
     */
    public static function getPhrase()
    {
        return self::$phrase;
    }

    /**
     * @param mixed $phrase
     */
    public static function setPhrase($phrase)
    {
        self::$phrase = $phrase;
    }


}