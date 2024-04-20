<?php

require_once "./models/vistasModel.php";

class vistasControl extends vistasModel
{

    // Controlador para obtener  el formato
    public function control_obtener_formato()
    {
        return require_once "./view/formato.php";
    }

    // Controlador para obtener las vistas/view 
    public function control_obtener_view()
    {
        if (isset($_GET['alvarez'])) {
            $ruta = explode("/", $_GET['alvarez']);
            $respuesta = vistasModel::model_obtener_view($ruta[0]);
        } else {
            $respuesta = "login";
        }
        return $respuesta;
    }
}

    //A1