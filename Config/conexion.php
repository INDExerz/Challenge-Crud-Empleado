<?php
class Connection {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "prueba_php";

    public function connect(){
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if($conn->connect_error){
            die("Error de conexión: " . $conn->connect_error);
        }

        $conn->set_charset("utf8");
        return $conn;
    }
}