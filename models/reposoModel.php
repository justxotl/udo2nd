<?php

require_once "modeloPrincipal.php";

class reposoModel extends modeloPrincipal
{
    /*--> Modelo para agregar portafolio modelo <--*/

    protected static function agregarFotoModel($datosfoto)
    {
        $sql = modeloPrincipal::conexion()->prepare("INSERT INTO fotosrep (foto, id_u) VALUES(:Foto, :ID)");

        $sql->bindParam(":Foto", $datosfoto['Foto']);
        $sql->bindParam(":ID", $datosfoto['ID']);
        $sql->execute();

        return $sql;
    }

    // Modelo para agregar reposos
    protected static function modelAgregarReposo($datos)
    {
        $conn = modeloPrincipal::conexion();

        $sql = $conn->prepare("INSERT INTO reposos (fecha_cert, duracion, patologia, id_user, id_doc) VALUES(:Inicio, :Duracion, :Patologia, :IDuser, :IDMed)");

        $sql->bindParam(":Inicio", $datos['Inicio']);
        $sql->bindParam(":Duracion", $datos['Duracion']);
        $sql->bindParam(":Patologia", $datos['Patologia']);
        $sql->bindParam(":IDMed", $datos['IDMed']);
        $sql->bindParam(":IDuser", $datos['ID']);

        $sql->execute();

        if ($sql == true) {

            $ultimo_id = $conn->lastInsertId();

            $sql = $conn->prepare("INSERT INTO fotosrep (foto, id_u, id_re) VALUES(:Foto, :IDuser, :IDRep)");

            $sql->bindParam(":Foto", $datos['Foto']);
            $sql->bindParam(":IDuser", $datos['ID']);
            $sql->bindParam(":IDRep", $ultimo_id,  PDO::PARAM_INT);

            $sql->execute();
        }

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
    protected static function mostrarReposoModelo($id)
    {

        $sql = modeloPrincipal::conexion()->prepare("SELECT * FROM user, info_per, reposos, medico, fotosrep WHERE id=id_usu AND id=id_user AND id_med=id_doc AND id_rep = id_re AND id_rep=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;
    }

    //Modelo de fecha repso
    protected static function consignarReposoModelo($fecha)
    {
        $sql = modeloPrincipal::conexion()->prepare("UPDATE reposos SET fecha_ven = :FechaVEN WHERE id_rep = :ID");

        $sql->bindParam(":ID", $fecha['ID']);
        $sql->bindParam(":FechaVEN", $fecha['FechaVEN']);
        $sql->execute();

        return $sql;
    }

    protected static function contarReposoModel()
    {

        $sql = modeloPrincipal::conexion()->prepare("SELECT id_rep FROM reposos");
        $sql->execute();

        return $sql;
    }
}
