<?php

require_once "modeloPrincipal.php";

class docModel extends modeloPrincipal{

    // Modelo para agregar tratante
    protected static function modelAgregarDoc($datos)
    {
        $sql = modeloPrincipal::conexion()->prepare("INSERT INTO doc (cedula_doc, nombres_doc, apellidos_doc) VALUES(:Cedula, :Nombre, :Apellido)");

        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Apellido", $datos['Apellido']);
        $sql->execute();
        
        return $sql;
    }

}
