<?php
$peticionAjax = true;
require_once "../config/aplicacion.php";

if (isset($_POST['token']) && isset($_POST['usuario'])) {

    //Instancia al controlador
    require_once "../controllers/loginControl.php";
    $ins_login = new loginControl();

    echo $ins_login->controlCerrarSesion();
} else {
    session_start(['name' => 'UDO']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
}
