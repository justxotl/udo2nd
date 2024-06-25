<?php
if ($peticionAjax) {
    require_once "../config/servidor.php";
} else {
    require_once "./config/servidor.php";
}

class modeloPrincipal
{
    // Funcion para conectar con la base de datos
    protected static function conexion()
    {
        $conexion = new PDO(SGBD, USER, PASS);
        $conexion->exec("SET CHARACTER SET utf8");
        
        return $conexion;
    }

    // Funcion ejecutar consultas simples a la base de datos
    protected static function ejecutarConsultaSimple($consulta)
    {
        $sql = self::conexion()->prepare($consulta);
        $sql->execute();
        return $sql;
    }

    // Funcion para generar codigos aleatorios
    protected static function generarCodigoAleatorio($letra, $longitud, $numero)
    {
        for ($i = 1; $i <= $longitud; $i++) {
            $aleatorio = rand(0, 9);
            $letra .= $aleatorio;
        }
        return $letra . "-" . $numero;
    }


    //Funcion para verificar datos
    protected static function verificarDatos($filtro, $cadena)
    {
        if (preg_match("/^" . $filtro . "$/", $cadena)) { //investigar el /^ y $/
            return false;
        } else {
            return true;
        }
    }
}
