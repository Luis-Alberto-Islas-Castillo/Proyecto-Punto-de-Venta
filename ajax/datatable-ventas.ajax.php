<?php

require_once "../controllers/productos.controlador.php";
require_once "../models/productos.modelo.php";


class TablaProductosVentas{
 	/*Mostrar Tabla Productos*/ 
	public function mostrarTablaProductosVentas(){

		$item = null;
    	$valor = null;

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor);	
  		if(count($productos) == 0){
  			echo '{"data": []}';
		  	return;
  		}
  		$datosJson = '{
		  "data": [';
		  for($i = 0; $i < count($productos); $i++){

		  	/*Traer Imagen*/
		  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";
		  	/*Stock*/
  			if($productos[$i]["stock"] <= 10){
  				$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
  			}else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){
  				$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
  			}else{
  				$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
  			}
		  	/*Traer Acciones*/
		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$productos[$i]["codigo"].'",
			      "'.$productos[$i]["descripcion"].'",
			      "'.$stock.'",
			      "'.$botones.'"
			    ],';
		  }
		  $datosJson = substr($datosJson, 0, -1);
		  $datosJson .=   '] 
		 }';
		echo $datosJson;
	}
}

/*Activar Tabla Productos*/
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();