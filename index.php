<?php

/* Controlador requerido para ejecutar un metodo 
   que se va a encontrar en este controlador   */
require_once"controllers/plantilla.controlador.php";
require_once"controllers/categorias.controlador.php";
require_once"controllers/clientes.controlador.php";
require_once"controllers/productos.controlador.php";
require_once"controllers/usuarios.controlador.php";
require_once"controllers/ventas.controlador.php";

/*llamando a los modelos*/
require_once"models/categorias.modelo.php";
require_once"models/clientes.modelo.php";
require_once"models/productos.modelo.php";
require_once"models/usuarios.modelo.php";
require_once"models/ventas.modelo.php";

/*Objeto que va a instanciar una clase que se llama conrolador*/
$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();