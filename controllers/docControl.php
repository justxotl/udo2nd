<?php

if ($peticionAjax) {
    require_once "../models/docModel.php";
} else {
    require_once "./models/docModel.php";
}
class docControl extends docModel
{
    //Controlador para agregar usuarios 
    public function agregarDocControl()
    {
        $nombres_doc= $_POST['nombres_doc'];
        $apellidos_doc = $_POST['apellidos_doc'];
        $cedula_doc = $_POST['cedula_doc'];

        //Comprobar los campos vacios del formulario
        if ($nombres_doc == "" || $apellidos_doc == "" || $cedula_doc == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Por favor rellene los campos faltantes.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // verificando si los datos cumplen con el formato
        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,35}", $nombres_doc)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El nombre no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,35}", $apellidos_doc)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El apellido no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (modeloPrincipal::verificarDatos("[0-9\-]{6,20}", $cedula_doc)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El número de cédula no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Comprobando la existencia de cédula

        $check_ceddoc = modeloPrincipal::ejecutarConsultaSimple("SELECT cedula_doc FROM doc WHERE cedula_doc ='$cedula_doc'");
        if ($check_ceddoc->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR ",
                "Texto" => "El número de cédula ya se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $Inf_reg_doc = [
            "Nombre" => $nombres_doc,
            "Apellido" => $apellidos_doc,
            "Cedula" => $cedula_doc
        ];

        $agg_doc = docModel::modelAgregarDoc($Inf_reg_doc);
        if ($agg_doc->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Registro Exitoso",
                "Texto" => "Los datos del tratante han sido registrados con éxito.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Error en el registro de los datos del tratante.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    

}