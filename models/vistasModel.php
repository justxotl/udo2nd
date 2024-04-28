<?php

class vistasModel
{

    //Modelo para obtener vistas 
    protected static function model_obtener_view($view)
    {
       //
        $listWhite = [
            "dashboard", "usuario", "usuario-crud", "usuario-up", "registro-rep", "tabla-reposo"
        ];
        if (in_array($view, $listWhite)) {
            if (is_file("./view/contenidos/" . $view . "-alvarez.php")) {
                $contenido = "./view/contenidos/" . $view . "-alvarez.php";
            } else {
                $contenido = "404";
            }
        } elseif ($view == "login" || $view == "index") {
            $contenido = "login";
        } else {
            $contenido = "404";
        }
        return $contenido;

    }
}