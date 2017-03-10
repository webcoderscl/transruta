<?php if (isset($regiones) && $regiones != false){ ?>
				
 <script type="text/javascript">
 	datos_tabla = [];
   	datos_tabla = <?=json_encode($regiones)?>;

</script>

 <?php } ?>

 				<div class="row">
                    <div class="col-lg-10">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-plane"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Regiones</h3>
                                <small>Listado de Regiones Registradas en el Sistema.</small>
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
						</script>
			
						<button	onClick=modalChange('<?php echo site_url().$uriadd ?>',nameform,title_add,title_text_add) class="btn btn-default btn-sm destacado-btn btn-right" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-plus" aria-hidden="true"></i> Agregar Región
						</button>
			
						<?php 
						include 'modal_upper.php'; 
						//if($option == "show"){
						include 'region_modal.php'; 	
						//}
						include 'modal_lower.php'; 
						?>
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
	                            Tabla de Registros de Regiones
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
												<th style="width:55%">Nombre</th>
												<th>Latitud</th>
												<th>Longitud</th>					
												<th>Opción</th>
											</tr>
										</thead>
										<tbody>
											<?php

												if(isset($regiones) && $regiones != false){		
													$cont = 1;
													foreach($regiones as $s => $v){							
							
														$id = $v["idregion"];

														$uriupd = "?".$usr."/regiones/upd/".$id."/commit";
														$uridel = "?".$usr."/regiones/del/".$id;
														echo '<tr>';
														echo '<div class="container">';
														echo  '<td>'.($cont++).'</td>';
														echo  '<td>'.$v["nombre"].'</td>';
														echo  '<td>'.$v["latitud"].'</td>';
														echo  '<td>'.$v["longitud"].'</td>';
														
														echo  '<td>';
																												
														echo '<div class="col-md-6">';
														echo '<button onClick=modalChange("'.$uriupd.'",nameform,title_upd,title_text_upd,'.$id.') class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal" style="width:100%"><i class="fa fa-clone" aria-hidden="true"></i> Editar</button>';
														echo '</div>';					
													
														echo '<div class="col-md-6">';
														echo '<a type="button" href="#" onClick=deleteRow("'.$uridel.'")  data-toggle="modal" data-target="#myModalRemove" class="btn btn-danger inline-block" style="width:100%"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
														echo '</div>';						
																				
															
														echo '</td>';
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


<script type="text/javascript">
		
		console.log(datos_tabla);
		function llenarDatos(idrow){
			limpiarDatos();
			for (var i=0;i<datos_tabla.length;i++){
	   			//lert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);
	   			if(datos_tabla[i].idregion == idrow){
	   				
	   				//var fdisp = datos_tabla[i].fecha_disponibilidad;
	   				//var fdisp = (datos_tabla[i].fecha_disponibilidad).replace(/-/g,"/");
	   				//$(document).find("[name='fecha_disponibilidad']").val(fdisp);
	   				//$(document).find("[name='detalles']").val(datos_tabla[i].detalle);
	   				//$("#idcamion").find("option[cod='"+datos_tabla[i].patente+"']").prop("selected", true);   	   				
	   				$("#nombre").val(datos_tabla[i].nombre);
	   				$("#codigo").val(datos_tabla[i].codigo);
	   				$("#latitud").val(datos_tabla[i].latitud);
	   				$("#longitud").val(datos_tabla[i].longitud);
	   				
	   				
	   			}
	   		}
			
		}
		function limpiarDatos(){
			$("#nombre").val("");
			$("#codigo").val("");
			$("#latitud").val("");
			$("#longitud").val("");
				
		}
		function deleteRow(url){
			$("#eliminarFila").attr("action",url);
		}
		function cleanDelete(){
			$("#eliminarFila").attr("action","#");	
		}
				   
	</script>