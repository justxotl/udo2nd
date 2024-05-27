<?php

if ($_SESSION['nivel_UDO'] != 1) {
    echo $lc->controlForzarCierreSesion();
    exit();
}
?>

<?php 
		require_once "./controllers/reposoControl.php";
		$ins_rep = new reposoControl();

		$datos_rep=$ins_rep->mostrarReposoControl($pagina[1]);

	if($datos_rep->rowCount()==1){

		$campos= $datos_rep->fetch();

?>

<div class="principal">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <div><h3 class="text-center m-3">Detalles de Reposo</h3></div>

        <form method="POST" id="pdfdetalles">

            <input type="hidden" name="id_rep_det" value="<?php echo $pagina[1]?>">

            <div class="row">
                <div class="form-group col-6">
                    <label for="nombres_up">Nombres:</label>
                    <input type="text" class="form-control" name="nombre_det"  value ="<?php echo $campos['nombre_pers']?>" disabled>
                </div>

                <div class="form-group col-6">
                    <label for="apellidos_up">Apellidos:</label>
                    <input type="text" class="form-control" name="apellido_det"  value="<?php echo $campos['apellido_pers']?>" disabled>
                </div>
                
                <div class="form-group col-4">
                    <label for="tlf_up">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono_det" value="<?php echo $campos['tlf_pers']?>" disabled>
                </div>
                
                <div class="form-group col-4">
                    <label for="tlf_up">Cédula:</label>
                    <input type="text" class="form-control" name="cedula-det" value="<?php echo $campos['cedula_pers']?>" disabled>
                </div>
            
                <div class="form-group col-4">
                    <label for="tlf_up">Duración:</label>
                    <input type="text" class="form-control" name="duracion-det" value="<?php echo $campos['duracion']?> días" disabled>
                </div>
                
                <div class="form-group col-12">
                    <label for="tlf_up">Patología:</label>
                    <textarea class="form-control" name="patologia-det" form="pdfdetalles" rows="5" disabled><?php echo $campos['patologia']?></textarea>
                </div>

                <div class="form-group col-6">
                    <label for="tlf_up">Nombres Médico:</label>
                    <input type="text" class="form-control" name="nommed-det" value="<?php echo $campos['nombre_med']?>" disabled>
                </div>
                    
                <div class="form-group col-6">
                    <label for="tlf_up">Apellidos Médico:</label>
                    <input type="text" class="form-control" name="apemed-det" value="<?php echo $campos['apellido_med']?>" disabled>
                </div>
                
                <div class="form-group col-6">
                    <label for="tlf_up">Fecha de Consignación:</label>
                    <input type="text" class="form-control" name="fcon-det" value="<?php echo  date("d-m-Y", strtotime($campos['fecha_cert']))?>" disabled>
                </div>
                    
                <div class="form-group col-6">
                    <label for="tlf_up">Fecha de Vencimiento:</label>
                    <input type="text" class="form-control" name="fven-det" value="<?php echo date("d-m-Y", strtotime($campos['fecha_ven']))?>" disabled>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" disabled>Generar PDF</button>
        </form>
    </div>
</div>
<?php }?>
