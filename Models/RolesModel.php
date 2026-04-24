<?php
require_once "MasterModel.php";

class RolesModel extends MasterModel {

    public function listar(){
        $sql = "SELECT * FROM roles";
        return $this->ejecutar($sql)->get_result();
    }
}