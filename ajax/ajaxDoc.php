<?php
$peticionAjax = true;
require_once "../config/aplicacion.php";

if (isset($_POST['nombres_doc']) || isset($_POST['cedula_doc']) || isset($_POST['borrar_reg_doc']) ) {

    // Instancia al controlador     
    require_once "../controllers/docControl.php";
    $ins_doc = new docControl();

    // Agregar tratante
    if (isset($_POST['nombres_doc']) && isset($_POST['cedula_doc'])) {
        echo $ins_doc->agregarDocControl();
    }

    // Eliminar tratante
    if (isset($_POST['borrar_reg_doc'])) {
        echo $ins_doc->borrarDocControl();
        }

} else {
    session_start(['name' => 'UDO']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
}
