<?php
require_once "MasterModel.php";

class AreasModel extends MasterModel {

    public function listar(){
        $sql = "SELECT * FROM areas";
        return $this->ejecutar($sql)->get_result();
    }
}