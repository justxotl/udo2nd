<?php

if ($_SESSION['nivel_UDO'] != 1) {
	echo $lc->forzar_cierre_sesion_control();
	exit();
}

?>



<div class="container mt-5">
    <h2>Actualización de Usuario</h2>
    <form method="POST" data-form="update" class="registro FormularioAjax" action="<?php echo SERVERURL ?>ajax/ajaxUsuario.php">
       <input type="hidden" name="id_usuario_up" value="<?php echo $pagina[1]?>">
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" name="pass_u_up" id="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Repetir Contraseña:</label>
            <input type="password" class="form-control" name="confirm_pass_u_up" id="confirm_password" required>
        </div>
        
        <br>
        <button type="submit" class="btn btn-primary" name="submit">Actualizar</button>
    </form>
</div>

