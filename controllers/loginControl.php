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
}
