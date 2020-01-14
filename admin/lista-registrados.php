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
      Listado de Personas Registradas
      <small></small>
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Maneja los visitantes registrados</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="registros" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha</th>
                  <th>Articulos</th>
                  <th>Talleres</th>
                  <th>Regalo</th>
                  <th>Compra</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                try {
                  $sql = "SELECT registrados.*,regalos.nombre_regalo FROM registrados";
                  $sql.= " JOIN regalos";
                  $sql.= " ON registrados.regalo=regalos.id_regalo";
                  $resultado = $conn->query($sql);
                } catch (Exception $e) {
                  echo "Error: ".$e->getMessage();
                }



                while($registrados = $resultado->fetch_assoc()):?>
                  <tr>
                    <td>
                      <?php 
                      echo $registrados['nombre_registrado'].' '.$registrados['apellido_registrado'];
                      echo ($registrados['pagado'])?'<span class="badge bg-green">Pagado</span>':'<span class="badge bg-red">No Pagado</span>';
                      ?>
                    </td>
                    <td><?php echo $registrados['email_registrado'];?></td>
                    <td><?php echo $registrados['fecha_registro'];?></td>
                    <td>
                      <?php  
                      $articulos = json_decode($registrados['pases_articulos'],true);

                      $arreglo_articulos = array(
                        'un_dia'=>'Pase 1 dia',
                        'pase_2dias'=>'Pase 2 dias',
                        'pase_completo'=>'Pase Completo',
                        'camisas'=>'Camisas',
                        'etiquetas'=>'Etiquetas'
                      );

                      

                      foreach ($articulos as $llave => $articulo) {

                        // si hay una cantidad 
                        if(isset($articulo['cantidad']) && $articulo['cantidad']>0){
                          echo $articulo['cantidad'].' '.$arreglo_articulos[$llave].'<br>';
                        }
                      }
                      ?>

                    </td>
                    <td>
                      <?php 
                      $talleres = json_decode($registrados['talleres_registrados'],true);

                      $talleres = implode("', '",$talleres['eventos']);
                      $sql_talleres = "SELECT nombre_evento,fecha_evento,hora_evento FROM eventos WHERE id_evento IN ('$talleres');";
                      $resultado_talleres = $conn->query($sql_talleres);
                      while( $eventos = $resultado_talleres->fetch_assoc()){
                        echo $eventos['nombre_evento'].' '.$eventos['fecha_evento'].' '.$eventos['hora_evento'].'<br>';
                      }
                      ?>  
                    </td>
                    <td><?php echo $registrados['nombre_regalo'];?></td>
                    <td>$ <?php echo (float)  $registrados['total_pagado'];?></td>
                    <td>
                      <a href="editar-registrados.php?id=<?php echo $registrados['id_registrado'];?>" class="btn bg-orange btn-flat margin">
                        <i class="fa fa-pencil"></i>
                      </a>

                      <a href="#" data-id="<?php echo $registrados['id_registrado'];?>" data-tipo="registrados" class="btn bg-maroon btn-flat margin borrar_registro">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha</th>
                  <th>Articulos</th>
                  <th>Talleres</th>
                  <th>Regalo</th>
                  <th>Compra</th>
                  <th>Acciones</th>
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


