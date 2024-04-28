<?php
$peticionAjax = true;
require_once "../config/aplicacion.php";

if (isset($_POST['nombres_doc']) && isset($_POST['cedula_doc']) ) {

    // Instancia al controlador     
    require_once "../controllers/docControl.php";
    $ins_doc = new docControl();

    // Agregar usuario
    if (isset($_POST['nombres_doc']) && isset($_POST['cedula_doc'])) {
        echo $ins_doc->agregarDocControl();
    }

} else {
    session_start(['name' => 'UDO']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
}
