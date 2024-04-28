<?php

require_once "modeloPrincipal.php";

class usuarioModel extends modeloPrincipal
{
    // Modelo para agregar usuarios 
    protected static function modelAgregarUsers($datos)
    {
        $sql = modeloPrincipal::conexion()->prepare("INSERT INTO user (usuario, pass_u, nivel, cedula_usu) VALUES(:Usuario, :Clave, :Nivel, :Cedula)");

        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":Nivel", $datos['Nivel']);
        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->execute();

        if($sql == true){

            $sql = modeloPrincipal::conexion()->prepare("INSERT INTO info_per (cedula_pers, nombre_pers, apellido_pers, tlf_pers) VALUES(:Cedula, :Nombre, :Apellido, :Telefono)");

            $sql->bindParam(":Cedula", $datos['Cedula']);
            $sql->bindParam(":Nombre", $datos['Nombre']);
            $sql->bindParam(":Apellido", $datos['Apellido']);
            $sql->bindParam(":Telefono", $datos['Telefono']);
            $sql->execute();
        }


        return $sql;
    }

    //Modelo para eliminar usuarios
    protected static function borrarUsuarioModel($ced)
    {
        $sql = modeloPrincipal::conexion()->prepare("DELETE user, info_per FROM user JOIN info_per ON user.cedula_usu = info_per.cedula_pers WHERE user.cedula_usu= :Cedula");

        $sql->bindParam(":Cedula", $ced);
        $sql->execute();

        return $sql;

    }

     // Modelo datos usuario 
    protected static function mostrarDatosModelo($ced){
        
        $sql=modeloPrincipal::conexion()->prepare("SELECT * FROM user, info_per WHERE cedula_usu=:Cedula AND cedula_pers=:Cedula ");
        $sql->bindParam(":Cedula", $ced);
        $sql->execute();

        return $sql;
    }
    
    /*--> Modelo para actualizar usuarios <--*/
    protected static function actualizarUsuarioModel($datos)
    {
        $sql = modeloPrincipal::conexion()->prepare("UPDATE user INNER JOIN info_per ON user.cedula_usu = info_per.cedula_pers SET user.pass_u = :Clave, info_per.nombre_pers = :Nombres, info_per.apellido_pers = :Apellidos, info_per.tlf_pers = :Telefono WHERE user.cedula_usu = :Cedula;");

        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":Nombres", $datos['Nombres']);
        $sql->bindParam(":Apellidos", $datos['Apellidos']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->execute();

        return $sql;
    }
}
