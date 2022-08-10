<?php
class Database
{

    // public static $serverName = 'sql100.epizy.com';
    // public static $dbName = 'epiz_32344172_watch';
    // public static $user = 'epiz_32344172';
    // public static $password = 'IBt6qyymTW';
    // public static $port = 3306;


    public static $serverName = 'localhost';
    public static $dbName = 'watch';
    public static $user = 'root';
    public static $password = '';
    public static $port = 3306;

    public static $conn =null;
    
    public static function connection()
    {
        if (self::$conn == null) {
            self::$conn = new PDO(
                "mysql:host=" . self::$serverName . ";port=" . self::$port . ";dbname=" . self::$dbName,
                self::$user,
                self::$password,
            );

            self::$conn->query("set names utf8");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
}
