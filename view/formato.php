<!DOCTYPE html>
<html lang="es" style="min-height: 100%">

<head>
    <meta charset="UTF-8">
    <title>Registro de Reposos <?php echo COMPANY ?></title>
    <link rel="icon" href="<?php echo SERVERURL ?>view/img/logo2.png">
    <?php include "./view/inc/estilos.php"; ?>
    <style>
        #sidebar {
            width: 17%;
            min-height: 100vh;
            background-color: rgb(12, 88, 137);
        }
    </style>

</head>

<body >
        <?php include "./view/inc/cabezera.php" ;?>
        
        <div class="flex">
        <?php
        $peticionAjax = false;
        require_once "./controllers/vistasControl.php";
        $ins_view = new vistasControl(); //Ins_view -> Instancias a las vistas

        $view = $ins_view->control_obtener_view();

        if ($view == "login" || $view == "404" || $view == "preguntas" || $view == "check-user"|| $view == "pass-cambio") {
            require_once "./view/contenidos/" . $view . "-alvarez.php";
        } else {
            session_start(['name' => 'UDO']);
            $pagina = explode("/", $_GET['alvarez']);
            //http://localhost/udo/-> $pagina = "usuario" / "3" 
            require_once "./controllers/loginControl.php";
            $lc = new loginControl();
            if (!isset($_SESSION['token_UDO']) || !isset($_SESSION['usuario_UDO']) || !isset($_SESSION['nivel_UDO']) || !isset($_SESSION['id_UDO'])) {
                echo $lc->controlForzarCierreSesion();
                exit();
            }
            include "./view/inc/sidebar.php";
        ?>

        <div class="content">
            <?php
            include $view;
            ?>
        </div>
        
        <?php
            include "./view/inc/cerrarSesion.php";

        }
        include "./view/inc/script.php";
        ?>

    </div>
</body>

</html>