<?php 
$pagina = explode("/", $_GET['alvarez']);
?>

<div class="tope containerd-fluid ">
    <div class="container justify-content-start">
                    <div class="text-center">
                        <h2>Restablecer Contraseña</h2>
                    </div>
        <div class="row justify-content-center">
            <div class="col-6 form-recu">

                <form action=""  method="POST">
                
                <input type="hidden" name="name-usu-newpass" value="<?php echo $pagina[1]?>">

                <div class="form-group">
                    <label for="reset-pass" text-center>Contraseña:</label>
                    <input type="password" class="form-control" autocomplete="off" name="reset-pass" placeholder="Escriba su nueva contraseña." autocomplete="off" required>
                </div>

                
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Restablecer</button>
                    </div>
                

                </form>

            </div>
        </div>   
    </div>    
</div>

<?php
    if(isset($_POST['reset-pass']) && isset($_POST['name-usu-newpass'])){
        require_once "./controllers/loginControl.php";

        $ins_pass= new loginControl();
        
        echo $ins_pass -> controlResetearClave();
    }
?>