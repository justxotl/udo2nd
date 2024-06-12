<?php
if ($_SESSION['nivel_UDO'] != 1) {
    echo $lc->controlForzarCierreSesion();
    exit();
}
?>

<h3 class="text-center mt-2">Tabla de Médicos</h3>
<div class="tabla-premium">
<?php

require_once "./controllers/medControl.php";
$insMed = new medControl();

echo $insMed->tablaMedControl();

?>
</div>