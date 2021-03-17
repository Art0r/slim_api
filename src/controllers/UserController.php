<?php
    require_once "src/model/Database.php";
    define("table", "users");

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
            $results = $this->query("SELECT * FROM ". table);

            return $results;
        }

        public function getUser($id){
            $results = $this->query("SELECT * FROM " . table . " WHERE id = ?", [$id]);

            return $results;
        }

        public function createUser($name, $email) {
            $this->query("INSERT INTO " . table . "(name, email) VALUES (?, ?)", [$name, $email]);  
        }

        public function updateUser($id, $newName, $newEmail) {
            $this->query("UPDATE " . table . " SET name = ?, email = ? WHERE id = ?", [$newName, $newEmail, $id]);
        }
    }
?>