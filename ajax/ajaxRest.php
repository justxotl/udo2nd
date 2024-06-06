<?php
$peticionAjax = true;
require_once "../config/aplicacion.php";

if (isset($_POST['respaldo']) || isset($_POST['restaurar'])) {

    //Instancia al controlador
    require_once "../controllers/restControl.php";
    $ins_rest = new restControl();

    if(isset($_POST['respaldo'])){
        echo $ins_rest->respaldarBaseControl();
    }

    if(isset($_POST['restaurar'])){
        echo $ins_rest->restaurarBaseControl();
    }

} else {     
    session_start(['name' => 'UDO']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
}