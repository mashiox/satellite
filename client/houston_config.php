<?php

class DB {
    private static $host        = "hostname",
                   $user        = "username",
                   $password    = "password",
                   $database    = "database";
    private static $mysqli;
    private function __construct() {}
    
    static function connection(){
        if ( !self::$mysqli ) 
            self::$mysqli = new mysqli (self::$host, self::$user, self::$password, self::$database);
        return self::$mysqli;
    }
}

?>

