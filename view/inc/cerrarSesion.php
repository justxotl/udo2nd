<script>
    let btn_salir=document.querySelector(".btnCerrar_sesion");

    btn_salir.addEventListener('click', function(e){
        e.preventDefault();
        Swal.fire({
			title: '¿Desea salir del sistema?',
			text: "La sesión actual se cerrará y saldrás del sistema.",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				
                let url='<?php echo SERVERURL;?>ajax/ajaxLogin.php';
                let token= '<?php echo $_SESSION['token_UDO']?>';
                let usuario= '<?php echo $_SESSION['usuario_UDO']?>'; 

                let datos = new FormData();
				datos.append("token", token);
				datos.append("usuario", usuario);

				fetch(url, {
					method: 'post',
					body: datos
				})
				.then(respuesta => respuesta.json())
				.then(respuesta => {
					return alertas_ajax(respuesta)
				});
			}
		});
        
    });
</script>