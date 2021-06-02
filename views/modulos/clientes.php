<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard
      <small>Administrar Clientes</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Clientes</li>
    </ol>

  </section>
  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">Agregar
          Cliente</button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php

              $item = null;
              $valor = null;

              $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
              foreach ($clientes as $key => $value) {
                echo ' <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>
                      <div class="btn-group">  
                        <button class="btn btn-warning btnEditarCliente" idCliente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCliente"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>
                      </div>  
                    </td>
                  </tr>';
              }
            ?>
          </tbody>

        </table>
      </div>
    </div>
  </section>
</div>

<!-- Ventana Modal Agregar Cliente -->
<div id="modalAgregarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data" autocomplete="off">
        <!-- Inicio de Modal -->
        <div class="modal-header" style="background:#111010; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Cliente</h4>
        </div>
        <!-- Cuerpo del Modal -->
        <div class="modal-body">
          <div class="box-body">

            <!-- Datos para el Nombre-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar Cliente"
                  required>
              </div>
            </div>

          </div>
        </div>

        <!-- Pie de pagina del modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Cliente</button>
        </div>

        <?php
           $crearCliente = new ControladorClientes();
           $crearCliente -> ctrCrearCliente();
        ?>
      </form>
    </div>
  </div>
</div>

<!-- Modal Editar -->
<div id="modalEditarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data" autocomplete="off">
        <!-- Inicio de Modal -->
        <div class="modal-header" style="background:#111010; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Cliente</h4>
        </div>
        <!-- Cuerpo del Modal -->
        <div class="modal-body">
          <div class="box-body">

            <!-- Datos para el Nombre-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>
                <input type="hidden" name="idCliente" id="idCliente" required>
              </div>
            </div>

          </div>
        </div>

        <!-- Pie de pagina del modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>

      </form>
      <?php
           $editarCliente = new ControladorClientes();
           $editarCliente -> ctrEditarCliente();
        ?>
    </div>
  </div>
</div>
<?php
    $eliminarCliente = new ControladorClientes();
    $eliminarCliente -> ctrEliminarCliente();
?>