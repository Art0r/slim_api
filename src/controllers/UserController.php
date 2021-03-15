<?php
    require_once "src/model/Database.php";

    class UserController {
        private $conn;

        public function __construct()
        {
            $pdo = new Database();
            $this->conn = $pdo->getConn();
        }

        public function getAllUsers(){
            $stmt = $this->conn->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>