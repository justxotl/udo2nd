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
    
    //Controlador para mostrar tratantes en una tabla

    public function tablaDocControl()
    {
        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM doc ORDER BY id_doc ASC";


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
                <td>' . $rows['id_doc'] . '</td>
                <td>' . $rows['nombres_doc'] . '</td>
                <td>' . $rows['apellidos_doc'] . '</td>
                <td>' . $rows['cedula_doc'] . '</td>
                
                <td>
                <form class=" FormularioAjax" action="'.SERVERURL.'ajax/ajaxDoc.php" method="POST" data-form="delete">
                
                <input type="hidden" name="borrar_reg_doc" value="'.$rows['id_doc'].'">
                
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

    //Controlador para eliminar un tratante
    public function borrarDocControl()
    {
        //recibiendo el id del tratante
        $id_doc= $_POST['borrar_reg_doc'];

        // comprobando si el tratante existe en la base de datos
        
        $revisarDoc=modeloPrincipal::ejecutarConsultaSimple("SELECT id_doc FROM doc WHERE id_doc='$id_doc'");
        if($revisarDoc->rowCount()<=0){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"ERROR",
                "Texto"=>" Ahora te sientas y me explicas mediante método científico cómo hiciste esa vaina.",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $borrarDoc= docModel::borrarDocModel($id_doc);
        
        if($borrarDoc-> rowCount()==1){
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