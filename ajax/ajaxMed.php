<?php
$peticionAjax = true;
require_once "../config/aplicacion.php";

if (isset($_POST['cedula_doc']) || isset($_POST['borrar_id_med'])) {

    //Instancia al controlador
    require_once "../controllers/medControl.php";
    $ins_med = new medControl();

    if (isset($_POST['nombres_doc']) && isset($_POST['apellidos_doc']) && isset($_POST['cedula_doc'])) {
        echo $ins_med->agregarMedControl();
    }

    // Eliminar médico
    if (isset($_POST['borrar_id_med'])) {
        echo $ins_med->borrarMedControl();
    }

} else {     
    session_start(['name' => 'UDO']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
}