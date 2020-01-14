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
      Editar Categorias de Eventos
      <small>LLena el formulario para editar la categoria</small>
    </h1>

  </section>

  <div class="row">
    <div class="col-md-8">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Editar Categoria</h3>


          </div>
          <div class="box-body">

            <?php 

            $sql = "SELECT id_categoria,cat_evento,icono FROM categoria_evento WHERE id_categoria=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $stmt->bind_result($id_categoria,$nombre_categoria,$icono_categoria);
            $stmt->fetch();
            $stmt->close();
            ?>

            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-categoria.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre_categoria">Nombre:</label>
                  <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Categoria" value="<?php echo $nombre_categoria; ?>">
                </div>

                <!-- icon picker -->
                <div class="form-group">
                  <label for="icono">Icono:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-address-book"></i>
                    </div>
                    <input type="text" id="icono" name="icono" class="form-control pull-right" placeholder="fa-icon" value="<?php echo $icono_categoria;?>">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="registro" value="actualizar">
                <input type="hidden" name="id_registro" value="<?php echo $id_categoria; ?>">
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
