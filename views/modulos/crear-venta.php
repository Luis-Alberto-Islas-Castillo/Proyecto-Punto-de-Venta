<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard
      <small>Crear Venta</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Crear Venta</li>
    </ol>

  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!--  Formulario -->
      <div class="col-lg-5 col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border"></div>
          <form role="form" method="post" class="formularioVenta">
            <div class="box-body">
              <div class="box">
                <!-- Entrada Vendedor -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor"
                      value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                      <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                  </div>
                </div>
                <!--  Entrada Vendedor -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                      <?php
                        $item = null;
                        $valor = null;
                        
                        $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                        if(!$ventas){
                          echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10" readonly>';
                        }else{
                          foreach($ventas as $key => $value) {

                          }
                          $codigo = $value["codigo"] + 1;
                          echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                        }
                      ?>
                  </div>
                </div>
                <!--  Entrada del Cliente -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                      <option value="">Seleccionar Cliente</option>
                      <?php
                        $item = null;
                        $valor = null;

                        $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);
                        foreach($categorias as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        }
                      ?>
                    </select>
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs"
                        data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar
                        Cliente</button></span>
                  </div>
                </div>
                <!-- Entrada para agregar producto -->
                <div class="form-group row nuevoProducto">
                  
                </div>

              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Guardar Venta</button>
            </div>
          </form>
          </div>
        </div>
        <!--  Tabla de Productos -->
        <div class="col-lg-7 hidden-md hidden-sm hiddem-xs">
          <div class="box box-warning">
            <div class="box-header with-border">
              <div class="box-body">
                <table class="table table-bordered table-spriped dt-responsive tablaVentas">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Imagen</th>
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Stock</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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
</div>