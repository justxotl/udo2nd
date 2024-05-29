
<div class="mt-2" id="registrot" style="padding-top: 20px;">
    <h2 class="text-center m-3">Registro de Reposos</h2>
    <form class="registro_rep mt-2 FormularioAjax" action="<?php echo SERVERURL?>ajax/ajaxReposo.php" method="POST" data-form="save">
        
    <input type="hidden" name="id_usuario_rep_reg" value="<?php echo $_SESSION['id_UDO']?>" >

            <div class="mb-3">
                <label for="duracion" class="form-label">Duración del Reposo:</label>
                <input type="num" class="form-control" id="duracion" name="duracion" placeholder="Duración en días" required>
            </div>
            <div class="mb-3">
                <label for="patologia" class="form-label">Patología:</label>
                <textarea class="form-control" id="patologia" name="patologia" required></textarea>
            </div>

            <div class="mb-3">
            <label for="nombres_doc">Nombres del Médico:</label>
        <input type="text" class="form-control" name="nombres_doc" required>
        </div>
        <div class="mb-3">
            <label for="apellidos_doc">Apellidos del Médico:</label>
            <input type="text" class="form-control" name="apellidos_doc" required>
        </div>
            <center>
                <button type="submit" class="btn btn-primary">Enviar Registro</button>
            </center>
    </form>

</div>

