<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard
      <small>Administrar Usuarios</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Usuarios</li>
    </ol>

  </section>
  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Usuario</button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <!-- <th style="width:10px">#</th> -->
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php

          $item = null;
          $valor = null;
          
          $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
          foreach ($usuarios as $key => $value){
            echo ' <tr>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["usuario"].'</td>';

                  if($value["foto"] != ""){
                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                  }else{
                    echo '<td><img src="views/img/usuarios/default/usuario.svg" class="img-thumbnail" width="40px"
                    alt="Foto de Usuario"></td>';
                  }
                  echo '<td>'.$value["perfil"].'</td>';
                  if($value["estado"] != 0){
                    echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';
                  }else{
                    echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';
                  }
                  echo '<td>
                  <div class="btn-group">  
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>
                    </div>  
                  </td>';

          } 
          ?>

          </tbody>

        </table>
      </div>
    </div>
  </section>
</div>

<!-- Ventana Modal -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data">
        <!-- Inicio de Modal -->
        <div class="modal-header" style="background:#111010; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Usuario</h4>
        </div>
        <!-- Cuerpo del Modal -->
        <div class="modal-body">
          <div class="box-body">

            <!-- Datos para el Nombre-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre"
                  required>
              </div>
            </div>

            <!-- Datos para el Usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar Usuario"
                  id="nuevoUsuario"  required>
              </div>
            </div>

            <!-- Datos para la Contraseña -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="password" class="form-control input-lg" name="nuevoPassword"
                  placeholder="Ingresar Contraseña" required>
              </div>
            </div>

            <!-- Datos para seleccionar el perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoPerfil" id="">
                  <option value="">Seleccionar Perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Encargado">Encargado</option>
                  <option value="Trabajador">Trabajador</option>
                </select>
              </div>
            </div>

            <!-- Subir Fotos -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso Maximo 2MB</p>
              <img src="views/img/usuarios/default/usuario.svg" class="img-thumbnail previsualizar" width="100px"
                alt="Foto por Defecto">
            </div>
          </div>
        </div>

        <!-- Pie de pagina del modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>

        <?php
        /*  Medoto para guardar usuario */
        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrCrearUsuario();
        ?>

      </form>

    </div>

  </div>
</div>

<!-- Ventana Editar Modal -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data">
        <!-- Inicio de Modal -->
        <div class="modal-header" style="background:#111010; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario</h4>
        </div>
        <!-- Cuerpo del Modal -->
        <div class="modal-body">
          <div class="box-body">

            <!-- Editar Datos para el Nombre-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value=""
                  required>
              </div>
            </div>

            <!-- Datos para el Usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value=""
                  readonly>
              </div>
            </div>

            <!-- Datos para la Contraseña -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña"
                  value="Ingresar Contraseña">
                <input type="hidden" id="passwordActual" name="passwordActual">
              </div>
            </div>

            <!-- Datos para seleccionar el perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarPerfil">
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Encargado">Encargado</option>
                  <option value="Trabajador">Trabajador</option>
                </select>
              </div>
            </div>

            <!-- Subir Fotos -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="editarFoto">
              <p class="help-block">Peso Maximo 2MB</p>
              <img src="views/img/usuarios/default/usuario.svg" class="img-thumbnail previsualizar" width="100px"
                alt="Foto por Defecto">
              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>
          </div>
        </div>

        <!-- Pie de pagina del modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Datos</button>
        </div>

        <?php
            $editarUsuario = new ControladorUsuarios();
            $editarUsuario -> ctrEditarUsuario();
        ?>
      </form>
    </div>
  </div>
</div>

        <?php
            $borrarUsuario = new ControladorUsuarios();
            $borrarUsuario -> ctrBorrarUsuario();
        ?>