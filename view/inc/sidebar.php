<div  id="sidebar">
  <div id="sidebar-accordion" class="accordion">
    <div class="list-group">

    <div>
      <a href="<?php echo SERVERURL ?>perfil/" class="list-group-item list-group-item-action text-light"><i class="fa fa-user mr-3"></i>Perfil
        </a>
        
        <a class="list-group-item list-group-item-action text-light" data-bs-toggle="collapse" href="#collapseRegistro" role="button" aria-expanded="false" aria-controls="collapseRegistro"><i class="fa fa-file-pen mr-3"></i>Registrar
        </a>

        <div class="collapse" id="collapseRegistro">
          <a href="<?php echo SERVERURL ?>registro-rep/" class="list-group-item list-group-item-action text-light">
            Reposo
          </a>
          
          <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
            <a href="<?php echo SERVERURL ?>usuario/" class="list-group-item list-group-item-action text-light">
              Usuario
            </a>
          <?php } ?>
          
          <a href="<?php echo SERVERURL ?>registro-medico/" class="list-group-item list-group-item-action text-light">
            Médico
          </a>
        </div>

        <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
          <a class="list-group-item list-group-item-action text-light" data-bs-toggle="collapse" href="#collapseTablas" role="button" aria-expanded="false" aria-controls="collapseTablas"><i class="fa fa-table-list mr-3"></i>Tabulaciones
        </a>
        <?php } ?>
      
        <div class="collapse" id="collapseTablas">
          <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
            <a href="<?php echo SERVERURL ?>tabla-reposo/" class="list-group-item list-group-item-action text-light">
              Tabla de Reposos
            </a>
          <?php } ?>
          
          <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
            <a href="<?php echo SERVERURL ?>usuario-crud/" class="list-group-item list-group-item-action text-light">
              Tabla de Usuarios
            </a>
          <?php } ?>
          
          <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
            <a href="<?php echo SERVERURL ?>tabla-doc/" class="list-group-item list-group-item-action text-light">
              Tabla de Médicos
            </a>
          <?php } ?>
        </div>
      
        <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
          <a href="<?php echo SERVERURL ?>respaldos/" class="list-group-item list-group-item-action text-light"><i class="fa fa-database mr-3"></i>Respaldo y Restauración</a>
        <?php } ?>

        <a href="<?php echo SERVERURL ?>manual/manual_de_usuario.pdf" target="_blank" class="list-group-item list-group-item-action text-light"><i class="fa fa-book-open-reader mr-3"></i>Manual de Uso</a>
      
        <a href="" class="list-group-item list-group-item-action text-light btnCerrar_sesion"><i class="fa fa-door-open mr-3"></i>Cerrar Sesión
          </a>
    </div>

    </div>
  </div>
</div>