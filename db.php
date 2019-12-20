<?php
class DB
{
    static $link;
    static $count = 0;


    public static function connect($dbServer, $dbUser, $dbPass, $db)
    {
        if(empty(self::$link))
        {
            self::$link = @mysqli_connect($dbServer, $dbUser, $dbPass, $db)
            or die('Ошибка: Невозможно установить соединение с MySQL');

            mysqli_set_charset(self::$link, 'utf8');
        }
    }
}
