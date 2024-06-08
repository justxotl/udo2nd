<div class="row flex justify-content-center">
    <!-- Usuarios -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary">
            <div class="card-body d-flex text-white">
                Usuarios
                <i class="fas fa-user fa-2x ml-auto"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between ">
                <a href="<?php echo base_url; ?>Usuarios" class="text-white">Ver detalle</a>
                <span class="text-white"><?php echo $data['usuarios']['total'] ?></span>
            </div>
        </div>
    </div>
    <!-- Productos -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger">
            <div class="card-body d-flex text-white">
                Productos
                <i class="fab fa-product-hunt fa-2x ml-auto"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between ">
                <a href="<?php echo base_url; ?>Productos" class="text-white">Ver detalle</a>
                <span class="text-white"><?php echo $data['productos']['total'] ?></span>
            </div>
        </div>
    </div>
</div>