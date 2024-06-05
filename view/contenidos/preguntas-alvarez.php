<?php 
$pagina = explode("/", $_GET['alvarez']);

        require_once "./controllers/loginControl.php";
		$ins_q = new loginControl();

		$datos_q=$ins_q->controlRequerirQuestion($pagina[1]);

	if($datos_q->rowCount()==1){

        $campos= $datos_q->fetch();

?>


<div class="tope containerd-fluid">
    <div class="container justify-content-start">
                <div class="text-center">
                    <h2>Preguntas de Recuperación</h2>
                </div>
        <div class="row ">
            <div class="col-12 form-recu">
    
        <form action="" method="POST"  class="">

        <input type="hidden" name="name_usuario_q" value="<?php echo $pagina[1]?>">

            <div class="form-group">
                <label for="preguno">Pregunta #1:</label>
                <input type="text" class="form-control" value ="<?php echo $campos['pregunta_uno']?>" disabled>
            </div>
            
            <div class="form-group">
                <label for="respuno">Respuesta #1:</label>
                <input type="text" class="form-control" name="respuno" required> 
            </div>
            
            <div class="form-group">
                <label for="pregdos">Pregunta #2:</label>
                <input type="text" class="form-control" value ="<?php echo $campos['pregunta_dos']?>" disabled>
            </div>
            
            <div class="form-group">
                <label for="respdos">Respuesta #2:</label>
                <input type="text" class="form-control" name="respdos" required>
            </div>

            
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="submit">Actualizar</button>
                </div>
            
            
        </form>

            </div>
        </div>   
    </div>    
</div>


<?php }?>

<?php
if (isset($_POST['respuno']) && isset($_POST['respdos'])) {

    require_once "./controllers/loginControl.php";

    $ins_check_q= new loginControl();
    
    echo $ins_check_q -> controlChequeoRespuestas();

}