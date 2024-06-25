<?php

if ($peticionAjax) {
    require_once "../models/medModel.php";
} else {
    require_once "./models/medModel.php";
}

class medControl extends medModel
{

    //Controlador para registrar médicos
    public function agregarMedControl()
    {

        $nommed = $_POST['nombres_doc'];
        $apemed = $_POST['apellidos_doc'];
        $cedmed = $_POST['cedula_doc'];
        $certmed = $_POST['certificado_doc'];

        if ($nommed == "" || $apemed == "" || $cedmed == "" || $certmed == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Por favor rellene los campos faltantes",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,35}", $nommed)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El nombre no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,35}", $apemed)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El apellido no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (modeloPrincipal::verificarDatos("[0-9\-]{6,8}", $cedmed)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El número de cédula no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (modeloPrincipal::verificarDatos("[0-9\-]{6,8}", $certmed)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El certificado no coincide con el formato válido.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Comprobando la existencia de cédula

        $check_cedula = modeloPrincipal::ejecutarConsultaSimple("SELECT ced_med FROM medico WHERE ced_med ='$cedmed'");
        if ($check_cedula->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR ",
                "Texto" => "El número de cédula ya se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Comprobando la existencia del certificado

        $check_certif = modeloPrincipal::ejecutarConsultaSimple("SELECT cert_med FROM medico WHERE cert_med ='$certmed'");
        if ($check_certif->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR ",
                "Texto" => "El código de certificado ya se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $registrar = [
            "Nombre" => $nommed,
            "Apellido" => $apemed,
            "Cedula" => $cedmed,
            "Certificado" => $certmed
        ];

        $agg_med = medModel::agregarMedModel($registrar);
        if ($agg_med->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Registro Exitoso",
                "Texto" => "Los datos del médico han sido registrados con éxito.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Error en el registro de los datos del médico.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    //Controlador para mostrar usuarios en una tabla
    public function tablaMedControl()
    {

        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM medico ORDER BY id_med ASC";

        $conexion = modeloPrincipal::conexion();

        $datos = $conexion->query($consulta);

        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()");

        $total = (int) $total->fetchColumn();

        $tabla = '
        <table id="example" class="table table-striped table-bordered container">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Certificado</th>
                <th>Gestión</th>
            </tr>
        </thead>
        <tbody>
        ';
        if ($total >= 1) {
            foreach ($datos as $rows) {
                $tabla .= '
                <tr>
                <td>' . $rows['nom_med'] . '</td>
                <td>' . $rows['ape_med'] . '</td>
                <td>' . $rows['ced_med'] . '</td>
                <td>' . $rows['cert_med'] . '</td>
                <td class="d-flex justify-content-center">
                <form class="  FormularioAjax" action="' . SERVERURL . 'ajax/ajaxMed.php" method="POST" data-form="delete">
                
                <input type="hidden" name="borrar_id_med" value="' . $rows['id_med'] . '">
                
                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"><i class="fa-solid fa-trash-alt"></i></button>
                </form>
                </td>
            </tr>';
            }
        } else {
            $tabla .= '<tr> <td colspan="9">No hay registros en el sistema.</td> </tr>';
        }

        $tabla .= '
        </tbody>
        </table>
        ';
        return $tabla;
    }/* Fin de del controlador */

    //Controlador para eliminar un usuario
    public function borrarMedControl()
    {
        //recibiendo el id del usuario
        $id = $_POST['borrar_id_med'];

        // comprobando si el usuario existe en la base de datos

        $revisarID = modeloPrincipal::ejecutarConsultaSimple("SELECT id_med FROM medico WHERE id_med='$id'");
        if ($revisarID->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => " Ahora te sientas y me explicas con método científico cómo hiciste eso.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $borrarUsuario = medModel::borrarMedModel($id);

        if ($borrarUsuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Médico Eliminado",
                "Texto" => "Médico eliminado con éxito.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Ha ocurrido un error en la eliminación.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    // Controlador selector Medico
    public static function medSelectControl()
    {

        $select = modeloPrincipal::ejecutarConsultaSimple("SELECT * FROM medico ORDER BY id_med");
        return $select;
    }
    /* Fin de del controlador */

    public function contarMedicoControl()
    {

        return medModel::contarMedicoModel();
    }
}
