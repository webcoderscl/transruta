   <?php
   $usr = $this->session->userdata("login_type");
   $uriadd = "?".$usr."/".$page_name."/add";
   ?>

   <script type="text/javascript">
   	datos_tabla = <?=json_encode($choferes)?>;
   	for (var i=0;i<datos_tabla.length;i++){
   		//alert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);

   	}

	console.log(datos_tabla);
	function llenarDatos(idrow){
		for (var i=0;i<datos_tabla.length;i++){
   			//lert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);
   			if(datos_tabla[i].idchofer == idrow){
   				$("input[name='nombre']").val(datos_tabla[i].nombre);
   				$("input[name='apellido']").val(datos_tabla[i].apellido);
   				$("input[name='rut']").val(datos_tabla[i].RUT);
   				$("input[name='celular']").val(datos_tabla[i].celular);
   			}
   		}

	}
	function limpiarDatos(){
		$("input[name='nombre']").val("");
		$("input[name='apellido']").val("");
		$("input[name='rut']").val("");
		$("input[name='celular']").val("");
	}
	function deleteRow(url){
		$("#eliminarFila").attr("action",url);
	}
	function cleanDelete(){
		$("#eliminarFila").attr("action","#");
	}
   </script>
				<div class="row">
                    <div class="col-lg-10">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-paper-plane"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Choferes</h3>
                                <small>Ingresa los datos de tu personal.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                    	<script type="text/javascript">
							title_add = '<?php echo $modal_title_add; ?>';
							title_text_add = '<?php echo $modal_title_text_add; ?>';
							title_upd = '<?php echo $modal_title_upd; ?>';
							title_text_upd = '<?php echo $modal_title_text_upd; ?>';
							nameform = 'chofer_cu';
							idr = 0;
						</script>

						<button	onClick=modalChange('<?php echo site_url().$uriadd ?>',nameform,title_add,title_text_add,idr) class="btn btn-default btn-sm destacado-btn btn-right"
						data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Nuevo Chofer</button>

						<?php
							include 'modal_upper.php';
							//if($option == "show"){
							include 'chofer_modal.php';
							//}
							include 'modal_lower.php';
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
	                                        <span class="pe-7s-photo-gallery c-accent"></span> 0
	                                    </h2>
	                                    <span class="c-white">Avisos</span> Vistos
	                                </div>
	                                <div class="col-md-3 col-xs-6 text-center">
	                                    <h2 class="no-margins">
	                                        <span class="pe-7s-date c-accent"></span> 0
	                                    </h2>
	                                    <span class="c-white">Cargas</span> Entregadas
	                                </div>
	                                <div class="col-md-3 col-xs-6 text-center">
	                                    <h2 class="no-margins">
	                                        <span class="pe-7s-like2 c-accent"></span> 0
	                                    </h2>
	                                    <span class="c-white">Empresas</span> Confian
	                                </div>
	                                <div class="col-md-3 col-xs-6 text-center">
	                                    <h2 class="no-margins">
	                                        <span class="pe-7s-chat c-accent"></span> 0
	                                    </h2>
	                                    <span class="c-white">Ofertas</span> Publicadas
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>

				<!--
				<ul class="pagination">
					<?php echo $links; ?>
				</ul>
				-->

	            <div class="row">
	                <div class="col-md-12">
	                    <div class="panel panel-filled">
	                        <div class="panel-heading">
	                            <div class="panel-tools">
	                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
	                                <a class="panel-close"><i class="fa fa-times"></i></a>
	                            </div>
	                            Tabla de Registros de Choferes
	                        </div>
	                        <div class="panel-body">
	                            <p style="margin-bottom: 25px;">
									En este apartado podrás registrar a todo tu personal, los cuales son los encargado de manejar un vehículo. Estos serán los responsables visibles de completar un adecuado transporte de carga a la hora de concretar un trato. Para operar correctamente en la plataforma recuerda que es importante primero crear un Chofer para poder asignarlo al registrar un vehículo en el apartado “Equipos”.
								</p>
	                            <div class="table-responsive">
	                                <table id="tableExample3" class="table table-striped table-hover">
	                                    <thead>
	                                    <tr>
	                                        <th style="width:5%">No.</th>
	                                        <th>Nombre</th>
	                                        <th>Apellido</th>
	                                        <th>R.U.T</th>
	                                        <th>Teléfono</th>
	                                        <!-- <th>Ciudad</th> -->
	                                        <!--<th>Calificación</th> -->
	                                        <th style="width:340px;">Opciones</th>
	                                    </tr>
	                                    </thead>
	                                    <tbody>
	                                    	<?php
												if(isset($choferes) && $choferes != false){
													$cont = 1;
													foreach($choferes as $s => $v){
														$id = $v["idchofer"];
														$uriupd = "?".$usr."/choferes/upd/".$id."/commit";
														$uridel = site_url()."?".$usr."/choferes/del/".$id;

														echo '<tr>';
														echo '<td>'.($cont++).'</td>';
														echo '<td>'.$v["nombre"].'</td>';
														echo '<td>'.$v["apellido"].'</td>';
														echo '<td>'.$v["RUT"].'</td>';
														echo '<td>+569 '.$v["celular"].'</td>';
                            //echo '<td>'.$v["ciudad"].'</td>';
														//echo '<td><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-half-o" aria-hidden="true"></i></td>';
														echo '<td>';
														echo '<div class="col-md-6">';
														echo '<button onClick=modalChange("'.site_url().$uriupd.'",nameform,title_upd,title_text_upd,'.$id.') class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal" style="width:100%"><i class="fa fa-clone" aria-hidden="true"></i> Editar</button>';
														echo '</div>';
														//echo '<div class="col-md-6">';
														//echo '<a type="button" href=".site_url($uridel)." class="btn btn-danger inline-block" style="width:100%"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Eliminar</a>';
														//echo '</div>';
														echo '<div class="col-md-6">';
														echo '<a type="button" href="#" onClick=deleteRow("'.$uridel.'") data-toggle="modal" data-target="#myModalRemove" class="btn btn-danger inline-block" style="width:100%"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
														echo '</div>';
														echo '</td>';
													}
												}
											?>
	                                    </tbody>
	                                </table>
	                                <!--
	                                <ul class="pagination">
										<?php echo $links; ?>
									</ul>
									-->
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

            <form class="form-horizontal" method="post" id ="eliminarFila" action="#">
	            <div class="modal-body">
	                <div class="alert alert-danger">
	                	<p><strong><i class="fa fa-warning"></i> ¡Cuidado!</strong></br>
	                    Está apunto de Eliminar de manera permanente información, la cual podría ser de importancia para su empresa, asegúrese de verificar
	                    los datos antes eliminar un registro. Al ejecutar está acción está tomando la total responsabilidad del acto.</br></br>
					 </div>
	            </div>

	            <div class="modal-footer">
	                <button type="submit" class="btn btn-danger" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
	                <button type="button" class="btn btn-default" onClick="cleanDelete()" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
	            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
