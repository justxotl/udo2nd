<?php
if ($peticionAjax) {
    require_once "../models/loginModel.php";
} else {
    require_once "./models/loginModel.php";
}

class loginControl extends loginModel
{

    //Controlador para Iniciar sesion
    public function controlIniciarSesion()
    {
        $usuario = $_POST['username'];
        $clave = hash("sha256", $_POST['password_lg']);

        //Comprobar los campos vacios del formulario
        if ($usuario == "" || $clave == "") {
            echo '<script>
                Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "No has ingresados todos los datos",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }

        //A1
        if ($usuario == "A" || $clave == "1") {
            echo '<script>
                Swal.fire({
                    title: "A1",
                    text: "Aun no hermano, sigue esperando.",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }

        // verificando si los datos cumplen con el formato
        if (modeloPrincipal::verificarDatos("[a-zA-Z0-9]{3,35}", $usuario)) {
            echo '<script>
                Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "El Usuario no coincide con el formato solicitado",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }

        if (modeloPrincipal::verificarDatos("[a-zA-Z0-9$@.\-]{8,100}", $clave)) {
            echo '<script>
                Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "La clave no coincide con el formato solicitado",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }

        $datos_login = [
            "Usuario" => $usuario,
            "Clave" => $clave
        ];

        $Info_cuenta = loginModel::modeloIniciarSesion($datos_login);


        if ($Info_cuenta->rowCount() == 1) {
            $row = $Info_cuenta->fetch();

            session_start(['name' => 'UDO']);
            $_SESSION['id_UDO'] = $row['id'];
            $_SESSION['usuario_UDO'] = $row['usuario'];
            $_SESSION['nivel_UDO'] = $row['nivel'];
            $_SESSION['token_UDO'] = md5(uniqid(mt_rand(), true));

            return header("Location: " . SERVERURL . "dashboard/");
        } else {
            echo '<script>
                Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "El Usuario o clave son incorrectos, Intente de nuevo",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }
    }/*Fin del controlador */

    //Controlador para forzar cierre de sesion al sistema
    public function controlForzarCierreSesion()
    {
        session_unset();
        session_destroy();
        if (headers_sent()) {
            return "<script> window.location.href='" . SERVERURL . "login/'; </script>";
        } else {
            return header("Location: " . SERVERURL . "login/");
        }
    }/*Fin del controlador */

    //Controlador para  cerrar la sesion al sistema
    public function controlCerrarSesion()
    {
        session_start(['name' => 'UDO']);
        $token = $_POST['token'];
        $usuario = $_POST['usuario'];

        if ($token == $_SESSION['token_UDO'] && $usuario == $_SESSION['usuario_UDO']) {
            session_unset();
            session_destroy();
            $alerta = [
                "Alerta" => "redireccionar",
                "URL" => SERVERURL  ."login/",
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se puedo cerrar la sesión.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*Fin del controlador */

    public function controlChequeoUser(){
        
        $usuario = $_POST['user-recuperar'];

        if (modeloPrincipal::verificarDatos("[a-zA-Z0-9]{3,35}", $usuario)) {
            echo '<script>
                Swal.fire({
                    title: "ERROR",
                    text: "El usuario no coincide con el formato solicitado.",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }

        $check_user = modeloPrincipal::ejecutarConsultaSimple("SELECT usuario FROM user WHERE usuario='$usuario'");
        
        if ($check_user->rowCount() < 1) {
            echo '<script>
                Swal.fire({
                    title: "ERROR",
                    text: "El usuario que ha ingresado no se encuentra registrado en el sistema.",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }else{
            return header("Location: " . SERVERURL . "preguntas/".$usuario);
        }
    }

    public function controlRequerirQuestion($preguntas){
        
        $quest = $preguntas;
        return loginModel::modeloRecibirPreguntas($quest);

    }

    public function controlChequeoRespuestas(){

        $resp1 = $_POST['respuno'];
        $resp2 = $_POST['respdos'];
        $usuario = $_POST['name_usuario_q'];

        /*--> comprobar campos vacios <--*/

        if ($resp1 == "" || $resp2 == "") {
            echo '<script>
                Swal.fire({
                    title: "ERROR",
                    text: "Por favor rellene el formulario en su totalidad.",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }

        if(modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ?]{7,100}",$resp1)){
            echo '<script>
                Swal.fire({
                    title: "ERROR",
                    text: "La primera respuesta no cumple con el formato solicitado.",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }

        if(modeloPrincipal::verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ?]{3,100}",$resp2)){
            echo '<script>
                Swal.fire({
                    title: "ERROR",
                    text: "La segunda respuesta no cumple con el formato solicitado.",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }

        $check_ans=modeloPrincipal::ejecutarConsultaSimple("SELECT * FROM user WHERE usuario='$usuario' AND resp_uno='$resp1' AND resp_dos='$resp2'");

        if ($check_ans->rowCount() < 1) {
            echo '<script>
                Swal.fire({
                    title: "ERROR",
                    text: "Al menos una de las respuestas es incorrecta.",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>';
            exit();
        }else{
            return header("Location: " . SERVERURL . "pass-cambio/".$usuario);
        }

    }

    public function controlResetearClave(){

        $usuario =($_POST['name-usu-newpass']);
        $pass =($_POST['reset-pass']);

        if(modeloPrincipal::verificarDatos("[a-zA-Z0-9]{3,35}",$usuario)){
            echo '<script>
            Swal.fire({
                title: "ERROR",
                text: "El usuario no concuerda con el formato solicitado.",
                type: "error",
                confirmButtonText: "Aceptar"
            });
            </script>';
            exit();

        }
        if(modeloPrincipal::verificarDatos("[a-zA-Z0-9$@.\-]{8,100}",$pass)){
            echo '<script>
            Swal.fire({
                title: "ERROR",
                text: "La contraseña no coincide con el formato solicitado.",
                type: "error",
                confirmButtonText: "Aceptar"
            });
            </script>';
            exit();
        }
        $clave = hash("sha256",$pass);

        $datosclave=[
            "User"=>$usuario,
            "Pass"=>$clave
        ];
        
        $resetear = loginModel::resetearClaveModel($datosclave);

        if($resetear->rowCount()==1){
            echo'<script>
                
            Swal.fire({
                title:"Actualización excitada",
                text: "La actualización ha sido satisfactoria.",
                type: "success",
                confirmButtonText: "Aceptar",
            }).then((result) => {
                if (result.value) {
                    window.location.href ="'.SERVERURL.'login"
                }
            });
            
            
            </script>'; 
        }
    }
}
