<?php
if ($_SESSION['nivel_UDO'] != 1) {
    echo $lc->controlForzarCierreSesion();
    exit();
}
?>

<div class="tabla-premium">
<?php

require_once "./controllers/reposoControl.php";
$insRegistroIndv = new reposoControl();

echo $insRegistroIndv->tablaRepososIndv($pagina[1]);

?>
</div>