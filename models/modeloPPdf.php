<?php
if ($peticionAjax) {
    require_once "../config/servidor.php";
} else {
    require_once "../config/servidor.php";
}

class modeloPPdf{

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

}