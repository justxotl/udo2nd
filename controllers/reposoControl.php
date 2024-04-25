<?php

if ($peticionAjax) {
    require_once "../models/reposoModel.php";
} else {
    require_once "./models/reposoModel.php";
}


class reposoControl extends reposoModel
{
    //Controlador para registrar reposos
    public function agregarReposoControlador()
    {
        $cedrep = $_POST['cedrep'];
        $duracionrep = $_POST['duracion'];
        $patologiarep = $_POST['patologia'];
        $ceddoc = $_POST['ceddoc'];

        //Comprobar los campos vacios del formulario
        if ($cedrep == "" || $duracionrep == "" || $patologiarep == "" || $ceddoc == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Por favor rellene los campos faltantes",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // verificando si los datos cumplen con el formato

        
        if (modeloPrincipal::verificarDatos("[0-9]{6,8}", $cedrep) ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "La Cédula no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (modeloPrincipal::verificarDatos("[0-9]{1,3}", $duracionrep) ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "La valor no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (modeloPrincipal::verificarDatos("[a-zA-ZñÑ]{3,400}", $patologiarep)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "La patología no coincide con el formato de texto solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (modeloPrincipal::verificarDatos("[0-9]{6,8}", $ceddoc) ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "La Cédula del Tratante no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        
        $Inf_reg_rep = [
            "Cedularep" => $cedrep,
            "Duracion" => $duracionrep,
            "Patologia" => $patologiarep,
            "Ceduladoc" => $ceddoc
        ];

        $agg_rep = reposoModel::modelAgregarReposo($Inf_reg_rep);
        if ($agg_rep->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "Los datos del reposo han sido registrado con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "Error en el registro de los datos del reposo",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/* Fin de del controlador */

   
    
}
