<?php
class Database{
    public $serverName = 'localhost';
    public $dbName = 'watch';
    public $user = 'root';
    public $password = '';

    public function connection(){
        $pdo = new PDO("mysql:host=$this->serverName;dbname=$this->dbName",$this->user,$this->password);
        $pdo->query("set names utf8");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}
