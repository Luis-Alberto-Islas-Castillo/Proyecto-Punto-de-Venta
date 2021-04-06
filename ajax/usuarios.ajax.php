<?php

/* requiriendo nuevamente los archivos  */
require_once"../controllers/usuarios.controlador.php";
require_once"../models/usuarios.modelo.php";

class AjaxUsuarios{
    /* Editar Usuarios */

    public $idUsuario;
	public function ajaxEditarUsuario(){

		$item = "id";
		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
		echo json_encode($respuesta);
	}

	/* Evitar Repetir usuario */
	public $validarUsuario;

	public function ajaxValidarUsuario(){
		$item = "usuario";
		$valor = $this->validarUsuario;
		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
		echo json_encode($respuesta);

	}
}

/* Editar Usuarios */
if(isset($_POST["idUsuario"])){
	$editar = new AjaxUsuarios();
	$editar -> idUsuario = $_POST["idUsuario"];
	$editar -> ajaxEditarUsuario();

}

/* Objeto para Evitar repetir usuario*/
if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}