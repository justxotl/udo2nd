<div class="containerd-fluid">
        <div class="justify-content-center ingreso">
            <h3 class="titulo-login text-center">Aplicación Web para Registro de Reposos</h3>
            <br>
            <br>
            <div class="mt-4">
                <form class="login" method="post" action="">
                    <div class="form-group">
                        <label for="username">Usuario:</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" name="password_lg" required>
                    </div>
                    <button type="submit" id="btlogin" class="btn btn-primary btn-block">Iniciar sesión</button>
                    <div class="text-center mt-2">
                        <a href="<?php echo SERVERURL ?>check-user/">¿Ha olvidado su contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if(isset($_POST['username'])&& isset($_POST['password_lg'])){
        require_once "./controllers/loginControl.php";

        $ins_login= new loginControl();
        
        echo $ins_login -> controlIniciarSesion();
    }
?>


