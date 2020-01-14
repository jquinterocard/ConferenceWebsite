<?php
require_once 'funciones/sesiones.php';
require_once 'funciones/validar_admin.php';
require_once 'templates/header.php';
require_once 'funciones/funciones.php';

$id = isset($_GET['id'])?$_GET['id']:false;
if(!$id || !filter_var($id,FILTER_VALIDATE_INT)){
    die('Error!');
}

require_once 'templates/barra.php';
require_once 'templates/navegacion.php';
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Administrador
      <small>puedes editar los datos del administrador aqui</small>
    </h1>

  </section>

  <div class="row">
    <div class="col-md-8">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Editar Administrador</h3>


          </div>
          <div class="box-body">

            <?php 

                $sql = "SELECT id_admin,usuario,nombre,nivel FROM admins WHERE id_admin=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('i',$id);
                $stmt->execute();
                $stmt->bind_result($id_admin,$usuario,$nombre,$nivel);
                $stmt->fetch();
             ?>

        

            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-admin.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="usuario">Usuario:</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario;?>"  placeholder="Usuario">
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre:</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>"  placeholder="Nombre Completo">
                </div>
                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="password" name="password"  placeholder="Password para iniciar Sesion">
                </div>

                <div class="form-group">
                  <label for="nivel">Nivel:</label>
                  <select name="nivel" id="nivel">
                     <option value="0" <?php echo ($nivel==0)?'selected':'';?>>0</option>
                     <option value="1" <?php echo ($nivel==1)?'selected':'';?>>1</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="registro" value="actualizar">
                <input type="hidden" name="id_registro" value="<?php echo $id_admin ?>">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    
  </div>
</div>
<!-- /.content-wrapper -->


<?php include_once 'templates/footer.php'; ?>
