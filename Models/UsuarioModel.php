<?php
require_once "MasterModel.php";

class UsuarioModel extends MasterModel {

    public function listar(){
        $sql = "SELECT e.*, a.nombre as area_nombre FROM empleados e LEFT JOIN areas a ON e.area_id = a.id";
        return $this->ejecutar($sql)->get_result();
    }

    public function obtener($id){
        $sql = "SELECT * FROM empleados WHERE id=?";
        return $this->ejecutar($sql, [$id], "i")->get_result()->fetch_assoc();
    }

    public function crear($data){
        $sql = "INSERT INTO empleados(nombre, email, sexo, area_id, boletin, descripcion)
                VALUES(?,?,?,?,?,?)";

        $this->ejecutar($sql, [
            $data['nombre'],
            $data['email'],
            $data['sexo'],
            $data['area_id'],
            $data['boletin'],
            $data['descripcion']
        ], "ssssis");

        return $this->conn->insert_id;
    }

    public function vincularRol($empleado_id, $rol_id){
        $sql = "INSERT INTO empleado_rol(empleado_id, rol_id) VALUES(?,?)";
        return $this->ejecutar($sql, [$empleado_id, $rol_id], "ii");
    }

    public function actualizar($id, $data){
        $sql = "UPDATE empleados SET nombre=?, email=?, sexo=?, area_id=?, boletin=?, descripcion=? WHERE id=?";

        return $this->ejecutar($sql, [
            $data['nombre'],
            $data['email'],
            $data['sexo'],
            $data['area_id'],
            isset($data['boletin']) ? 1 : 0,
            $data['descripcion'],
            $id
        ], "ssssisi");
    }

    public function obtenerRoles($empleado_id){
        $sql = "SELECT rol_id FROM empleado_rol WHERE empleado_id=?";
        $result = $this->ejecutar($sql, [$empleado_id], "i")->get_result();
        $roles = [];
        while($row = $result->fetch_assoc()){
            $roles[] = $row['rol_id'];
        }
        return $roles;
    }

    public function desvincularRoles($empleado_id){
        $sql = "DELETE FROM empleado_rol WHERE empleado_id=?";
        return $this->ejecutar($sql, [$empleado_id], "i");
    }

    public function eliminar($empleado_id){
        $sql = "DELETE FROM empleados WHERE id=?";
        return $this->ejecutar($sql, [$empleado_id], "i");
    }
}