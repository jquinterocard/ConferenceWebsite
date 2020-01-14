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
      Crear Registro de Usuario Manual
      <small>LLena el formulario para crear un usuario registrado</small>
    </h1>

  </section>

  <div class="row">
    <div class="col-md-8">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Crear Usuario</h3>


          </div>
          <div class="box-body">
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-registrados.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre">Nombre:</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                </div>

                <div class="form-group">
                  <label for="apellido">Apellido:</label>
                  <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                </div>

                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                  <div id="error"></div>
                </div>

                <div class="form-group">
                  <div id="paquetes" class="paquetes">

                    <div class="box-header with-border">
                      <h3 class="box-title">Elige el numero de boletos</h3>
                    </div>
                    <ul class="lista-precios clearfix row">
                      <li class="col-md-4">
                        <div class="tabla-precio text-center">
                          <h3>Pase por día (Viernes)</h3>
                          <p class="numero">$30</p>
                          <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                          </ul>
                          <div class="orden">
                            <label for="pase_dia">Boletos deseados</label>
                            <input type="number" min="0" id="pase_dia" size="3" name="boletos[un_dia][cantidad]" placeholder="0" class="form-control">
                            <input type="hidden" value="30" name="boletos[un_dia][precio]">
                          </div>
                        </div>
                      </li>
                      <li class="col-md-4">
                        <div class="tabla-precio text-center">
                          <h3>Todos los días</h3>
                          <p class="numero">$50</p>
                          <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                          </ul>
                          <div class="orden">
                            <label for="pase_completo">Boletos deseados</label>
                            <input type="number" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0" class="form-control">
                            <input type="hidden" value="50" name="boletos[completo][precio]">
                          </div>
                        </div>
                      </li>
                      <li class="col-md-4">
                        <div class="tabla-precio text-center">
                          <h3>Pase por 2 días (Viernes y Sábado)</h3>
                          <p class="numero">$45</p>
                          <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                          </ul>
                          <div class="orden">
                            <label for="pase_dosdias">Boletos deseados</label>
                            <input type="number" min="0" id="pase_dosdias" size="3" name="boletos[dos_dias][cantidad]" placeholder="0" class="form-control">
                            <input type="hidden" value="45" name="boletos[dos_dias][precio]">
                          </div>
                        </div>
                      </li>
                    </ul><!-- .precios -->
                  </div><!-- #paquetes -->
                </div>

                <div class="form-group">
                  <div class="box-header with-border">
                    <h3 class="box-title">Elige los talleres</h3>
                    <div id="eventos" class="eventos clearfix">

                     <div class="caja">
                      <?php 

                      try {

                        $sql = "SELECT eventos.*,categoria_evento.cat_evento,invitados.nombre_invitado,invitados.apellido_invitado";
                        $sql.=" FROM eventos";
                        $sql.=" JOIN categoria_evento";
                        $sql.=" ON eventos.id_categoria=categoria_evento.id_categoria";
                        $sql.=" JOIN invitados";
                        $sql.=" ON eventos.id_invitado=invitados.id_invitado";
                        $sql.=" ORDER BY eventos.fecha_evento,eventos.id_categoria,eventos.hora_evento";
                        $resultado = $conn->query($sql);
                      } catch (Exception $e) {
                        echo $e->getMessage();
                      }

                      $eventos_dias = array();      
                      while( $eventos = $resultado->fetch_assoc()){
                       $fecha = $eventos['fecha_evento'];
                       setlocale(LC_TIME, 'spanish');
                       $dia_semana = utf8_encode(strftime('%A',strtotime($fecha)));
                       $categoria = $eventos['cat_evento'];
                       $dia = array(
                        'nombre_evento'=>$eventos['nombre_evento'],
                        'hora'=>$eventos['hora_evento'],
                        'id'=>$eventos['id_evento'],
                        'nombre_invitado'=>$eventos['nombre_invitado'],
                        'apellido_invitado'=>$eventos['apellido_invitado']
                      );
                       $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
                     }


                     ?>

                     <?php foreach($eventos_dias as $dia => $eventos): ?>
                       <div id="<?php echo str_replace('á','a',$dia); ?>" class="contenido-dia clearfix row">
                         <h4 class="text-center nombre-dia"><?php echo $dia; ?></h4>

                         <?php foreach ($eventos['eventos'] as $tipo => $evento_dia):?>
                           <div class="col-md-4">
                            <p><?php echo $tipo;?>:</p>
                            <?php foreach ($evento_dia as $evento):?>
                              <label>
                                <input type="checkbox" class="flat-blue" name="registro_eventos[]" id="<?php echo $evento['id'];?>" value="<?php echo $evento['id'];?>">
                                <time><?php echo $evento['hora'];?></time> <?php echo $evento['nombre_evento'];?>
                                <br>
                                <span class="autor"><?php echo $evento['nombre_invitado'].' '.$evento['apellido_invitado'];?></span>
                              </label>
                            <?php endforeach; ?>
                          </div>
                        <?php endforeach; ?>
                      </div> <!--#contenido dia-->

                    <?php endforeach; ?>


                  </div><!--.caja-->
                </div> <!--#eventos-->

                <div id="resumen" class="resumen">
                 <div class="box-header with-border">
                  <h3 class="box-title">Pagos y Extras</h3>
                </div>
                <br>
                <div class="caja clearfix row">
                 <div class="extras col-md-6">
                   <div class="orden">
                     <label for="camisa_evento">Camisa del evento $10 <small>(promocion 7% dto.)</small> </label>
                     <input type="number" class="form-control" min="0" id="camisa_evento" name="pedido_extra[camisas][cantidad]" size="3" placeholder="0">
                     <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                   </div><!-- .orden -->
                   <div class="orden">
                     <label for="etiqueta">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                     <input type="number" class="form-control" min="0" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" size="3" placeholder="0">
                     <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
                   </div><!-- .orden -->
                   <div class="orden">
                     <label for="regalo">Seleccione un regalo</label><br>
                     <select name="regalo" id="regalo" required class="form-control seleccionar">
                       <option value="">Seleccione un regalo</option>
                       <option value="2">Etiquetas</option>
                       <option value="1">Pulseras</option>
                       <option value="3">Plumas</option>
                     </select>
                   </div><!-- .orden -->
                   <br>
                   <input type="button" id="calcular" class="btn btn-success" value="calcular">
                 </div> <!-- .extras -->
                 <div class="total col-md-6">
                   <p>Resumen:</p>
                   <div id="lista-productos">

                   </div>
                   <p>Total:</p>
                   <div id="suma-total">

                   </div>
                   <input type="hidden" name="total_pedido" id="total_pedido">
                 </div> <!-- .total -->
               </div><!-- .caja -->
             </div><!-- #resumen -->

           </div>
         </div>
       </div>
       <!-- /.box-body -->
       <div class="box-footer">
        <input type="hidden" name="registro" value="nuevo">
        <button type="submit" class="btn btn-primary" id="btnRegistro">Añadir</button>
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


