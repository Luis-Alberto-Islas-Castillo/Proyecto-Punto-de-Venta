<?php

class ControladorUsuarios{
    /*Ingreso de usuario*/
    static public function ctrIngresoUsuario(){

        /*Validando dados con una expresion regular*/
        if(isset($_POST["ingusuario"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingusuario"])&&
               preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingpassword"])){

                /* Encapsulamiento de la variable password */
                $encriptar = crypt($_POST["ingpassword"], '$2a$07$usesomesillystringforsalt$');

                $tabla = "usuarios";

                $item = "usuario";
                $valor = $_POST["ingusuario"];

                $repuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
                if($repuesta["usuario"] == $_POST["ingusuario"] && $repuesta["password"] == $encriptar){
                    
                    if($repuesta["estado"] == 1){
                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["id"] = $repuesta["id"];
                        $_SESSION["nombre"] = $repuesta["nombre"];
                        
                        echo '<script>window.location = "inicio";</script>';   
                    }else{
                        echo '<br><div class="alert alert-danger">El usuario aun no esta activado</div>';
                    }
                }else{
                    echo '<br><div class="alert alert-danger">Usuario no Encontrado</div>';
                }
            }

        }
    }
   /*  Registrar usuario */
   static public function ctrCrearUsuario(){
    if(isset($_POST["nuevoUsuario"])){
        /* Expresion regular que permitira tildes */
        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
           preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
           preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

                /* Validar Imagen */
                $ruta = "";

                if(isset($_FILES["nuevaFoto"]["tmp_name"])){
                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /* Crear directorio para guardar la imagen */

                    $directorio = "views/img/usuarios/".$_POST["nuevoUsuario"];
                    mkdir($directorio, 0755);

                    /* Tipo de Imagen JPG */
                    if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){
                        /* Guardar imagen en el directorio */
                        $aleatorio = mt_rand(100,999);
                        $ruta = "views/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);

                    }
                    /* Tipo de Imagen PNG */
                    if($_FILES["nuevaFoto"]["type"] == "image/png"){
                        /* Guardar imagen en el directorio */
                        $aleatorio = mt_rand(100,999);
                        $ruta = "views/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);

                    }

                }

                $tabla = "usuarios";

                /* Encriptar Contraseña */ 
                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$usesomesillystringforsalt$');

                $datos = array("nombre" => $_POST["nuevoNombre"], 
                               "usuario" => $_POST["nuevoUsuario"],
                               "password" => $encriptar,
                               "perfil" => $_POST["nuevoPerfil"],
                               "foto" =>$ruta);
                
                $repuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

                if($repuesta == "ok"){
                    echo '<script>
                        swal({
                            type: "success",
                            title: "El usuario se ha guardado correctamente ",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result) => {
                            if (result.value) {
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                }

            /* Inicio de Alerta Suave */
            }else{
                echo '<script>
                    swal({
                        type: "error",
                        title: "El usuario no puede llevar caracteres especiales ",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then((result) => {
                        if (result.value) {
                            window.location = "usuarios";
                        }
                    });
                </script>';
            }
    }
   }

   /* Mostrar Usuario */

   static public function ctrMostrarUsuarios($item, $valor){
    $tabla = "usuarios";
    $repuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

    return $repuesta;
   }

    /* Editar Usuario */
    static public function ctrEditarUsuario(){
        if(isset($_POST["editarUsuario"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){    
               /*  Validar Imagen */
               $ruta = $_POST["fotoActual"];
				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
					$nuevoAncho = 500;
                    $nuevoAlto = 500;
                    
                    /* Crear directorio para guardar la imagen */
                    $directorio = "views/img/usuarios/".$_POST["nuevoUsuario"];

                    /* Primero preguntamos si existe otra imagen */
					if(!empty($_POST["fotoActual"])){
						unlink($_POST["fotoActual"]);
					}else{
						mkdir($directorio, 0755);
					}	

					/* Validacion de Imagenes JPG */
					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

                        /* Guardar Imagenes en el Directorio */
						$aleatorio = mt_rand(100,999);
						$ruta = "views/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

                      /* Guardar Imagen en el Directorio */
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuarios";
				if($_POST["editarPassword"] != ""){
					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
						$encriptar = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');
					}else{
						echo'<script>
                                swal({
                                    type: "error",
                                    title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then(function (result) {
                                    if (result.value) {
                                        window.location = "usuarios";
                                    }
                                })
                        </script>';
					}
				}else{
					$encriptar = $_POST["passwordActual"];
				}
                /* Enviando datos al Modelo */
				$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){
					echo'<script>
                        swal({
                            type: "success",
                            title: "El usuario ha sido editado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function (result) {
                            if (result.value) {
                                window.location = "usuarios";
                            }
                        })
                    </script>';
                }
			    }else{
				echo'<script>
                    swal({
                        type: "error",
                        title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function (result) {
                        if (result.value) {
                            window.location = "usuarios";
                        }
                    })
                </script>';
			}
		}
    }
    
    /* Borrar Usuario */
    static public function ctrBorrarUsuario(){
        if(isset($_GET["idUsuario"])){
            $tabla ="usuarios";
            $datos = $_GET["idUsuario"];

            if($_GET["fotoUsuario"] != ""){
                unlink($_GET["fotoUsuario"]);
                rmdir('views/img/usuarios/'.$_GET["usuario"]);
            }
            $repuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            if($respuesta == "ok"){
				echo'<script>
				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {
								window.location = "usuarios";
								}
							})
				</script>';
			}
        }
    } 
}