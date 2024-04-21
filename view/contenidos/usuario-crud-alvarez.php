<?php

require_once "./controllers/usuarioControl.php";
$insUsuarioTab = new usuarioControl();

echo $insUsuarioTab->tablaUsuarioControlador();

?>