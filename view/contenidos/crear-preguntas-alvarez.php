<?php
		require_once "./controllers/usuarioControl.php";
		$ins_usu = new usuarioControl();

		$datos_usu=$ins_usu->mostrarDatosControlador($pagina[1]);

	if($datos_usu->rowCount()==1){

		$campos= $datos_usu->fetch();

?>

    <div class="container mt-2" style="padding-top: 20px;">

    <center><h2 class="text-center m-3">Preguntas de Recuperación</h2></center>
    
    <form method="POST" data-form="update" class="registro mt-2 FormularioAjax" action="<?php echo SERVERURL ?>ajax/ajaxUsuario.php">
    
        <?php 
            if(($pagina[1]==$_SESSION['id_UDO'])){ 
        
        ?>
        
        <input type="hidden" name="id_usuario_pregunta" value="<?php echo $pagina[1]?>">
        <div class="form-group">
            <label for="preguntauno">Pregunta #1:</label>
            <input type="text" class="form-control" name="preguntauno"  value ="<?php echo $campos['pregunta_uno']?>" required>
        </div>
        <div class="form-group">
            <label for="respuestauno">Respuesta 1#:</label>
            <input type="text" class="form-control" name="respuestauno"  value="<?php echo $campos['resp_uno']?>" required>
        </div>
        <div class="form-group">
            <label for="preguntados">Pregunta #2:</label>
            <input type="text" class="form-control" name="preguntados" value="<?php echo $campos['pregunta_dos']?>" required>
        </div>
        <div class="form-group">
            <label for="respuestados">Repuesta #2:</label>
            <input type="text" class="form-control" name="respuestados" value="<?php echo $campos['resp_dos']?>" required>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary" name="submit">Registrar Preguntas</button>
        </div>
        <?php } ?>
    </form>
</div>
<?php }?>
