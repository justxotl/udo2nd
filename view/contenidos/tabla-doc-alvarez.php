<?php
if ($_SESSION['nivel_UDO'] != 1) {
    echo $lc->controlForzarCierreSesion();
    exit();
}
?>

<div class="tabla-premium">
<?php

require_once "./controllers/docControl.php";
$insDocTab = new docControl();

echo $insDocTab->tablaDocControl();

?>
</div>