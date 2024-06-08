<?php
		require_once "./controllers/usuarioControl.php";
		$ins_usu = new usuarioControl();

		$datos_usu=$ins_usu->mostrarDatosControlador($_SESSION['id_UDO']);

	if($datos_usu->rowCount()==1){

		$campos= $datos_usu->fetch();

?>

<div class="principal">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <div><h2 class="text-center m-3">Mis Datos</h2></div>

        <form method="" id="" class="registro">

            <div class="row">
                <div class="form-group col-6">
                    <label>Nombres:</label>
                    <input type="text" class="form-control" name="nombre_det"  value ="<?php echo $campos['nombre_pers']?>" disabled>
                </div>

                <div class="form-group col-6">
                    <label>Apellidos:</label>
                    <input type="text" class="form-control" name="apellido_det"  value="<?php echo $campos['apellido_pers']?>" disabled>
                </div>

                <div class="form-group col-4">
                    <label>Usuario:</label>
                    <input type="text" class="form-control" name="usuario_det" value="<?php echo $campos['usuario']?>" disabled>
                </div>
                
                <div class="form-group col-4">
                    <label>Teléfono:</label>
                    <input type="text" class="form-control" name="telefono_det" value="<?php echo $campos['tlf_pers']?>" disabled>
                </div>
                
                <div class="form-group col-4">
                    <label>Cédula:</label>
                    <input type="text" class="form-control" name="cedula-det" value="<?php echo $campos['cedula_pers']?>" disabled>
                </div>
            </div>
        </form>
    </div>
</div>

    <div class="container mt-2 col-12" style="padding-top: 20px;">

    <div class="col-12">
        <div class="text-center">
            <h2 class="text-center m-3">Preguntas de Recuperación</h2>
        </div>
        
        <form method="POST" data-form="update" class="registro mt-2 FormularioAjax" action="<?php echo SERVERURL ?>ajax/ajaxUsuario.php">
        
            <?php 
                if(($campos['id']==$_SESSION['id_UDO'])){ 
            
            ?>
            
            <div class="row" >
                <input type="hidden" name="id_usuario_pregunta" value="<?php echo $campos['id']?>">
                <div class="form-group col-6">
                    <label for="preguntauno">Pregunta #1:</label>
                    <input type="text" class="form-control" name="preguntauno"  value ="<?php echo $campos['pregunta_uno']?>" required>
                </div>
                <div class="form-group col-6">
                    <label for="respuestauno">Respuesta 1#:</label>
                    <input type="text" class="form-control" name="respuestauno"  value="<?php echo $campos['resp_uno']?>" required>
                </div>
                <div class="form-group col-6">
                    <label for="preguntados">Pregunta #2:</label>
                    <input type="text" class="form-control" name="preguntados" value="<?php echo $campos['pregunta_dos']?>" required>
                </div>
                <div class="form-group col-6">
                    <label for="respuestados">Repuesta #2:</label>
                    <input type="text" class="form-control" name="respuestados" value="<?php echo $campos['resp_dos']?>" required>
                </div>
            </div>    
        
                <div class="text-center justify-content-center">
                    <button type="submit" class="btn btn-primary" name="submit">Registrar Preguntas</button>
                </div>
            
            <?php } ?>
        </form>
    </div>
</div>
<?php }?>
