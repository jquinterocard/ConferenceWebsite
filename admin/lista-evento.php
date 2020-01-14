<?php 

require_once 'funciones/sesiones.php';
require_once 'funciones/funciones.php';
require_once 'templates/header.php';
require_once 'templates/barra.php';
require_once 'templates/navegacion.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Listado de Eventos
      <small>Aqui podras editar o borrar los eventos</small>
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Maneja los eventos en esta seccion</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="registros" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoria</th>
                  <th>Invitado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                try {
                  $sql = "SELECT 
                  e.id_evento,e.nombre_evento,e.fecha_evento,e.hora_evento,c.cat_evento,i.nombre_invitado,i.apellido_invitado 
                  FROM eventos e
                  INNER JOIN categoria_evento c ON e.id_categoria=c.id_categoria
                  INNER JOIN invitados i ON e.id_invitado=i.id_invitado ORDER BY e.id_evento";
                  $resultado = $conn->query($sql);
                } catch (Exception $e) {
                  echo "Error: ".$e->getMessage();
                }

                while($evento = $resultado->fetch_assoc()):?>
                  <tr>
                    <td><?php echo $evento['nombre_evento'];?></td>
                    <td><?php echo $evento['fecha_evento'];?></td>
                    <td><?php echo $evento['hora_evento'];?></td>
                    <td><?php echo $evento['cat_evento'];?></td>
                    <td><?php echo $evento['nombre_invitado'].' '.$evento['apellido_invitado'];?></td>
                    <td>
                      <a href="editar-evento.php?id=<?php echo $evento['id_evento'];?>" class="btn bg-orange btn-flat margin">
                        <i class="fa fa-pencil"></i>
                      </a>

                      <a href="#" data-id="<?php echo $evento['id_evento'];?>" data-tipo="evento" class="btn bg-maroon btn-flat margin borrar_registro">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoria</th>
                  <th>Invitado</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include_once 'templates/footer.php'; ?>


