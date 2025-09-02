<?php
class Database {
    private $host = "mysql-3c77b02a-ingdewingonzalez-5c0e.d.aivencloud.com";
   
    private $db_name = "bd_energia_renovable";
    private $username = "avnadmin";
    private $password = "AVNS_0MJ8tsk8s4mkWFArkIY";
     private $port="14359";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>