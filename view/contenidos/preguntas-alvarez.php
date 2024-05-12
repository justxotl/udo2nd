<?php 
		require_once "./controllers/usuarioControl.php";
		$ins_usu = new usuarioControl();

		$datos_usu=$ins_usu->mostrarDatosControlador($pagina[1]);

	if($datos_usu->rowCount()==1){

		$campos= $datos_usu->fetch();

?>

<div class="container mt-5 row">

    <center><h2>Recuperación de Clave</h2></center>
    
    <form method="POST" data-form="" class="registro FormularioAjax" action="<?php echo SERVERURL ?>ajax/ajaxUsuario.php">
        <input type="hidden" name="id_recuperar" value="<?php echo $pagina[1]?>">
        <div class="form-group">
            <label for="user_rec">Usuario:</label>
            <input type="text" class="form-control" name="nombre_up"  value ="<?php echo $campos['nombre_pers']?>" required>
        </div>
        <div class="form-group">
            <label for="apellidos_up">Apellidos:</label>
            <input type="text" class="form-control" name="apellido_up"  value="<?php echo $campos['apellido_pers']?>" required>
        </div>
        <div class="form-group">
            <label for="tlf_up">Teléfono:</label>
            <input type="text" class="form-control" name="telefono_up" value="<?php echo $campos['tlf_pers']?>" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" name="pass_u_up">
        </div>
        <div class="form-group">
            <label for="confirm_password">Repetir Contraseña:</label>
            <input type="password" class="form-control" name="confirm_pass_u_up">
        </div>
        
        <br>
        <button type="submit" class="btn btn-primary" name="submit">Actualizar</button>
    </form>
</div>
<?php }?>
