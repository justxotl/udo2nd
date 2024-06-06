
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Respaldo y Restauración de Datos</title>
</head>

<body>

<div><h2 class="text-center m-3">Respaldo y Restauración</h2></div>

	<div class="text-center col-12">

            <form class=" " action="<?php echo SERVERURL?>ajax/ajaxRest.php" method="POST" data-form="default">                
                <button type="submit" class="btn btn-primary col-4" name="respaldo" style="padding: 15px; font-size: 150%; margin: 0px 20px 20px 20px">Realizar copia de seguridad</button>
            </form>

        
        <form class="registro " action="<?php echo SERVERURL?>ajax/ajaxRest.php" method="POST" data-form="">
                <div class="text-center">
                <h3>Selecciona un punto de restauración</h3>
                </div><br>
        
            <div class="selector">
                <select name="restaurar" required>
                    <option value="" disabled="" selected="">Selecciona un punto de restauración</option>
                    <?php
                    $ruta = 'backup/';
                    if (is_dir($ruta)) {
                        if ($aux = opendir($ruta)) {
                            while (($archivo = readdir($aux)) !== false) {
                                if ($archivo != "." && $archivo != "..") {
                                    $nombrearchivo = str_replace(".sql", "", $archivo);
                                    $nombrearchivo = str_replace("-", ":", $nombrearchivo);
                                    $ruta_completa = $ruta . $archivo;
                                    if (is_dir($ruta_completa)) {
                                    } else {
                                        echo '<option value="' . $ruta_completa . '">' . $nombrearchivo . '</option>';
                                    }
                                }
                            }
                            closedir($aux);
                        }
                    } else {
                        echo $ruta . " No es ruta válida";
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-primary" style="margin: 15px;" type="submit" >Restaurar</button>
        </form>
    </div>
</body>

</html>