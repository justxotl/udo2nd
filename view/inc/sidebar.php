<div  id="sidebar">

  <div id="sidebar-accordion" class="accordion">
    <div class="list-group">

    <a href="<?php echo SERVERURL ?>crear-preguntas/<?php echo $_SESSION['id_UDO']?>" class="list-group-item list-group-item-action text-light">
        "Mi Perfil"
      </a>

      <a href="<?php echo SERVERURL ?>registro-rep/" class="list-group-item list-group-item-action text-light">
        Reposo
      </a>
      
      <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
        <a href="<?php echo SERVERURL ?>tabla-reposo/" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action text-light">
          Tabla de Reposos
        </a>
      <?php } ?>

      <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
        <a href="<?php echo SERVERURL ?>usuario/" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action text-light">
          Usuario
        </a>
      <?php } ?>

      <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
        <a href="<?php echo SERVERURL ?>usuario-crud/" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action text-light">
          Tabla de Usuarios
        </a>
      <?php } ?>

      <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
        <a href="<?php echo SERVERURL ?>respaldos/" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action text-light">
          Respaldo y Restauración
        </a>
      <?php } ?>

      <a href="<?php echo SERVERURL ?>registro-medico/" class="list-group-item list-group-item-action text-light">
        Médico
      </a>

      <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
        <a href="<?php echo SERVERURL ?>tabla-doc/" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action text-light">
          Tabla de Médicos
        </a>
      <?php } ?>

      <a href="" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action text-light btnCerrar_sesion">
          Cerrar Sesión
        </a>

    </div>
  </div>
</div>