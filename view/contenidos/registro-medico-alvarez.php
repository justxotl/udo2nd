
<div class="mt-2" id="registrot" style="padding-top: 20px;">
    <h2 class="text-center m-3">Registro de Médico</h2>
    <form class="registro_rep mt-2 FormularioAjax" action="<?php echo SERVERURL?>ajax/ajaxMed.php" method="POST" data-form="save">

            <div class="mb-3">
                <label for="nombres_doc">Nombres del Médico:</label>
                <input type="text" class="form-control" name="nombres_doc" required>
            </div>

            <div class="mb-3">
                <label for="apellidos_doc">Apellidos del Médico:</label>
                <input type="text" class="form-control" name="apellidos_doc" required>
            </div>
            
            <div class="mb-3">
                <label for="apellidos_doc">Cédula del Médico:</label>
                <input type="text" class="form-control" name="cedula_doc" required>
            </div>
            
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Registrar Médico</button>
                </div>
            
    </form>

</div>