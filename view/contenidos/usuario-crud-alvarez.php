<?php
if ($_SESSION['nivel_UDO'] != 1) {
    echo $lc->controlForzarCierreSesion();
    exit();
}
?>

<?php

require_once "./controllers/usuarioControl.php";
$insUsuarioTab = new usuarioControl();

echo $insUsuarioTab->tablaUsuarioControlador();

?>
