<?php

require_once "modeloPrincipal.php";

class usuarioModel extends modeloPrincipal
{
    // Modelo para agregar usuarios 
    protected static function modelAgregarUsers($datos)
    {
        $conn=modeloPrincipal::conexion();
        
        $sql = $conn->prepare("INSERT INTO user (usuario, pass_u, nivel) VALUES(:Usuario, :Clave, :Nivel)");

        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":Nivel", $datos['Nivel']);
        $sql->execute();

        if($sql == true){

            $ultimo_id=$conn->lastInsertId();
            
            $sql = $conn->prepare("INSERT INTO info_per (cedula_pers, nombre_pers, apellido_pers, tlf_pers, id_usu) VALUES(:Cedula, :Nombre, :Apellido, :Telefono, :ID)");

            $sql->bindParam(":Cedula", $datos['Cedula']);
            $sql->bindParam(":Nombre", $datos['Nombre']);
            $sql->bindParam(":Apellido", $datos['Apellido']);
            $sql->bindParam(":Telefono", $datos['Telefono']);
            $sql->bindParam(":ID", $ultimo_id,  PDO::PARAM_INT);
            $sql->execute();
        }

        return $sql;
    }

    //Modelo para eliminar usuarios
    protected static function borrarUsuarioModel($id)
    {
        $sql = modeloPrincipal::conexion()->prepare("DELETE FROM user WHERE id = :ID");

        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;

    }

     // Modelo datos usuario 
    protected static function mostrarDatosModelo($id){
        
        $sql=modeloPrincipal::conexion()->prepare("SELECT * FROM user, info_per WHERE id=id_usu AND id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;

    }
    
    /*--> Modelo para actualizar usuarios <--*/
    protected static function actualizarUsuarioModel($datos)
    {
        $sql = modeloPrincipal::conexion()->prepare("UPDATE user INNER JOIN info_per ON user.id = info_per.id_usu SET user.pass_u = :Clave, info_per.nombre_pers = :Nombres, info_per.apellido_pers = :Apellidos, info_per.tlf_pers = :Telefono WHERE user.id = :ID;");
        
        $sql->bindParam(":ID", $datos['ID']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":Nombres", $datos['Nombres']);
        $sql->bindParam(":Apellidos", $datos['Apellidos']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->execute();

        return $sql;
    }
}

