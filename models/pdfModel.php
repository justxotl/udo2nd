<?php

require_once "modeloPPdf.php";

class pdfModel extends modeloPPdf
{

 	protected static function mostrarPdfModelo($id){
        
        $sql=modeloPPdf::conexion()->prepare("SELECT * FROM user, info_per, reposos WHERE id=id_usu AND id=id_user AND id_rep=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;

    }

}