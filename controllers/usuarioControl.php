<?php

if ($peticionAjax) {
    require_once "../models/usuarioModel.php";
} else {
    require_once "./models/usuarioModel.php";
}


class usuarioControl extends usuarioModel
{
    //Controlador para agregar usuarios 
    public function agregarUsuarioControlador()
    {
        $usuario = $_POST['username'];
        $pass_u = $_POST['pass_u'];
        $confirm_pass_u = $_POST['confirm_pass_u'];

        $nivel = $_POST['nivel'];

        //Comprobar los campos vacios del formulario
        if ($usuario == "" || $pass_u == "" || $confirm_pass_u == "" || $nivel == "") {
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

        if (modeloPrincipal::verificarDatos("[a-zA-Z0-9]{3,35}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "El Nombre de Usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (modeloPrincipal::verificarDatos("[a-zA-Z0-9$@.\-]{7,100}", $pass_u) || modeloPrincipal::verificarDatos("[a-zA-Z0-9$@.\-]{7,100}", $confirm_pass_u)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "Las Contraseñas no coinciden con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Comprovando la existencia de un usuario

        $check_user = modeloPrincipal::ejecutarConsultaSimple("SELECT usuario FROM user WHERE usuario='$usuario'");
        if ($check_user->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "El Usuario que ha ingresado ya se encuentra registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        // comprobando las contraseñas
        if ($pass_u != $confirm_pass_u) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "Las contraseñas no coinciden",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $pass = hash("sha256",$confirm_pass_u);
        }

        //Comprovando privilegios

        if ($nivel < 1 || $nivel > 2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "Como te las arreglaste para tener tantos privilegios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $Inf_reg_usu = [
            "Usuario" => $usuario,
            "Clave" => $pass,
            "Nivel" => $nivel
        ];

        $agg_usu = usuarioModel::modelAgregarUsers($Inf_reg_usu);
        if ($agg_usu->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "Los datos usuario han sido registrado con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ocurrio un error inesperado",
                "Texto" => "Error en el registro de los datos del Usuario",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/* Fin de del controlador */

    //Controlador para mostrar usuarios en una tabla
    public function tablaUsuarioControlador()
    {

        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM user ORDER BY usuario DESC";

        $conexion = modeloPrincipal::conexion();

        $datos = $conexion->query($consulta);

        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()");

        $total = (int) $total->fetchColumn();

        $tabla = '
        <table class="table container">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Cargo</th>
                <th>Eliminar</th>
                <th>Actualizar</th>
            </tr>
        </thead>
        <tbody>
        ';
        if ($total >= 1) {
            foreach ($datos as $rows) {
                $tabla .= '
                <tr>
                <td>' . $rows['id'] . '</td>
                <td>' . $rows['usuario'] . '</td>
                <td>' . $rows['nivel'] . '</td>
                <td>
                <form class="  FormularioAjax" action="'.SERVERURL.'ajax/ajaxUsuario.php" method="POST" data-form"delete">
                
                <input type="hidden" name="borrar_id_usuario" value="'.$rows['id'].'">
                
                <button type="submit" class="btn btn-danger">
                        Borrar
                    </button>
                </form>

                </td>
                <td><a href="'.SERVERURL.'usuario-up/'.$rows['id'].'/" class="btn btn-success btn-sm">Actualizar</a></td>
            </tr>';
            }
        } else {
            $tabla .= '<tr> <td colspan="9">No hay resgistros en el sistema</td> </tr>';
        }

        $tabla .= '
        </tbody>
        </table>
        ';
        return $tabla;
    }/* Fin de del controlador */

    //Controlador para eliminar un usuario
    public function borrarUsuarioControl()
    {
        //recibiendo el id del usurio
        $id= $_POST['borrar_id_usuario'];

        // comprobando si el usuario existe en la base de datos

        //   <=(menor o igual)   >=(mayor o igual)   => (flechita)
        
        $revisarUsuario=modeloPrincipal::ejecutarConsultaSimple("SELECT id FROM user WHERE id='$id'");
        if($revisarUsuario->rowCount()<=0){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"ERROR",
                "Texto"=>" Ahora te sientas y me explicas con método científico cómo hiciste esa vaina.",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $borrarUsuario= usuarioModel::borrarUsuarioModel($id);
        
        if($borrarUsuario-> rowCount()==1){
            $alerta=[
                "Alerta"=>"recargar",
                "Titulo"=>"Usuario Eliminado",
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

    public function actualizarUsuarioControl()
    {
            //Recibiendo id
            $id = $_POST['id_usuario_up'];

            //Comprobar el usuario en la BD
            $comprobarUsu = modeloPrincipal::ejecutarConsultaSimple("SELECT * FROM user WHERE id='$id' ");

            if ($comprobarUsu->rowCount() <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "ERROR",
                    "Texto" => "No hemos encontrado el usuario en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $campos = $comprobarUsu->fetch();
            }
            

        $claveF = $_POST['pass_u_up'];
        $confirm_clave = $_POST['confirm_pass_u_up'];

        /*--> comprobar campos vacios <--*/

        if ($claveF == "" || $confirm_clave == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Por favor rellene el Formulario en su totalidad",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*--> Verificando integridad de los datos <--*/
        if (modeloPrincipal::verificarDatos("[a-zA-Z0-9$@.\-]{7,100}", $claveF) || modeloPrincipal::verificarDatos("[a-zA-Z0-9$@.\-]{7,100}", $confirm_clave)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "las Claves no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*--> Comprobando si claves las claves coinciden <--*/
        if ($claveF != $confirm_clave) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Las claves no coiciden",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $clave = hash("sha256",$claveF);
        }


        $datoUsuarioUP = [
            "Clave" => $clave,
            "ID" => $id
        ];

        if (usuarioModel::actualizarUsuarioModel($datoUsuarioUP)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos actualizados",
                "Texto" => "Los Datos han sido actualizados",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Los datos no se han podido actualizar",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*--> Fin de del controlador <--*/

}
