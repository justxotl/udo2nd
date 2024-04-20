<?php

require_once "modeloPrincipal.php";

class usuarioModel extends modeloPrincipal
{
    // Modelo para agregar usuarios 
    protected static function modelAgregarUsers($datos)
    {
        $sql = modeloPrincipal::conexion()->prepare("INSERT INTO user (usuario, pass_u, nivel) VALUES(:Usuario, :Clave, :Nivel)");

        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":Nivel", $datos['Nivel']);
        $sql->execute();
        return $sql;
    }

    //Modelo para eliminar usuarios
    protected static function borrarUsuarioModel($id)
    {
        $sql = modeloPrincipal::conexion()->prepare("DELETE FROM user WHERE id=:ID");

        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;
    }

    
    /*--> Modelo para actualizar usuarios <--*/
    protected static function actualizarUsuarioModel($datos)
    {
        $sql = modeloPrincipal::conexion()->prepare("UPDATE user SET pass_u=:Clave WHERE id=:ID ");

        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":ID", $datos['ID']);
        $sql->execute();

        return $sql;
    }
}
