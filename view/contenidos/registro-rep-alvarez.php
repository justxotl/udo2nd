
<div class="mt-2" id="registrot" style="padding-top: 20px;">
    <h2 class="text-center m-3">Registro de Reposos</h2>
    <form class="registro_rep mt-2 FormularioAjax" action="<?php echo SERVERURL?>ajax/ajaxReposo.php" method="POST" data-form="save">

    <?php 
    
    if(!empty($pagina[1])){?>
        
        <input type="hidden" name="tipo_de_cuenta" value="impropio">
        
        <input type="hidden" name="id_usuario_rep_reg" value="<?php echo $pagina[1]?>">

    <?php }else{ ?>
        
        <input type="hidden" name="id_usuario_rep_reg" value="<?php echo $_SESSION['id_UDO']?>">

        <input type="hidden" name="tipo_de_cuenta" value="propio">
        
    <?php }?>

            <div class="mb-3">
                <label for="inicio" class="form-label">Fecha de Inicio:</label>
                <input type="date" class="form-control" id="inicio" name="inicio" min="1900-01-01" max="9999-12-31" required>
            </div>

            <div class="mb-3">
                <label for="duracion" class="form-label">Duración del Reposo:</label>
                <input type="num" class="form-control" id="duracion" name="duracion" placeholder="Duración en días" required>
            </div>

            <div class="mb-3">
                <label for="patologia" class="form-label">Patología:</label>
                <textarea class="form-control" id="patologia" name="patologia" required></textarea>
            </div>
            
            <div class="mb-3 select-wrap">
            <label for="">Médico:</label>
                <select name="medico" class="form-control" id="selectbox" required>
                <option value="" disabled="" selected="">Seleccione un médico tratante.</option>
                <?php 
                
                require_once "./controllers/medControl.php";
                
                $ins_med = new medControl();
                $datos_med=$ins_med->medSelectControl();

                $campos= $datos_med->fetchAll();

                foreach($campos as $values){

                    echo '<option value="'.$values["id_med"].'">'.$values["nom_med"].' '.$values["ape_med"].' ('.$values["ced_med"].')</option>';
                    
                }


                ?>
                </select>
            </div>

            
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Enviar Registro</button>
                </div>
            
    </form>

</div>

