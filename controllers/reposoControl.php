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

        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,400}", $patologiarep)) {
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

        // Comprobando la existencia de la cedula del reposo

        $check_cedula = modeloPrincipal::ejecutarConsultaSimple("SELECT cedula_pers FROM info_per WHERE cedula_pers ='$cedrep'");
        if ($check_cedula->rowCount() == 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR ",
                "Texto" => "El número de cédula no se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Comprobando la existencia de la cedula del tratante

        $check_ceddoc = modeloPrincipal::ejecutarConsultaSimple("SELECT cedula_doc FROM doc WHERE cedula_doc ='$ceddoc'");
        if ($check_ceddoc->rowCount() == 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR ",
                "Texto" => "El número de cédula de tratante no se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Comprobando duración del reposo

        if ($duracionrep < 3 ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ATENCIÓN",
                "Texto" => "El reposo médico tiene una duración minima de 3 días.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if ($duracionrep > 21 ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ATENCIÓN",
                "Texto" => "El reposo médico tiene una duración máxima de 21 días.",
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
                "Titulo" => "Reposo registrado",
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

    //Controlador para mostrar reposos en una tabla

    public function tablaReposoControl()
    {
        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM info_per, reposos WHERE cedula_pers=cedula_rep ORDER BY id_rep ASC";


        $conexion = modeloPrincipal::conexion();

        $datos = $conexion->query($consulta);

        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()");

        $total = (int) $total->fetchColumn();

        $tabla = '
        <table id="example" class="table table-striped table-bordered container">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Gestión</th>
            </tr>
        </thead>
        <tbody>
        ';

        if ($total >= 1) {
            foreach ($datos as $rows) {
                $tabla .= '
                <tr>
                <td>' . $rows['id_rep'] . '</td>
                <td>' . $rows['nombre_pers'] . '</td>
                <td>' . $rows['apellido_pers'] . '</td>
                <td>' . $rows['cedula_pers'] . '</td>
                
                <td>
                <form class=" FormularioAjax" action="'.SERVERURL.'ajax/ajaxReposo.php" method="POST" data-form="delete">
                
                <input type="hidden" name="borrar_reg_rep" value="'.$rows['id_rep'].'">
                
                <button type="submit" class="btn btn-sm btn-danger">
                        Borrar
                    </button>
                </form>

            </tr>';
            }
        } else {
            $tabla .= '<tr> <td colspan="9">No hay registros en el sistema</td> </tr>';
        }

        $tabla .= '
        </tbody>
        </table>
        ';
        return $tabla;

    }

    //Controlador para eliminar un usuario
    public function borrarReposoControl()
    {
        //recibiendo el id del reposo
        $id_rep= $_POST['borrar_reg_rep'];

        // comprobando si el reposo existe en la base de datos
        
        $revisarReposo=modeloPrincipal::ejecutarConsultaSimple("SELECT id_rep FROM reposos WHERE id_rep='$id_rep'");
        if($revisarReposo->rowCount()<=0){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"ERROR",
                "Texto"=>" Ahora te sientas y me explicas mediante método científico cómo hiciste esa vaina.",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $borrarReposo= reposoModel::borrarReposoModel($id_rep);
        
        if($borrarReposo-> rowCount()==1){
            $alerta=[
                "Alerta"=>"recargar",
                "Titulo"=>"Reposo Eliminado",
                "Texto"=>"Siyuleirer mi pana.",
                "Tipo"=>"success"
            ];
        }else{
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"ERROR",
                "Texto"=>"Tas fuera de ranking",
                "Tipo"=>"error"
            ];
            
        }

        echo json_encode($alerta);

    }

}
