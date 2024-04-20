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
}
