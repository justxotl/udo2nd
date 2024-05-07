<div class=" div-registro" id="registrot" style="padding-top: 50px;">
    <h2 class=" text-center">Registro de Médico</h2>
    <form method="POST" data-form="save" class="registro FormularioAjax" id="formuregistro" action="<?php echo SERVERURL ?>ajax/ajaxDoc.php">
    
        <div class="form-group">
            <label for="nombres_doc">Nombres:</label>
            <input type="text" class="form-control" name="nombres_doc" required>
        </div>
        <div class="form-group">
            <label for="apellidos_usu">Apellidos:</label>
            <input type="text" class="form-control" name="apellidos_doc" required>
        </div>
        <div class="form-group">
            <label for="cedula_usu">Cédula:</label>
            <input type="text" class="form-control" name="cedula_doc" required>
        </div>
        <br>
        <center>
        <button type="submit" class="btn btn-primary" name="submit">Registrar</button>
        <a href="<?php echo SERVERURL?>tabla-doc" class="btn btn-success">CRUD</a>
        </center>
    </form>
</div>