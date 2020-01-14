<?php
require_once 'funciones/sesiones.php';
require_once 'templates/header.php';
require_once 'funciones/funciones.php'; 
require_once 'templates/barra.php';
require_once 'templates/navegacion.php';
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Evento
      <small>LLena el formulario para crear un evento</small>
    </h1>

  </section>

  <div class="row">
    <div class="col-md-8">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Crear Evento</h3>


          </div>
          <div class="box-body">
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-evento.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre_evento">Nombre Evento:</label>
                  <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="Nombre Evento">
                </div>

                <div class="form-group">
                  <label for="categoria_evento">Categoria Evento:</label>
                  <select name="categoria_evento" id="categoria_evento" class="form-control seleccionar">
                    <option value="0" selected>--Seleccione--</option>
                    <?php 
                    try {
                      $sql = "SELECT id_categoria,cat_evento FROM categoria_evento";
                      $resultado = $conn->query($sql);
                      while($cat_evento=$resultado->fetch_assoc()){?>
                        <option value="<?php echo $cat_evento['id_categoria'];?>"><?php echo $cat_evento['cat_evento'];?></option>
                      <?php }
                    } catch (Exception $e) {
                      echo "Error: ".$e->getMessage();
                    }
                    ?> 
                  </select>
                </div>

                <div class="form-group">
                  <label for="fecha_evento">Fecha Evento:</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="fecha_evento" name="fecha_evento">
                  </div>
                  <!-- /.input group -->
                </div>
                
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label for="hora_evento">Hora Evento:</label>

                    <div class="input-group">
                      <input type="text" class="form-control timepicker" id="hora_evento" name="hora_evento">

                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                
                <div class="form-group">
                  <label for="invitado_evento">Invitado o Ponente:</label>
                  <select name="invitado_evento" id="invitado_evento" class="form-control seleccionar">
                    <option value="0" selected>--Seleccione--</option>
                    <?php 
                    try {
                      $sql = "SELECT id_invitado,nombre_invitado,apellido_invitado FROM invitados";
                      $resultado = $conn->query($sql);
                      while($invitado=$resultado->fetch_assoc()){?>
                        <option value="<?php echo $invitado['id_invitado'];?>"><?php echo $invitado['nombre_invitado'].' '.$invitado['apellido_invitado'];?></option>
                      <?php }
                    } catch (Exception $e) {
                      echo "Error: ".$e->getMessage();
                    }
                    ?> 
                  </select>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-primary">Añadir</button>
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


