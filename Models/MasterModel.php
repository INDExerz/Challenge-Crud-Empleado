<?php
require_once "../Config/conexion.php";

class MasterModel {
    protected $conn;

    public function __construct(){
        $this->conn = (new Connection())->connect();
    }

    public function ejecutar($sql, $params = [], $types = ""){
        $stmt = $this->conn->prepare($sql);

        if($params){
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt;
    }
}