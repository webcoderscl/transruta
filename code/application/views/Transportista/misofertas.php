				<?php if (isset($misofertas) && $misofertas != false){ ?>
				
				 <script type="text/javascript">
				 	datos_tabla = [];
				   	datos_tabla = <?=json_encode($misofertas)?>;

				</script>
				
				 <?php } ?>


				<?php
					$usr = $this->session->userdata('login_type');
					$uriaddoffer = "?".$usr."/ofrecercamion";
				?>
				<div class="row">
                    <div class="col-lg-10">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-chat"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Mis Ofertas</h3>
                                <small>Tus ofertas de vehículos para cargar activas.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2">			
						<a href="<?php echo site_url($uriaddoffer); ?>">
							<button class="btn btn-default btn-sm destacado-btn btn-right">
								<i class="fa fa-plus" aria-hidden="true"></i> Agregar Nueva Oferta
							</button>
						</a>
					</div>

					<script type="text/javascript">
	                    	
							title_add = '<?php echo $modal_title_add; ?>';
							title_text_add = '<?php echo $modal_title_text_add; ?>';
							title_upd = '<?php echo $modal_title_upd; ?>';
							title_text_upd = '<?php echo $modal_title_text_upd; ?>';
							nameform = 'misofertas_cu';
							idr = 0;
					</script>

					<?php 
						include 'modal_upper.php'; 
						//if($option == "show"){
						include 'misofertas_modal.php'; 	
						//}
						include 'modal_lower.php'; 
					?>
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

	            <div class="row">
	                <div class="col-md-12">
	                    <div class="panel panel-filled">
	                        <div class="panel-heading">
	                            <div class="panel-tools">
	                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
	                                <a class="panel-close"><i class="fa fa-times"></i></a>
	                            </div>
	                            Tabla de Registros de tus Publicaciones
	                        </div>
	                        <div class="panel-body">
	                            <p style="margin-bottom: 25px;">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
								</p>
								<div class="table-responsive">
									
	                                <table id="tableExample3" class="table table-striped table-hover">
	                                    <thead>
		                                    <tr>
		                                    	<th style="width:5%">No.</th>
		                                        <th>Publicado</th>
		                                        <th>Patente</th>		                                        
		                                        <th>Ciudad Origen</th>												
		                                        <th>Ciudad Destino</th>
		                                        <th>Chofer</th>
		                                        <th style="text-align:center;">Solicitudes</th>
		                                        <th style="width: 93px;">Resolver</th>
		                                        <th>Opciones</th>
		                                    </tr>
										</thead>
										<tbody>
											<?php

												if(isset($misofertas) && $misofertas != false){		
													$cont = 1;
													foreach($misofertas as $s => $v){	
														$id = $v["idofertatransportista"];
														$uriupd = site_url()."?".$usr."/misofertas/upd/".$id;
														$uridel = site_url()."?".$usr."/misofertas/del/".$id;
														$urijoin = "?".$usr."/resolver_solicitudes/show/solicitud/".$id."/0";
														$urishow = "?".$usr."/verdatos/".$id;
														$uridet = "?".$usr."/misofertas/detalle/".$id;
														echo '<tr>';
														echo  '<td>'.($cont++).'</td>';
														//$fdisp = str_replace("-","/",$v["fecha_publicacion"]);
														$fdisp = $v["fecha_publicacion"];
														echo  '<td><i class="fa fa-calendar" aria-hidden="true"></i> '.$this->Crud_model->formateaFecha($fdisp).'</td>';
														echo  '<td>'.$v["patente"].'</td>';														
														echo  '<td>'.$v["ubicacion"].'</td>';														
														echo  '<td>'.$v["destino"].'</td>';					
														echo  '<td>'.$v["chofer_nombre"].'</td>';
														echo  '<td style="text-align:center;"><a href="#"><span class="badge slct" style="border-radius: 30px !important; padding: 4px 7px !important;">';
														echo $v["solicitudes"];
														echo '</span></a></td>';					
														echo  '<td>';
														if($v["solicitudes"] > 0){
															echo '<a type="button" href='.site_url($urijoin).' class="btn btn-w-md btn-warning" style="width:100%"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Resolver</a>';
														}
														if(intval($v["estado_oferta"]) == 2){
																													//echo '<a type="button" href='.site_url($urishow).' class="btn btn-w-md btn-success" style="width:100%"><i class="fa fa-check" aria-hidden="true"></i> Ver Datos</a>';
															echo '<span class="badge slct"><i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i> En Proceso</span>';
														}
														echo '</td>';

														
														echo '<td>';
														echo '<div class="col-md-6">';
														echo '<button onClick=modalChange("'.$uriupd.'",nameform,title_upd,title_text_upd,'.$id.') class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal" style="width:100%"><i class="fa fa-file-text-o" aria-hidden="true"></i> Detalle</button>';
														echo '</div>';
														//echo '<div class="col-md-6">';
														//echo '<a type="button" href='.site_url($uridel).' class="btn btn-danger inline-block" style="width:100%"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Dar de baja</a>';
														//echo '</div>';
														echo '<div class="col-md-6">';
														echo '<a type="button" href="#" onClick=deleteRow("'.$uridel.'")  data-toggle="modal" data-target="#myModalRemove" class="btn btn-danger inline-block" style="width:100%"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
														echo '</div>';	

														
														
														echo '</td>';
														echo '</tr>';
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




	
	<script type="text/javascript">
		
		console.log(datos_tabla);
		function llenarDatos(idrow){
			limpiarDatos();
			for (var i=0;i<datos_tabla.length;i++){
	   			//lert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);
	   			if(datos_tabla[i].idofertatransportista == idrow){
	   				
	   				//var fdisp = datos_tabla[i].fecha_disponibilidad;
	   				var fdisp = (datos_tabla[i].fecha_disponibilidad).replace(/-/g,"/");
	   				$(document).find("[name='fecha_disponibilidad']").val(fdisp);
	   				$(document).find("[name='detalles']").val(datos_tabla[i].detalle);
	   				//$("#idcamion").find("option[cod='"+datos_tabla[i].patente+"']").prop("selected", true);   	   				
	   				$("#idcamion").find("option:contains('"+datos_tabla[i].patente+"')").prop("selected", true);   			
					$("#ciudad_ubicacion").find("option[value='"+datos_tabla[i].ubicacion_origen+"']").prop("selected", true);
					var region_ubicacion = $("#ciudad_ubicacion").find("option[value='"+datos_tabla[i].ubicacion_origen+"']").attr("cod");
					$("#ciudad_destino").find("option[value='"+datos_tabla[i].destino_preferente+"']").prop("selected", true);
					var region_destino = $("#ciudad_ubicacion").find("option[value='"+datos_tabla[i].destino_preferente+"']").attr("cod");
					$("#region_origen").find("option[value='"+region_ubicacion+"']").prop("selected", true);
					$("#region_destino").find("option[value='"+region_destino+"']").prop("selected", true);
	   				
	   			}
	   		}
			
		}
		function limpiarDatos(){
			$(document).find("[name='fecha_disponibilidad']").val("");
			$(document).find("[name='detalles']").val("");
			$("#idcamion").find("option[value='-1']").prop("selected", true);   					
			$("#ciudad_ubicacion").find("option[value='-1']").prop("selected", true);
			$("#ciudad_destino").find("option[value='-1']").prop("selected", true);
			$("#region_origen").find("option[value='-1']").prop("selected", true);
			$("#region_destino").find("option[value='-1']").prop("selected", true);
				
				
		}
		function deleteRow(url){
			$("#eliminarFila").attr("action",url);
		}
		function cleanDelete(){
			$("#eliminarFila").attr("action","#");	
		}
				   
	</script>


