<div class="login-box">
    <div class="login-logo">
        <img src="views/img/plantilla/Logo-Miselanea.png" class="img-responsive" style="padding:30px 100px 0px 100px" alt="Logo Principal">
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Inicia Sesión</p>

        <form method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Usuario" name="ingusuario" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Contraseña" name="ingpassword" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </div>
            </div>
            
           <!--  Inicio de codigo php -->
            <?php
            $login = new ControladorUsuarios();
            $login -> ctrIngresoUsuario();
            ?>
        </form>
    </div>
</div>