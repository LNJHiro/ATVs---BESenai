<?php
class Database {
    private $host = "localhost";
    private $db_name = "Oficina";
    private $username = "root";
    private $password = "SenaiSP";

    public function getConnection() {
        try {
            $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $conn->exec("set names utf8");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
            return null;
        }
    }
}
?>