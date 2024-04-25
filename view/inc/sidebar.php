<div id="sidebar">
  <div class="p-3 justify-content-md-end">
    <button type="button" class="btn btn-danger btn-lg btnCerrar_sesion">Cerrar Sesión</button>
  </div>
  <div id="sidebar-accordion" class="accordion">
    <div class="list-group">
      <a href="<?php echo SERVERURL ?>dashboard/" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-dark text-light">
        Dashboard
      </a>
      <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
        <a href="<?php echo SERVERURL ?>usuario/" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-dark text-light">
          Administrar Usuario
        </a>
      <?php } ?>
      <a href="<?php echo SERVERURL ?>registro-rep/" class="list-group-item list-group-item-action bg-dark text-light">
        Registrar Reposo
      </a>
      <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
        <a href="#setting-items" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-dark text-light">
          Reportes de Reposo
        </a>

        <a href="#setting-items" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-dark text-light">
          Gestionar Reposo
        </a>
      <?php } ?>

    </div> 
  </div>
</div>