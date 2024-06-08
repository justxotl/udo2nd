<?php

ob_start();
include ('../config/aplicacion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte PDF</title>
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/style.css">
</head>
<body>

<div class="head">
    <div class="logopdf">
        <img class="pdflogo" src="<?php echo SERVERURL ?>view/img/logo2.jpeg" alt="">
    </div>
    <div class="textopdf">
    <h5>Universidad de Oriente - Venezuela</h5>
    <h5>Núcleo Bolívar</h5>
    <h5>Detalles de Reposo</h5>
    </div> 
</div>

<?php 
        
        $peticionAjax = false;
		require_once "../controllers/pdfControl.php";
		$ins_pdf = new pdfControl();


		$datos_pdf=$ins_pdf->mostrarPdfControl($_GET['id']);

	if($datos_pdf->rowCount()==1){

		$campos= $datos_pdf->fetch();
?>

    <table class="table table-striped table-bordered container">
        <thead>
            <tr>
                <th>Cód. Reposo:</th>
                <th>Nombres:</th>
                <th>Apellidos:</th>
            </tr>
        </thead>

    <tbody>
        <tr>
            <td><?php echo $campos['id_rep']?></td>
                <td><?php echo $campos['nombre_pers']?></td>
                <td><?php echo $campos['apellido_pers']?></td>
        </tr>
    </tbody>
</table>

<table class="table table-striped table-bordered container">
    <thead>
            <tr>
                <th>Cédula:</th>
                <th>Teléfono:</th>
                <th>Duración de Reposo:</th>
            </tr>
    </thead>

    <tbody>
        <tr>
                <td><?php echo $campos['cedula_pers']?></td>
                <td><?php echo $campos['tlf_pers']?></td>
                <td><?php echo $campos['duracion']?> días</td>
        </tr>
    </tbody>
</table>

<table class="table table-striped table-bordered container patpdf">
    <thead>
            <tr>
                <th>Patología:</th>
            </tr>
    </thead>

    <tbody>
        <tr>
                <td><?php echo $campos['patologia']?></td>
        </tr>
    </tbody>
</table>

<table class="table table-striped table-bordered container">
        <thead>
            <tr>
                <th>Nombres del Médico:</th>
                <th>Apellidos del Médico:</th>
                <th>Cédula del Médico</th>
            </tr>
        </thead>

    <tbody>
        <tr>
                <td><?php echo $campos['nom_med']?></td>
                <td><?php echo $campos['ape_med']?></td>
                <td><?php echo $campos['ced_med']?></td>
        </tr>
    </tbody>
</table>

<table class="table table-striped table-bordered container">
        <thead>
            <tr>
                <th>Fecha de Consignación:</th>
                <th>Fecha de Vencimiento:</th>
            </tr>
        </thead>

    <tbody>
        <tr>
                <td><?php echo  date("d-m-Y", strtotime($campos['fecha_cert']))?></td>
                <td><?php echo  date("d-m-Y", strtotime($campos['fecha_ven']))?></td>
        </tr>
    </tbody>
</table>

<?php } ?>

</body>
</html>

<?php

    $html=ob_get_clean();

    require_once '../reporte/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);

    $dompdf->setPaper('letter');

    $dompdf->render();

    $dompdf->stream("reporte_reposo.pdf", array("Attachment"=>false));

?>