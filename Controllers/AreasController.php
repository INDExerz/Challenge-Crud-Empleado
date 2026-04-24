<?php
require_once "../models/AreasModel.php";

$model = new AreasModel();

$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {

    if($action == "listar"){
        $data = $model->listar();
        $result = [];

        while($row = $data->fetch_assoc()){
            $result[] = $row;
        }

        echo json_encode($result);
    }

}catch(Exception $e){
    echo json_encode(["error"=>$e->getMessage()]);
}