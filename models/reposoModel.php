<?php

require_once "modeloPrincipal.php";

class reposoModel extends modeloPrincipal
{
    // Modelo para agregar reposos
    protected static function modelAgregarReposo($datos)
    {
        $sql = modeloPrincipal::conexion()->prepare("INSERT INTO reposos (fecha_cert, duracion, patologia, nombre_med, apellido_med, id_user) VALUES(:Inicio, :Duracion, :Patologia, :Nombremed, :Apellidomed, :IDuser)");
        
        $sql->bindParam(":Inicio", $datos['Inicio']);
        $sql->bindParam(":Duracion", $datos['Duracion']);
        $sql->bindParam(":Patologia", $datos['Patologia']);
        $sql->bindParam(":Nombremed", $datos['Nommed']);
        $sql->bindParam(":Apellidomed", $datos['Apemed']);
        $sql->bindParam(":IDuser", $datos['ID']);
        $sql->execute();
        return $sql;
    }

    //Modelo para eliminar reposos
    protected static function borrarReposoModel($id_rep)
    {
        $sql = modeloPrincipal::conexion()->prepare("DELETE FROM reposos WHERE id_rep=:ID");

        $sql->bindParam(":ID", $id_rep);
        $sql->execute();

        return $sql;
    }

     // Modelo datos reposo
    protected static function mostrarReposoModelo($id){
        
        $sql=modeloPrincipal::conexion()->prepare("SELECT * FROM user, info_per, reposos WHERE id=id_usu AND id=id_user AND id_rep=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;

    }

    //Modelo de fecha repso
    protected static function consignarReposoModelo($fecha){
        $sql = modeloPrincipal::conexion()->prepare("UPDATE reposos SET fecha_ven = :FechaVEN WHERE id_rep = :ID");

        $sql->bindParam(":ID", $fecha['ID']);
        $sql->bindParam(":FechaVEN", $fecha['FechaVEN']);
        $sql ->execute();

        return $sql;

    }

}
