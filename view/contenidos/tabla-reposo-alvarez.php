<?php
if ($_SESSION['nivel_UDO'] != 1) {
    echo $lc->controlForzarCierreSesion();
    exit();
}
?>

<h3 class="text-center mt-2">Tabla de Reposos</h3>
<div class="tabla-premium">
<?php

require_once "./controllers/reposoControl.php";
$insReposo = new reposoControl();

echo $insReposo->tablaReposoControl();

?>
</div>