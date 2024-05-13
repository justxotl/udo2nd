<?php
$peticionAjax = true;
require_once "../config/aplicacion.php";

if (isset($_POST['username']) || isset($_POST['borrar_id_usuario']) || isset($_POST['id_usuario_up']) || isset($_POST['id_usuario_pregunta']) ) {

    // Instancia al controlador 
    require_once "../controllers/usuarioControl.php";
    $ins_usuario = new usuarioControl();

    // Agregar usuario
    if (isset($_POST['username']) && isset($_POST['pass_u'])) {
        echo $ins_usuario->agregarUsuarioControlador();
    }
     //Actualizar usuario
    if (isset($_POST['id_usuario_up'])) {
        echo $ins_usuario->actualizarUsuarioControl();
    }

   // Eliminar usuario
    if (isset($_POST['borrar_id_usuario'])) {
    echo $ins_usuario->borrarUsuarioControl();
    }

    // Agregar preguntas de recuperación
    if (isset($_POST['id_usuario_pregunta'])) {
    echo $ins_usuario->actualizarPreguntasControl();
    }
    

} else {
    session_start(['name' => 'UDO']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
}
