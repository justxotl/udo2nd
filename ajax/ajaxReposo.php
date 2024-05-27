<?php
$peticionAjax = true;
require_once "../config/aplicacion.php";
//
if (isset($_POST['id_usuario_rep_reg']) || isset($_POST['borrar_reg_rep']) || isset($_POST['consignar_rep'])) {

    // Instancia al controlador     
    require_once "../controllers/reposoControl.php";
    $ins_reposo = new reposoControl();

    // Agregar Reposo
    if (isset($_POST['id_usuario_rep_reg']) && isset($_POST['patologia'])) {
        echo $ins_reposo->agregarReposoControlador();
    }

   // Eliminar Reposo 
    if (isset($_POST['borrar_reg_rep'])) {
    echo $ins_reposo->borrarReposoControl();
    }

    // Consignar Reposo 
    if (isset($_POST['consignar_rep'])) {
        echo $ins_reposo->consignarReposoControl();
        }
    
} else {
    session_start(['name' => 'UDO']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
}
