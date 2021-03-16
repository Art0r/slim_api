<?php
    require_once "src/model/Database.php";

    class UserController {
        private $conn;

        public function __construct()
        {
            $pdo = new Database();
            $this->conn = $pdo->getConn();
        }

        private function query($rawQuery, $params = array()){
            $stmt = $this->conn->prepare($rawQuery);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllUsers(){
            $results = $this->query("SELECT * FROM users");

            return $results;
        }

        public function getUser($id){
            $results = $this->query("SELECT * FROM users WHERE id = ?", [$id]);

            return $results;
        }
    }
?>