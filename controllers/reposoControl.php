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
        $id = $_POST['id_usuario_rep_reg'];
        $duracionrep = $_POST['duracion'];
        $patologiarep = $_POST['patologia'];
        $nom_med = $_POST['nombres_doc'];
        $ape_med = $_POST['apellidos_doc'];

        //Comprobar los campos vacios del formulario
        if ($id == "" || $duracionrep == "" || $patologiarep == "" || $nom_med == "" || $ape_med == "") {
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

        if (modeloPrincipal::verificarDatos("[0-9]{1,2}", $duracionrep) ) {
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

        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,35}", $nom_med)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El nombre no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,35}", $ape_med)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El apellido no coincide con el formato solicitado.",
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

        // Comprobando la existencia del id

        $check_id = modeloPrincipal::ejecutarConsultaSimple("SELECT id FROM user WHERE id='$id'");
        if ($check_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El ID no existe dentro del sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $Inf_reg_rep = [
            "ID" => $id,
            "Duracion" => $duracionrep,
            "Patologia" => $patologiarep,
            "Nommed" => $nom_med,
            "Apemed" => $ape_med
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
        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM reposos INNER JOIN user INNER JOIN info_per WHERE id_user = id AND id_user = id_info GROUP BY cedula_pers";
        /*SELECT * FROM reposos INNER JOIN user WHERE id_user = id*/
        /*FROM reposos INNER JOIN user INNER JOIN info_per WHERE id_user = id AND id_user = id_info */

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
        ?>
        <style>
        table{
            table-layout: fixed;
        }
        td{
            word-wrap: normal;
            overflow: hidden;
        }
        </style>
        <?php
        if ($total >= 1) {
            foreach ($datos as $rows) {
                
                $tabla .= '
                <tr>
                <td>' . $rows['id'] . '</td>
                <td>' . $rows['nombre_pers'] . '</td>
                <td>' . $rows['apellido_pers'] . '</td>
                <td>' . $rows['cedula_pers'] . '</td>
                
                <td class="d-flex justify-content-center">

                <a href="'.SERVERURL.'rep-individual/'.$rows['id'].'/" class="btn btn-info btn-sm">Ver Reposos</a>

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

    // Controlador ver reposos según la persona
    public function tablaRepososIndv($id)
    {
        
        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM reposos INNER JOIN user INNER JOIN info_per WHERE id_user = id AND id_user = id_info AND id='$id'";

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
                <th>Patología</th>
                <th>Gestión</th>
            </tr>
        </thead>
        <tbody>
        ';
        ?>
        <style>
        table{
            table-layout: fixed;
        }
        td{
            word-wrap: normal;
            overflow: hidden;
        }
        </style>
        <?php
        if ($total >= 1) {
            foreach ($datos as $rows) {
                
                $tabla .= '
                <tr>
                <td>' . $rows['id_rep'] . '</td>
                <td>' . $rows['nombre_pers'] . '</td>
                <td>' . $rows['apellido_pers'] . '</td>
                <td>' . $rows['patologia'] . '</td>
                
                <td class="d-flex justify-content-center">
                <form class=" FormularioAjax" action="'.SERVERURL.'ajax/ajaxReposo.php" method="POST" data-form="delete">
                
                <input type="hidden" name="borrar_reg_rep" value="'.$rows['id_rep'].'">
                
                <button type="submit" class="btn btn-sm btn-danger">Borrar</button>

                </form>

                &nbsp;

                <a href="'.SERVERURL.'detalles-rep/'.$rows['id_rep'].'/" class="btn btn-success btn-sm">Detalles</a>

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

    public static function mostrarReposoControl($id)
    {        
        $id= $id;
        return reposoModel::mostrarReposoModelo($id);
    
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
