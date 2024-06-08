<?php

require_once "modeloPrincipal.php";

class medModel extends modeloPrincipal{

    //Modelo para agregar médicos
    protected static function agregarMedModel($datos){

        $sql = modeloPrincipal::conexion()->prepare("INSERT INTO medico (ced_med, nom_med, ape_med) VALUES(:Cedula, :Nombre, :Apellido)");
        
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Apellido", $datos['Apellido']);
        $sql->bindParam(":Cedula", $datos['Cedula']);
        
        $sql->execute();
        return $sql;
    }

    //Modelo para eliminar usuarios
    protected static function borrarMedModel($id)
    {
        $sql = modeloPrincipal::conexion()->prepare("DELETE FROM medico WHERE id_med = :ID");

        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;

    }

}