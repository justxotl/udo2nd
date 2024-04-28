
<div class="mt-2" id="registrot">
    <h2 class="text-center mb-3">Registro de Reposos</h2>
    <form class="registro_rep mt-2 FormularioAjax" action="<?php echo SERVERURL?>ajax/ajaxReposo.php" method="POST" data-form="save">
            <div class="mb-3">
                <label for="cedula" class="form-label">Número de Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedrep" required>
            </div>
            <div class="mb-3">
                <label for="duracion" class="form-label">Duración del Reposo</label>
                <input type="num" class="form-control" id="duracion" name="duracion" placeholder="Duración en días" required>
            </div>
            <div class="mb-3">
                <label for="patologia" class="form-label">Patología</label>
                <textarea class="form-control" id="patologia" name="patologia" required></textarea>
            </div>
            <div class="mb-3">
                <label for="medicoCedula" class="form-label">Número de Cédula del Médico Tratante</label>
                <input type="text" class="form-control" id="medicoCedula" name="ceddoc" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Registro</button>
    </form>

</div>

