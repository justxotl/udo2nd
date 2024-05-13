<div class="tope containerd-fluid ">
    <div class="container justify-content-start">
                    <div class="text-center">
                        <h2>Recuperación de contraseña</h2>
                    </div>
        <div class="row justify-content-center">
            <div class="col-6 form-recu">

                <form action="" method="POST">

                <div class="form-group">
                    <label for="user-recuperar" text-center>Usuario:</label>
                    <input type="text" class="form-control" name="user-recuperar" placeholder="Escriba su nombre de usuario." required>
                </div>
                <button type="submit" class="btn btn-primary">Validar</button>

                </form>

            </div>
        </div>   
    </div>    
</div>

<?php
    if(isset($_POST['user-recuperar'])){
        require_once "./controllers/loginControl.php";

        $ins_check= new loginControl();
        
        echo $ins_check -> controlChequeoUser();
    }
?>
