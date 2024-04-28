<?php

require_once "modeloPrincipal.php";

class reposoModel extends modeloPrincipal
{
    // Modelo para agregar usuarios 
    protected static function modelAgregarReposo($datos)
    {
        $sql = modeloPrincipal::conexion()->prepare("INSERT INTO reposos ( cedula_rep, duracion, patologia, cedula_doc) VALUES(:Cedularep, :Duracion, :Patologia, :Ceduladoc)");

        $sql->bindParam(":Cedularep", $datos['Cedularep']);
        $sql->bindParam(":Duracion", $datos['Duracion']);
        $sql->bindParam(":Patologia", $datos['Patologia']);
        $sql->bindParam(":Ceduladoc", $datos['Ceduladoc']);
        $sql->execute();
        return $sql;
    }

    //Modelo para eliminar usuarios
    protected static function borrarReposoModel($id_rep)
    {
        $sql = modeloPrincipal::conexion()->prepare("DELETE FROM reposos WHERE id_rep=:ID");

        $sql->bindParam(":ID", $id_rep);
        $sql->execute();

        return $sql;
    }

}
