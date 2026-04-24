<?php
require_once "../models/UsuarioModel.php";

$model = new UsuarioModel();

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

    if($action == "crear"){
        validar($_POST);

        $boletin = isset($_POST['boltin']) ? 1 : 0;
        $roles = $_POST['roles'] ?? [];

        // Insertar empleado
        $empleado_id = $model->crear([
            'nombre' => $_POST['nombre'],
            'email' => $_POST['correo'],
            'sexo' => $_POST['sexo'],
            'area_id' => $_POST['area'],
            'boletin' => $boletin,
            'descripcion' => $_POST['descripcion']
        ]);

        // Vincular roles
        foreach($roles as $rol_id){
            $model->vincularRol($empleado_id, $rol_id);
        }

        echo json_encode(["status"=>"ok"]);
    }

    if($action == "obtener"){
        $data = $model->obtener($_POST['id']);
        $data['roles'] = $model->obtenerRoles($_POST['id']);
        echo json_encode($data);
    }

    if($action == "actualizar"){
        validar($_POST);

        $boletin = isset($_POST['boltin']) ? 1 : 0;
        $roles = $_POST['roles'] ?? [];

        // Actualizar empleado
        $model->actualizar($_POST['id'], [
            'nombre' => $_POST['nombre'],
            'email' => $_POST['correo'],
            'sexo' => $_POST['sexo'],
            'area_id' => $_POST['area'],
            'boletin' => $boletin,
            'descripcion' => $_POST['descripcion']
        ]);

        // Desvincular roles antiguos y vincular nuevos
        $model->desvincularRoles($_POST['id']);
        foreach($roles as $rol_id){
            $model->vincularRol($_POST['id'], $rol_id);
        }

        echo json_encode(["status"=>"ok"]);
    }

    if($action == "eliminar"){
        $model->desvincularRoles($_POST['id']);
        $model->eliminar($_POST['id']);
        echo json_encode(["status"=>"ok"]);
    }
} catch(Exception $e){
    echo json_encode(["error"=>$e->getMessage()]);
}

function validar($data){
    if(empty($data['nombre']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $data['nombre'])){
        throw new Exception("El nombre solo debe contener letras y espacios.");
    }
    if(empty($data['correo']) || !filter_var($data['correo'], FILTER_VALIDATE_EMAIL)){
        throw new Exception("El correo debe tener un formato válido.");
    }
    if(empty($data['sexo']) || !in_array($data['sexo'], ['M', 'F'])){
        throw new Exception("El sexo debe ser M o F.");
    }
    if(empty($data['area'])){
        throw new Exception("Debe seleccionar un área.");
    }
    if(empty($data['descripcion'])){
        throw new Exception("La descripción es obligatoria.");
    }
    if(empty($data['roles']) || !is_array($data['roles'])){
        throw new Exception("Debe seleccionar al menos un rol.");
    }
}
