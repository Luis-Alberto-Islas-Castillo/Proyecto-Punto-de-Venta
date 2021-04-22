/* Subir foto de usuario */

$(".nuevaFoto").change(function(){

    var imagen = this.files[0];
    
    /* validar formato de la imagen */
    if(imagen["type"] !="image/jpeg" && imagen["type"] != "image/png"){
        
        $(".nuevaFoto").val("");
        swal({
            title: "Error al subir imagen", 
            text: "¡La imagen debe estar en formarto JPG o PNG",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 2000000){

        $(".nuevaFoto").val("");
        swal({
            title: "Error al subir imagen", 
            text: "¡La imagen no debe de pesar mas de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });
    }else{
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);
        })

    }
})

/* Editar usuario */

$(document).on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);
			$("#fotoActual").val(respuesta["foto"]);

			$("#passwordActual").val(respuesta["password"]);

			if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}

		}

	});

})

/* Evitar Usuario Repetido */
$("#nuevoUsuario").change(function(){
	$(".alert").remove();
	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	if(respuesta){
	    		$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe Selecciona uno nuevo</div>');
	    		$("#nuevoUsuario").val("");
	    	}
	    }
	})
})

/* Eliminar Usuarios */
$(document).on("click", ".btnEliminarUsuario", function(){
	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");
  
	swal({
	  title: '¿Está seguro de borrar el usuario?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar usuario!'
	}).then(function(result){
	  if(result.value){
		window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
	  }
	})
  })