<?php
if ($_SESSION['nivel_UDO'] != 1) {
    echo $lc->controlForzarCierreSesion();
    exit();
}
?>

<div class=" div-registro mb-3" id="registrot" style="padding-top: 50px;">
    <h2 class=" text-center">Registro de Usuarios</h2>
    <form method="post" data-form="save" class="registro  FormularioAjax" id="formuregistro" action="<?php echo SERVERURL ?>ajax/ajaxUsuario.php">
    
        <div class="form-group">
            <label for="nombres_usu">Nombres:</label>
            <input type="text" class="form-control" name="nombres_usu" required>
        </div>
        <div class="form-group">
            <label for="apellidos_usu">Apellidos:</label>
            <input type="text" class="form-control" name="apellidos_usu" required>
        </div>
        <div class="form-group">
            <label for="cedula_usu">Cédula:</label>
            <input type="text" class="form-control" name="cedula_usu" required>
        </div>
        <div class="form-group">
            <label for="tlf_usu">Teléfono:</label>
            <input type="text" class="form-control" name="tlf_usu" required>
        </div>
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" name="pass_u" id="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Repetir Contraseña:</label>
            <input type="password" class="form-control" name="confirm_pass_u" id="confirm_password" required>
        </div>
        <div class="form-group">
            <label for="role">Nivel:</label>
            <select class="form-control" name="nivel">
                <option value="2">Usuario</option>
                <option value="1">Administrador</option>
            </select>
        </div>
        <br>
        <center>
        <button type="submit" class="btn btn-primary" name="submit">Registrar Usuario</button>
        </center>    
    </form>
</div>
