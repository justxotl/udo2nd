<?php
$peticionAjax = true;
require_once "../config/aplicacion.php";

if (isset($_POST['cedrep']) || isset($_POST['borrar_reg_rep']) ) {

    // Instancia al controlador     
    require_once "../controllers/reposoControl.php";
    $ins_reposo = new reposoControl();

    // Agregar Reposo
    if (isset($_POST['cedrep']) && isset($_POST['ceddoc'])) {
        echo $ins_reposo->agregarReposoControlador();
    }

   // Eliminar Reposo 
    if (isset($_POST['borrar_reg_rep'])) {
    echo $ins_reposo->borrarReposoControl();
    }
    
} else {
    session_start(['name' => 'UDO']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
}
