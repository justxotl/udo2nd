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
        $nombres_usu= $_POST['nombres_usu'];
        $apellidos_usu = $_POST['apellidos_usu'];
        $cedula_usu = $_POST['cedula_usu'];
        $tlf_usu = $_POST['tlf_usu'];
        $usuario = $_POST['username'];
        $pass_u = $_POST['pass_u'];
        $confirm_pass_u = $_POST['confirm_pass_u'];
        $nivel = $_POST['nivel'];

        //Comprobar los campos vacios del formulario
        if ($nombres_usu == "" || $apellidos_usu == "" || $cedula_usu == "" || $tlf_usu == "" || $usuario == "" || $pass_u == "" || $confirm_pass_u == "" || $nivel == "") {
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
        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,35}", $nombres_usu)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El nombre no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,35}", $apellidos_usu)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El apellido no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (modeloPrincipal::verificarDatos("[0-9\-]{6,8}", $cedula_usu)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El número de cédula no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (modeloPrincipal::verificarDatos("[0-9\-]{11,12}", $tlf_usu)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El número de teléfono no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (modeloPrincipal::verificarDatos("[a-zA-Z0-9]{3,35}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El Nombre de Usuario no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (modeloPrincipal::verificarDatos("[a-zA-Z0-9$@.\-]{7,100}", $pass_u) || modeloPrincipal::verificarDatos("[a-zA-Z0-9$@.\-]{7,100}", $confirm_pass_u)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Las contraseñas no coinciden con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Comprobando la existencia de un usuario

        $check_user = modeloPrincipal::ejecutarConsultaSimple("SELECT usuario FROM user WHERE usuario='$usuario'");
        if ($check_user->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El Usuario que ha ingresado ya se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Comprobando la existencia de un tlf

        $check_tlf = modeloPrincipal::ejecutarConsultaSimple("SELECT tlf_pers FROM info_per WHERE tlf_pers ='$tlf_usu'");
        if ($check_tlf->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El número de teléfono ya se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Comprobando la existencia de cédula

        $check_cedula = modeloPrincipal::ejecutarConsultaSimple("SELECT cedula_pers FROM info_per WHERE cedula_pers ='$cedula_usu'");
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

        // comprobando las contraseñas
        if ($pass_u != $confirm_pass_u) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Las contraseñas no coinciden",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $pass = hash("sha256",$confirm_pass_u);
        }

        //Comprobando privilegios

        if ($nivel < 1 || $nivel > 2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Como te las arreglaste para tener tantos privilegios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $Inf_reg_usu = [
            "Nombre" => $nombres_usu,
            "Apellido" => $apellidos_usu,
            "Cedula" => $cedula_usu,
            "Telefono" => $tlf_usu,
            "Usuario" => $usuario,
            "Clave" => $pass,
            "Nivel" => $nivel
        ];

        $agg_usu = usuarioModel::modelAgregarUsers($Inf_reg_usu);
        if ($agg_usu->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Registro Exitoso",
                "Texto" => "Los datos del usuario han sido registrados con éxito.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Error en el registro de los datos del Usuario",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /* Fin de del controlador */

    //Controlador para mostrar usuarios en una tabla
    public function tablaUsuarioControlador()
    {

        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM user, info_per WHERE id=id_usu ORDER BY nivel, id ASC";

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
                <th>Teléfono</th>
                <th>Nivel</th>
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
                <td>' . $rows['nombre_pers'] . '</td>
                <td>' . $rows['apellido_pers'] . '</td>
                <td>' . $rows['cedula_pers'] . '</td>
                <td>' . $rows['tlf_pers'] . '</td>
                <td>' . $rows['nivel'] . '</td>
                <td class="text-center">
                <form class="  FormularioAjax" action="'.SERVERURL.'ajax/ajaxUsuario.php" method="POST" data-form"delete">
                
                <input type="hidden" name="borrar_id_usuario" value="'.$rows['id'].'">
                
                <button type="submit" class="btn btn-sm btn-danger">
                        Borrar
                    </button>
                </form>

                </td>
                <td class="text-center"><a href="'.SERVERURL.'usuario-up/'.$rows['id'].'/" class="btn btn-success btn-sm">Actualizar</a></td>
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
        //recibiendo el id del usuario
        $id = $_POST['borrar_id_usuario'];

        // comprobando si el usuario existe en la base de datos
        
        $revisarID=modeloPrincipal::ejecutarConsultaSimple("SELECT id FROM user WHERE id='$id'");
        if($revisarID->rowCount()<=0){
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

    // Controlador datos usuario
    public static function mostrarDatosControlador($id)
    {        
        $id= $id;
        return usuarioModel::mostrarDatosModelo($id);
    
    }/* Fin de del controlador */


    public function actualizarUsuarioControl()
    {
            //Recibiendo id
            $id = $_POST['id_usuario_up'];

            //Comprobar el usuario en la BD
            $comprobarUsu = modeloPrincipal::ejecutarConsultaSimple("SELECT * FROM user, info_per WHERE id = id_usu AND id='$id' ");

            if ($comprobarUsu->rowCount() <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "ERROR",
                    "Texto" => "No hemos encontrado el usuario en el sistema.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $campos = $comprobarUsu->fetch();
            }

        $claveF = $_POST['pass_u_up'];
        $confirm_clave = $_POST['confirm_pass_u_up'];
        $nombre = $_POST['nombre_up'];
        $apellido = $_POST['apellido_up'];
        $telefono = $_POST['telefono_up'];

        /*--> comprobar campos vacios <--*/

        if ($nombre == ""|| $apellido == ""|| $telefono == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "Por favor rellene el formulario en su totalidad",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*--> Verificando integridad de los datos <--*/
        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,35}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El nombre no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,35}", $apellido)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "ERROR",
                "Texto" => "El apellido no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }    
        
        if($_POST['pass_u_up']!="" || $_POST['confirm_pass_u_up']!=""){
            if($_POST['pass_u_up']!=$_POST['confirm_pass_u_up']){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"ERROR",
                    "Texto"=>"Las claves otorgadas no coinciden.",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                if(mainModel::verificar_datos("[a-zA-Z0-9$@.\-]{8,100}",$_POST['pass_u_up']) || mainModel::verificar_datos("[a-zA-Z0-9$@.\-]{8,100}",$_POST['confirm_pass_u_up']) ){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"ERROR",
                        "Texto"=>"Las claves otorgadas no se ajustan al formato permitido.",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $clave = hash("sha256",$claveF);
            }
        }else{
            $claveF=$campos['pass_u'];
        }
        
        if($_POST['telefono_up']==$campos['tlf_pers']){

            $telefono=$campos['tlf_pers'];

        }else{

            $chequeo_tlf = modeloPrincipal::ejecutarConsultaSimple("SELECT tlf_pers FROM info_per WHERE tlf_pers ='$telefono'");
            if ($chequeo_tlf->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "ERROR",
                    "Texto" => "El número de teléfono ya se encuentra registrado en el sistema.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if (modeloPrincipal::verificarDatos("[0-9\-]{11,12}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "ERROR",
                    "Texto" => "El número de teléfono no coincide con el formato solicitado.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

        }

        $datoUsuarioUP = [
            "Clave" => $claveF,
            "ID" => $id,
            "Nombres" => $nombre,
            "Apellidos" => $apellido,
            "Telefono" => $telefono
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
