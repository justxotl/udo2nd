<?php

    require_once "./config/aplicacion.php";
    require_once "./controllers/vistasControl.php";

    $formato = new vistasControl();
    $formato-> control_obtener_formato();

  