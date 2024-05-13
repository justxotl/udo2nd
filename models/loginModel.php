<?php

require_once "modeloPrincipal.php";

class loginModel extends modeloPrincipal
{

    //Modelo para poder iniciar sesion
    protected static function modeloIniciarSesion($datos)
    {
        $sql = modeloPrincipal::conexion()->prepare("SELECT * FROM user WHERE usuario=:Usuario AND pass_u=:Clave");
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->execute();

        return $sql;
    }

    //Modelo para recibir preguntas secretas
    protected static function modeloRecibirPreguntas($quest){

        $sql=modeloPrincipal::conexion()->prepare("SELECT * FROM user WHERE usuario=:Usuario");
        $sql->bindParam(":Usuario", $quest);
        $sql->execute();

        return $sql;

    }

     //Modelo para 
    protected static function resetearClaveModel($contra){

        $sql = modeloPrincipal::conexion()->prepare("UPDATE user SET pass_u =:Clave WHERE usuario =:Usuario;");

        $sql->bindParam(":Usuario", $contra['User']);
        $sql->bindParam(":Clave", $contra['Pass']);
        $sql->execute();

        return $sql;
    }
}
