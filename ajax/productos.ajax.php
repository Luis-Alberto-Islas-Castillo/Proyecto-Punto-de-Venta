<?php

require_once "../controllers/productos.controlador.php";
require_once "../models/productos.modelo.php";

require_once "../controllers/categorias.controlador.php";
require_once "../models/categorias.modelo.php";

class AjaxProductos{
    /* Generar codigo de producto */
    public $idCategoria;
    
    public function ajaxCrearCodigoProducto(){
        
        $item = "id_categoria";
        $valor = $this->idCategoria;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
        echo json_encode($respuesta);
    }

    /*Editar Producto*/
    public $idProducto;
    public $traerProductos;
    public $nombreProducto;
  
    public function ajaxEditarProducto(){
  
      if($this->traerProductos == "ok"){
  
        $item = null;
        $valor = null;
  
        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
  
        echo json_encode($respuesta);
  
  
      }else if($this->nombreProducto != ""){
  
        $item = "descripcion";
        $valor = $this->nombreProducto;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
        echo json_encode($respuesta);
      }else{
        $item = "id";
        $valor = $this->idProducto;
        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
        echo json_encode($respuesta);
      }
    }  
  }
  

/* Generarar codigo apartir de Id */
if(isset($_POST["idCategoria"])){
    $codigoProducto = new AjaxProductos();
    $codigoProducto -> idCategoria = $_POST["idCategoria"];
    $codigoProducto -> ajaxCrearCodigoProducto();
}
/*Editar Producto*/
if(isset($_POST["idProducto"])){
    $editarProducto = new AjaxProductos();
    $editarProducto -> idProducto = $_POST["idProducto"];
    $editarProducto -> ajaxEditarProducto();
  } 
/*Traer Producto*/
if(isset($_POST["traerProductos"])){
    $traerProductos = new AjaxProductos();
    $traerProductos -> traerProductos = $_POST["traerProductos"];
    $traerProductos -> ajaxEditarProducto();
  }
/* Traer Nombre Producto */
if(isset($_POST["nombreProducto"])){
    $traerProductos = new AjaxProductos();
    $traerProductos -> nombreProducto = $_POST["nombreProducto"];
    $traerProductos -> ajaxEditarProducto();
  
  }