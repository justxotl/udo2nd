<div  id="sidebar">

  <div id="sidebar-accordion" class="accordion">
    <div class="list-group">

      <a href="<?php echo SERVERURL ?>dashboard/" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action text-light">
        Inicio
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
      <a href="" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action text-light btnCerrar_sesion">
          Cerrar sesion
        </a>


    </div>
  </div>
</div>