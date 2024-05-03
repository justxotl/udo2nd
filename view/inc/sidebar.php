<div  id="sidebar">

  <div id="sidebar-accordion" class="accordion">
    <div class="list-group">

      <a href="<?php echo SERVERURL ?>dashboard/" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-dark text-light">
        Inicio
      </a>

      <a href="<?php echo SERVERURL ?>registro-rep/" class="list-group-item list-group-item-action bg-dark text-light">
        Reposo
      </a>

      <a href="<?php echo SERVERURL ?>registro-doc/" class="list-group-item list-group-item-action bg-dark text-light">
        Médico
      </a>

      <?php if ($_SESSION['nivel_UDO'] == 1) { ?>
        <a href="<?php echo SERVERURL ?>usuario/" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-dark text-light">
          Usuario
        </a>
      <?php } ?>

    </div>
  </div>
<center>
    <div class="p-3 justify-content-md">
      <button type="button" class="btn btn-danger btn-lg btnCerrar_sesion">Cerrar Sesión</button>
    </div>
</center>
</div>