<!-- Nesesario para resolver problemas de compatibilidad con las versiones -->
<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Miscelanea don Carmen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Plugins de CSS -->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- DataTables -->
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="views/plugins/iCheck/all.css">

  <!-- Plugins de Javascript -->

  <!-- jQuery 3 -->
  <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>
  <!-- DataTables -->
  <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <!-- Alertas-->
  <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>
   <!-- Icheck-->
  <script src="views/plugins/iCheck/icheck.min.js"></script>
</head>

<!-- Cuerpo del Documento  -->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

  <!-- llamando al modulo donde se encuentra nuestro codigo HTML -->
  <?php

    /*Verificacion del inicio de Sesion*/
    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok")
    {

    echo '<div class="wrapper">';
      /*llamando a la estructura basica del menu*/
      include "modulos/cabezote.php";
      /*llamando al contenido del menu*/
      include "modulos/menu.php";
      /*llamando al contenido temporal del menu*/
      if(isset($_GET["ruta"])){
        if($_GET["ruta"] == "inicio" ||
           $_GET["ruta"] == "usuarios" ||
           $_GET["ruta"] == "categorias" ||
           $_GET["ruta"] == "productos" ||
           $_GET["ruta"] == "clientes" ||
           $_GET["ruta"] == "venta" ||
           $_GET["ruta"] == "crear-venta" ||
           $_GET["ruta"] == "reportes" ||
           $_GET["ruta"] == "salir"){
          include "modulos/".$_GET["ruta"].".php";
        }else{
          include "modulos/404.php";
        }
      } else{
        include "modulos/inicio.php";
      }
      /*llamando al footer*/
      include "modulos/footer.php";

      echo '</div>';
    }else{
      
      include "modulos/login.php";
    }
    ?>


  <!-- ./wrapper -->
  <script src="views/js/plantilla.js"></script>
  <script src="views/js/usuarios.js"></script>
  <script src="views/js/categorias.js"></script>
  <script src="views/js/productos.js"></script>
  <script src="views/js/clientes.js"></script>
</body>

</html>