<?php
if ($_SESSION['nivel_UDO'] != 1) {
    echo $lc->controlForzarCierreSesion();
    exit();
}
?>

<div class="principal">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <div><h3 class="text-center m-3">Registro de Usuarios</h3></div>

                <form method="post" data-form="save" class="FormularioAjax registrousu" id="formuregistro" action="<?php echo SERVERURL ?>ajax/ajaxUsuario.php">
                <div class="row">
    <div class="form-group col-6">
        <label for="nombres_usu">Nombres:</label>
        <input type="text" class="form-control" name="nombres_usu" required>
    </div>
    <div class="form-group col-6">
        <label for="apellidos_usu">Apellidos:</label>
        <input type="text" class="form-control" name="apellidos_usu" required>
    </div>
    <div class="form-group col-4">
        <label for="cedula_usu">Cédula:</label>
        <input type="text" class="form-control" name="cedula_usu" required>
    </div>
    <div class="form-group col-4">
        <label for="tlf_usu">Teléfono:</label>
        <input type="text" class="form-control" name="tlf_usu" required>
    </div>
    <div class="form-group col-4">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group col-6">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" name="pass_u" id="password" required>
    </div>
    <div class="form-group col-6">
        <label for="confirm_password">Repetir Contraseña:</label>
        <input type="password" class="form-control" name="confirm_pass_u" id="confirm_password" required>
    </div>
    <div class="form-group col-12">
        <label for="role">Nivel:</label>
        <select class="form-control" name="nivel">
            <option value="2">Usuario</option>
            <option value="1">Administrador</option>
        </select>
    </div>
    </div>
    <br>
    <center>
    <button type="submit" class="btn btn-primary" name="submit">Registrar Usuario</button>
    </center>    
</form>
    </div>
</div>