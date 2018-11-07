<?php
    class db{
        // Properties
        private $dbhost = 'localhost';
        private $dbuser = 'root';
        private $dbpass = '123456';
        private $dbname = 'slimapp';

        // Connect with Enable UTF-8
         public function connect(){
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass,[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
    }
