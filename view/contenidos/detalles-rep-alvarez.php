<?php

if ($_SESSION['nivel_UDO'] != 1) {
    echo $lc->controlForzarCierreSesion();
    exit();
}
?>

<?php

require_once "./controllers/reposoControl.php";
$ins_rep = new reposoControl();

$datos_rep = $ins_rep->mostrarReposoControl($pagina[1]);

if ($datos_rep->rowCount() == 1) {

    $campos = $datos_rep->fetch();

?>

    <div class="principal">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div>
                        <h3 class="text-center m-3">Detalles de Reposo</h3>
                    </div>

                    <form method="POST" id="pdfdetalles">

                        <input type="hidden" name="id_rep_det" value="<?php echo $pagina[1] ?>">

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nombres_up">Nombres:</label>
                                <input type="text" class="form-control" name="nombre_det" value="<?php echo $campos['nombre_pers'] ?>" disabled>
                            </div>

                            <div class="form-group col-6">
                                <label for="apellidos_up">Apellidos:</label>
                                <input type="text" class="form-control" name="apellido_det" value="<?php echo $campos['apellido_pers'] ?>" disabled>
                            </div>

                            <div class="form-group col-4">
                                <label>Teléfono:</label>
                                <input type="text" class="form-control" name="telefono_det" value="<?php echo $campos['tlf_pers'] ?>" disabled>
                            </div>

                            <div class="form-group col-4">
                                <label>Cédula:</label>
                                <input type="text" class="form-control" name="cedula-det" value="<?php echo $campos['cedula_pers'] ?>" disabled>
                            </div>

                            <div class="form-group col-4">
                                <label>Duración:</label>
                                <input type="text" class="form-control" name="duracion-det" value="<?php echo $campos['duracion'] ?> días" disabled>
                            </div>

                            <div class="form-group col-12">
                                <label>Patología:</label>
                                <textarea class="form-control" name="patologia-det" form="pdfdetalles" rows="5" disabled><?php echo $campos['patologia'] ?></textarea>
                            </div>

                            <div class="form-group col-3">
                                <label>Nombres Médico:</label>
                                <input type="text" class="form-control" name="nommed-det" value="<?php echo $campos['nom_med'] ?>" disabled>
                            </div>

                            <div class="form-group col-3">
                                <label>Apellidos Médico:</label>
                                <input type="text" class="form-control" name="apemed-det" value="<?php echo $campos['ape_med'] ?>" disabled>
                            </div>

                            <div class="form-group col-3">
                                <label>Cédula Médico:</label>
                                <input type="text" class="form-control" name="cedmed-det" value="<?php echo $campos['ced_med'] ?>" disabled>
                            </div>

                            <div class="form-group col-3">
                                <label for="certmed-det">Certificado Médico:</label>
                                <input type="text" class="form-control" name="certmed-det" value="<?php echo $campos['cert_med'] ?>" disabled>
                            </div>

                            <div class="form-group col-4">
                                <label>Fecha de Consignación:</label>
                                <input type="text" class="form-control" name="fcon-det" value="<?php echo  date("d-m-Y", strtotime($campos['fecha_cert'])) ?>" disabled>
                            </div>

                            <div class="form-group col-4">
                                <label>Fecha de Vencimiento:</label>
                                <input type="text" class="form-control" name="fven-det" value="<?php echo date("d-m-Y", strtotime($campos['fecha_ven'])) ?>" disabled>
                            </div>

                            <div class="form-group col-4 justify-content-center">
                                <label>Foto Comprobante:</label><br>
                                <button type="button" class="btn btn-info col-12" title="foto" data-bs-toggle="modal" data-bs-target="#exampleModal">FOTO COMPROBANTE</button>
                            </div>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Foto de Reposo</h5>
                                        </div>

                                        <div class="modal-body d-flex justify-content-center">
                                            <img src="<?php echo SERVERURL?>ajax/image_prueba/<?php echo $campos['foto']?>" style="max-width:90%; max-heigth:90%;" alt="Foto de Reposo">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <a href="<?php echo SERVERURL ?>formatoreporte/reportes.php?id=<?php echo $pagina[1] ?>" class="btn btn-primary col-2" title="pdf" target="_blank">Generar PDF</a>
                    </form>
                </div>
            </div>
        <?php } ?>