<?php
    require_once "vendor/autoload.php";

    define("DB_DRIVER", "mysql");
    define("DB_SCHEMA", "dbphp");
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");

    class Database {
        private $conn;

        public function __construct()
        {
            $this->conn = new PDO(DB_DRIVER . 
            ":dbname=" . DB_SCHEMA . 
            ";host=" . DB_HOST , DB_USER, DB_PASSWORD );
        }

        public function getConn(){
            return $this->conn;
        }
    }
?>