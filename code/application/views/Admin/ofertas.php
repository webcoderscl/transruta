<?php if (isset($ofertas_transportista) && $ofertas_transportista != false){ ?>

 <script type="text/javascript">
  datos_tabla = [];
  datos_tabla1 = [];
 	datos_tabla2 = [];
  datos_tabla1 = <?=json_encode($ofertas_transportista)?>;
  datos_tabla2 = <?=json_encode($ofertas_gencarga)?>;
  console.log(datos_tabla1);
  console.log(datos_tabla2);
</script>

 <?php } ?>

 				<div class="row">
                    <div class="col-lg-10">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-users"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Ofertas</h3>
                                <small>Listado de Ofertas Registrados en el Sistema.</small>
                            </div>
                        </div>
                    </div>
                	<div class="col-lg-2">
	                    <script type="text/javascript">
							title_add = '<?php echo $modal_title_add; ?>';
							title_text_add = '<?php echo $modal_title_text_add; ?>';
							title_upd = '<?php echo $modal_title_upd; ?>';
							title_text_upd = '<?php echo $modal_title_text_upd; ?>';
							nameform = 'tablename_cu';
              nameform2 = 'tablenameprf_cu';
						</script>

						<?php
						include 'modal_upper.php';
						include 'account_modal.php';
						include 'modal_lower.php';
						?>

            <?php
              include 'modal2_upper.php';
              include 'perfil_modal.php';
              include 'modal_lower.php';

              $usr = $this->session->userdata('login_type');
              $urisearch = "?".$usr."/ofertas/fetch";
            ?>
			</div>
        </div>

        <div class="row">
	                <div class="col-md-12">
	                    <div class="panel panel-filled">
	                        <div class="panel-body">
	                            <div class="row">
	                                <div class="col-md-3 col-xs-6 text-center">
	                                    <h2 class="no-margins">
	                                        <span class="pe-7s-photo-gallery c-accent"></span> <?= $num_of_transporte ?>
	                                    </h2>
	                                    <span class="c-white">Ofertas Camiones</span> Totales
	                                </div>
	                                <div class="col-md-3 col-xs-6 text-center">
	                                    <h2 class="no-margins">
	                                        <span class="pe-7s-photo-gallery c-accent"></span> <?= $num_of_transporte_mes ?>
	                                    </h2>
	                                    <span class="c-white">Ofertas Camioness</span> Mes
	                                </div>
	                                <div class="col-md-3 col-xs-6 text-center">
	                                    <h2 class="no-margins">
	                                        <span class="pe-7s-photo-gallery c-accent"></span> <?= $num_of_carga ?>
	                                    </h2>
	                                    <span class="c-white">Ofertas Cargas</span> Totales
	                                </div>
	                                <div class="col-md-3 col-xs-6 text-center">
	                                    <h2 class="no-margins">
	                                        <span class="pe-7s-photo-gallery c-accent"></span> <?= $num_of_carga_mes ?>
	                                    </h2>
	                                    <span class="c-white">Ofertas Cargas</span> Mes
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>


              <div class="row">
                  <div class="col-md-12">
                      <div class="panel panel-filled">
                          <div class="panel-body">
          <?= form_open($urisearch); ?>
            <div class="row">
              <?php $meses = array(1 => "Enero",2 => "Febrero",3 => "Marzo",4 => "Abril",5 => "Mayo",6 => "Junio",
                        7 => "Julio",8 => "Agosto",9 => "Septiembre",10 => "Octubre",11 => "Noviembre",12 => "Diciembre");

              ?>
                <div class="col-md-2 col-xs-6 text-center">
                <select class="form-control" name="month" data-parsley-required="true">
                  <option value="-1">Mes Actual</option>
                  <?php
                           foreach($meses as $s => $v):
                              echo '<option value="'.$s.'"';
                                if($month == $s) echo 'selected';
                              echo '>';
                              echo $v;
                              echo '</option>';
                          endforeach;

                    ?>
                </select>
                </div>
                <?php $anios = range(2010,intval(date("Y")));
                //$anios = array(1=> 1 , 2 => 2); ?>
                <div class="col-md-2 col-xs-6 text-center">
                    <select class="form-control" name="year" data-parsley-required="true">
                      <option value="-1">Año Actual</option>
                      <?php
                               foreach($anios as $s => $v):
                                  echo '<option value="'.$s.'"';
                                   if($year == $s) echo 'selected';
                                  echo '>';
                                  echo $v;
                                  echo '</option>';
                              endforeach;

                        ?>
                    </select>
                </div>
                <div class="col-md-3 col-xs-6 text-center">
                      <button type="submit"  class="btn btn-w-md btn-accent" style="width: 100%; background: #f6a821; color: #fff;">
                        <i class="fa fa-search" aria-hidden="true"></i> Buscar
                      </button>
                </div>
              </div>
              </div>
              </div>
              </div>
              </div>
            <?= form_close(); ?>



                <div class="row">
	                <div class="col-md-12">
	                    <div class="panel panel-filled">
	                        <div class="panel-heading">
	                            <div class="panel-tools">
	                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
	                                <a class="panel-close"><i class="fa fa-times"></i></a>
	                            </div>
	                            Tabla de Registros de Ofertas de Transportistas
	                        </div>
	                        <div class="panel-body">
	                            <p style="margin-bottom: 25px;">
            									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            								</p>

                            <div class="table-responsive">
	                                <table id="tableExample3" class="table table-striped table-hover">
	                                    <thead>
	                                    <tr>
	                                    	<th style="width:5%">No.</th>
                                        <th>Empresa</th>
                                        <th>Email</th>
                  											<th>Patente</th>
                                        <th>Fecha Pub.</th>
                                        <th>Reg. Origen</th>
                  											<th>Reg. Destino</th>
                  											<th>Tipo Camión</th>
                  										</tr>
                  										</thead>
                  										<tbody>
                  											<?php
                  												if(isset($ofertas_transportista) && $ofertas_transportista != false){
                  													$cont = 1;
                  													foreach($ofertas_transportista as $s => $v){

                  														$id = $v["idofertatransportista"];
                  														$uriupd = "?".$usr."/cuentas/upd/".$id."/commit";
                  														$uridel = "?".$usr."/cuentas/del/".$id;
                  														echo '<tr>';
                  														echo '<div class="container">';
                  														echo  '<td>'.($cont++).'</td>';
                                              echo  '<td>'.$v["empresa"].'</td>';
                                              echo  '<td>'.$v["email"].'</td>';
                                              echo  '<td>'.$v["patente"].'</td>';
                                              $fpub = $v["fecha_publicacion"];
                  														echo '<td><i class="fa fa-calendar" aria-hidden="true"></i> '.$this->Crud_model->formateaFecha($fpub).'</td>';
                                              echo  '<td>'.$v["nregion_origen"].'</td>';
                                              echo  '<td>'.$v["nregion_destino"].'</td>';
                                              echo  '<td>'.$v["tipo_camion"].'</td>';

                                              echo '</div>';
                  														echo '</tr>';
                  													}
                  												}
                  											?>
                  										</tbody>
                									</table>
                								</div>
	                        </div>
	                    </div>
	                </div>
	            </div>


              <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                                <a class="panel-close"><i class="fa fa-times"></i></a>
                            </div>
                            Tabla de Registros de Ofertas de Cargas
                        </div>
                        <div class="panel-body">
                            <p style="margin-bottom: 25px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                          </p>

                          <div class="table-responsive">
                                <table id="tableExample4" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                      <th style="width:5%">No.</th>
                                      <th>Empresa</th>
                                      <th>Email</th>
                                      <th>Fecha Pub.</th>
                                      <th>Reg. Origen</th>
                                      <th>Reg. Destino</th>
                                      <th>Tipo Carga</th>
                                      <th>Precio</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        if(isset($ofertas_gencarga) && $ofertas_gencarga != false){
                                          $cont = 1;
                                          foreach($ofertas_gencarga as $s => $v){

                                            $id = $v["idofertacarga"];
                                            $uriupd = "?".$usr."/cuentas/upd/".$id."/commit";
                                            $uridel = "?".$usr."/cuentas/del/".$id;
                                            echo '<tr>';
                                            echo '<div class="container">';
                                            echo  '<td>'.($cont++).'</td>';

                                            echo  '<td>'.$v["empresa"].'</td>';
                                            echo  '<td>'.$v["email"].'</td>';
                                            $fpub = $v["fecha_publicacion"];
                                            echo '<td><i class="fa fa-calendar" aria-hidden="true"></i> '.$this->Crud_model->formateaFecha($fpub).'</td>';
                                            echo  '<td>'.$v["nregion_origen"].'</td>';
                                            echo  '<td>'.$v["nregion_destino"].'</td>';
                                            echo  '<td>'.$v["tipo_carga"].'</td>';
                                            $precio = number_format($v["precio"],0,',','.');
                                            echo  '<td> $ '.$precio.'</td>';

                                            echo '</div>';
                                            echo '</tr>';
                                          }
                                        }
                                      ?>
                                    </tbody>
                                </table>
                              </div>
                        </div>
                    </div>
                </div>
            </div>





<!--
##############################
   MODAL ALERTA ELIMINAR
##############################
-->
<div id="myModalRemove" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <strong><i class="glyphicon glyphicon-trash"></i> Eliminar un Registro:</strong></br>
                <p style="width:90%">Para eliminar el registro seleccionado, haga click en el boton Eliminar de la parte inferior de esta ventana.
                Recuerde que eliminará de manera permanente los datos guardados.</p>
            </div>

            <form class="form-horizontal" method="post"  id ="eliminarFila" action="#">
	            <div class="modal-body">
	                <div class="alert alert-danger">
	                	<p><strong><i class="fa fa-warning"></i> ¡Cuidado!</strong></br>
	                    Está apunto de Eliminar de manera permanente información, la cual podría ser de importancia para su empresa, asegúrese de verificar
	                    los datos antes eliminar un registro. Al ejecutar está acción está tomando la total responsabilidad del acto.</br></br>
					 </div>
	            </div>

	            <div class="modal-footer">
	                <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
	                <button type="button" class="btn btn-default" onClick="cleanDelete()"  data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
	            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!--
##############################
   MODAL ALERTA ELIMINAR
##############################
-->
<div id="myModalHabilitar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <strong><i class="glyphicon glyphicon-trash"></i> Eliminar un Registro:</strong></br>
                <p style="width:90%">Para habilitar el registro seleccionado, haga click en el boton Habilitar de la parte inferior de esta ventana.
                </p>
            </div>

            <form class="form-horizontal" method="post"  id ="habilitarFila" action="#">
	            <div class="modal-body">
	                <div class="alert alert-danger">
	                	<p><strong><i class="fa fa-warning"></i> ¡Cuidado!</strong></br>
	                    Está apunto de Habilitar una cuenta creada.
	                    Al ejecutar está acción está tomando la total responsabilidad del acto.</br></br>
					 </div>
	            </div>

	            <div class="modal-footer">
	                <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Habilitar</button>
	                <button type="button" class="btn btn-default" onClick="cleanHabilitado()"  data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
	            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php $usr = $this->session->userdata('login_type'); ?>

<script type="text/javascript">
    <?php echo 'usertype = "'.$usr.'";'; ?>
</script>
