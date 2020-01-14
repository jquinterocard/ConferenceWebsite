<?php
require_once 'funciones/sesiones.php';
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
      Editar Invitados
      <small>Edita la informacion del invitado aqui</small>
    </h1>

  </section>

  <div class="row">
    <div class="col-md-8">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Editar Invitado</h3>


          </div>
          <div class="box-body">

            <?php 
            $sql = "SELECT id_invitado,nombre_invitado,apellido_invitado,descripcion,url_imagen FROM invitados WHERE id_invitado=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $stmt->bind_result($id_invitado,$nombre_invitado,$apellido_invitado,$descripcion,$url_imagen);
            $stmt->fetch();
            $stmt->close();
            $conn->close();
            ?>

            <!-- form start -->
            <form role="form" name="guardar-registro-archivo" id="guardar-registro-archivo" method="POST" action="modelo-invitado.php" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre_invitado">Nombre:</label>
                  <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Nombre" value="<?php echo $nombre_invitado ?>">
                </div>                



                <div class="form-group">
                  <label for="apellido_invitado">Apellido:</label>
                  <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Apellido" value="<?php echo $apellido_invitado ?>">
                </div>            

                <div class="form-group">
                  <label for="biografia_invitado">Biografia:</label>
                  <textarea name="biografia_invitado" id="biografia_invitado" rows="8" class="form-control" placeholder="Biografia"><?php echo $descripcion; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="imagen_actual">Imagen Actual</label>
                  <br>
                  <img src="../img/invitados/<?php echo $url_imagen;?>" alt="Imagen invitado" width="200" height="200">
                </div>

                <div class="form-group">
                  <label for="imagen_invitado">Imagen:</label>
                  <input type="file" id="imagen_invitado" name="imagen_invitado" class="form-control">
                  <p class="help-block">Añada la imagen del invitado aqui</p>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="registro" value="actualizar">
                <input type="hidden" name="id_registro" value="<?php echo $id_invitado;?>">
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
