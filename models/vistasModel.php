<?php

class vistasModel
{

    //Modelo para obtener vistas 
    protected static function model_obtener_view($view)
    {
        $listWhite = [
            "dashboard", "usuario", "usuario-crud", "usuario-up", "registro-rep", "tabla-reposo", "rep-individual", "detalles-rep"
        ];

        if (in_array($view, $listWhite)) {
            if (is_file("./view/contenidos/" . $view . "-alvarez.php")) {
                $contenido = "./view/contenidos/" . $view . "-alvarez.php";
            } else {
                $contenido = "404";
            }
        } elseif ($view == "login" || $view == "index") {
            $contenido = "login";
        } elseif ($view == "check-user"){
            $contenido = "check-user";
        } elseif ($view == "preguntas") {
            $contenido = "preguntas";
        } else {
            $contenido = "404";
        }
        return $contenido;

    }
}