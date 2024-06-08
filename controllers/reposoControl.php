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
        $inicio = $_POST['inicio'];
        $duracionrep = $_POST['duracion'];
        $patologiarep = $_POST['patologia'];
        $data_med = $_POST['medico'];
        $tipo_de_cuenta=$_POST['tipo_de_cuenta'];

        //Comprobar los campos vacios del formulario
        if ($id == "" || $inicio == "" || $duracionrep == "" || $patologiarep == "" || $data_med == "") {
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

        // Comprobando la existencia del id del médico

        $check_id_doc = modeloPrincipal::ejecutarConsultaSimple("SELECT id_med FROM medico WHERE id_med='$data_med'");
        if ($check_id_doc->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El ID del médico no existe dentro del sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Comprobando credenciales para actualizar datos

        if($tipo_de_cuenta=="propio"){
            $check_cuenta = modeloPrincipal::ejecutarConsultaSimple("SELECT id FROM user WHERE id ='$id'");
        }else{
            session_start(['name' => 'UDO']);
            if($_SESSION['nivel_UDO']!=1){    
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"ERROR",
                    "Texto"=>"No cuentas con los privilegios para realizar esta acción.",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $id_admin=$_SESSION['id_UDO'];
            $check_cuenta=modeloPrincipal::ejecutarConsultaSimple("SELECT id FROM user WHERE id ='$id_admin'");
        }
            if($check_cuenta->rowCount()<=0){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"ERROR",
                "Texto"=>"",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $Inf_reg_rep = [
            "ID" => $id,
            "Inicio" => $inicio,
            "Duracion" => $duracionrep,
            "Patologia" => $patologiarep,
            "IDMed" => $data_med
        ];

        $agg_rep = reposoModel::modelAgregarReposo($Inf_reg_rep);

        if ($agg_rep->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Reposo registrado",
                "Texto" => "Los datos del reposo han sido registrado con éxito",
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
        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM reposos INNER JOIN user INNER JOIN info_per WHERE id_user = id AND id_user = id_usu GROUP BY cedula_pers ";
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
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>N° de reposos</th>
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
            text-overflow: ellipsis;
        }
        </style>
        <?php
        if ($total >= 1) {
            foreach ($datos as $rows) {
                
                $id=$rows['id'];
                $reposo=modeloPrincipal::ejecutarConsultaSimple("SELECT * FROM reposos WHERE id_user='$id'");
                $Nreposo=$reposo->rowCount();
                
                $tabla .= '
                <tr>
                <td>' . $rows['nombre_pers'] . '</td>
                <td>' . $rows['apellido_pers'] . '</td>
                <td>' . $rows['cedula_pers'] . '</td>
                <td>' .$Nreposo. '</td>
                

                <td class="d-flex justify-content-center">

                <a href="'.SERVERURL.'rep-individual/'.$rows['id'].'/" class="btn btn-info btn-sm" title="Ver Reposos"><i class="fa-solid fa-eye"></i></a>


                </td>
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
        
        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM reposos INNER JOIN user INNER JOIN info_per WHERE id_user = id AND id_user = id_usu AND id='$id'";

        $conexion = modeloPrincipal::conexion();

        $datos = $conexion->query($consulta);

        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()");

        $total = (int) $total->fetchColumn();

        $tabla = '
        <table id="example2" class="table table-striped table-bordered container">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Patología</th>
                <th>Fecha de Inicio</th>
                <th>Fecha Vencimiento</th>
                <th>Estado</th>
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
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        </style>
        <?php
        if ($total >= 1) {
            foreach ($datos as $rows) {
                
                $estado="";
                if($rows['fecha_ven']==NULL){
                    $estado='<div class="btn btn-sm btn-primary" style="width: 100%">SIN CONSIGNAR</div>';
                }else{
                    
                    $fecha_actual = new DateTime(date('Y-m-d'));
                    $fecha_final = new DateTime($rows['fecha_ven']);
                    $dias = $fecha_actual->diff($fecha_final)->format('%r%a');
                    
                    if ($dias <= 0) {
                        $estado='<div class="btn btn-sm btn-danger" style="width: 100%">VENCIDO</div>';
                    } elseif ($dias >= 1 && $dias <= 3) { 
                        $estado='<div class="btn btn-sm btn-warning" style="width: 100%">FALTAN '.$dias.' DÍAS</div>';
                    }else{
                        $estado='<div class="btn btn-sm btn-success" style="width: 100%">VIGENTE</div>';
                    }
                }

                $tabla .= '
                <tr>
                <td>' . $rows['id_rep'] . '</td>
                <td>' . $rows['nombre_pers'] . '</td>
                <td>' . $rows['apellido_pers'] . '</td>
                <td>' . $rows['patologia'] . '</td>
                <td>' . $rows['fecha_cert'] . '</td>
                <td>' . $rows['fecha_ven'] . '</td>
                <td class="text-center">' . $estado . '</td>

                <td class="d-flex justify-content-center">
                <form class=" FormularioAjax" action="'.SERVERURL.'ajax/ajaxReposo.php" method="POST" data-form="delete">
                
                <input type="hidden" name="borrar_reg_rep" value="'.$rows['id_rep'].'">
                
                <button type="submit" class="btn btn-sm btn-danger" title="Borrar"><i class="fa-solid fa-trash-alt"></i></button>

                </form>

                &nbsp;

                <a href="'.SERVERURL.'detalles-rep/'.$rows['id_rep'].'/" class="btn btn-primary btn-sm" title="Detalles"><i class="fa-solid fa-search-plus"></i></a>

                &nbsp;

                <form class=" FormularioAjax" action="'.SERVERURL.'ajax/ajaxReposo.php" method="POST" data-form="consignar">
                
                <input type="hidden" name="consignar_rep" value="'.$rows['id_rep'].'">
                
                <button type="submit" class="btn btn-sm btn-success" title="Consignar"><i class="fa-solid fa-check-double"></i></button>

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
                "Texto"=>" Ahora te sientas y me explicas mediante método científico cómo hiciste eso.",
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
                "Texto"=>"El reposo ha sido eliminado del sistema.",
                "Tipo"=>"success"
            ];
        }else{
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"ERROR",
                "Texto"=>"Ha ocurrido un error. ",
                "Tipo"=>"error"
            ];
            
        }

        echo json_encode($alerta);

    }

    //Controlador para consignar un reposo
    public function consignarReposoControl()
    {
        //recibiendo el id del reposo
        $id_rep= $_POST['consignar_rep'];

        // comprobando si el reposo existe en la base de datos
        
        $revisarReposo=modeloPrincipal::ejecutarConsultaSimple("SELECT id_rep FROM reposos WHERE id_rep='$id_rep'");
        if($revisarReposo->rowCount()<=0){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"ERROR",
                "Texto"=>" Ahora te sientas y me explicas mediante método científico cómo hiciste eso.",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $fechaini = modeloPrincipal::ejecutarConsultaSimple("SELECT fecha_cert FROM reposos WHERE id_rep='$id_rep'");
        $fechacon = $fechaini->fetch();

        $sumar = modeloPrincipal::ejecutarConsultaSimple("SELECT duracion FROM reposos WHERE id_rep='$id_rep'");
        $suma = $sumar->fetch();

        $fechaven = date('Y-m-d', strtotime($fechacon['fecha_cert'].'+'.$suma['duracion'].'days'));
        
        $fechas=[
            "ID" => $id_rep,
            "FechaVEN" => $fechaven
        ];

        $datosfecha = reposoModel::consignarReposoModelo($fechas);
        
        if ($datosfecha->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Reposo Consignado",
                "Texto" => "El reposo ha sigo consignado con éxito.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Error en la consignación del reposo.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

}
