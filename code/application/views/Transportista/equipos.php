				<?php
            		$usr = $this->session->userdata("login_type");
            		$uriadd = "?".$usr."/".$page_name."/add";
            	 ?>

            	 <script type="text/javascript">
				   	datos_tabla = <?=json_encode($equipos)?>;
				   	for (var i=0;i<datos_tabla.length;i++){
				   		//alert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);

				   	}

					console.log(datos_tabla);
					function llenarDatos(idrow){
						for (var i=0;i<datos_tabla.length;i++){
				   			//lert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);
				   			if(datos_tabla[i].idcamion == idrow){
				   				$("input[name='patente']").val(datos_tabla[i].patente);
				   				$("input[name='anio']").val(datos_tabla[i].anio);
				   				$("input[name='detalles']").val(datos_tabla[i].detalle);
				   				$("input[name='toneladas']").val(datos_tabla[i].toneladas);
				   				$("input[name='gps_empresa']").val(datos_tabla[i].gps_empresa);

									$("#doble_puente").val(datos_tabla[i].doble_puente);
									$("#doble_puente_chk").prop("checked", datos_tabla[i].doble_puente > 0);

									$("#gps_chk").prop("checked", (datos_tabla[i].gps_empresa.length > 0));
				   				$("#seg_carga_chk").prop("checked", (datos_tabla[i].seg_num_poliza.length > 0));
				   				if((datos_tabla[i].gps_empresa.length > 0)){ 	$("#gps_text").show();  }
				   				else { $("#gps_text").hide(); }
				   				if((datos_tabla[i].seg_num_poliza.length > 0)){ 	$(".seg_carga_text").show();  }
				   				else { $(".seg_carga_text").hide(); }

				   				$("input[name='seg_no_poliza']").val(datos_tabla[i].seg_num_poliza);
				   				$("input[name='seg_empresa']").val(datos_tabla[i].seg_empresa);
									var fec = datos_tabla[i].num_poliza_fec_expiracion;
									var fecExp = fec.replace(/-/g,"/");
									$("input[name='seg_no_poliza_fecha_exp']").val(fecExp);
									$(document).find("[name='tipo']").find("option[value='"+datos_tabla[i].tipo+"']").prop("selected", true);

				   				$(document).find("[name='chofer']").find("option[value='"+datos_tabla[i].idchofer_fk+"']").prop("selected", true);

				   			}
				   		}

					}
					function limpiarDatos(){
						$("input[name='patente']").val("");
		   				$("input[name='anio']").val("");
								$(document).find("[name='tipo']").find("option[value='-1']").prop("selected", true);
		   				$("input[name='toneladas']").val("");
		   				$("input[name='gps_empresa']").val("");
		   				$("input[name='seg_no_poliza']").val("");
		   				$("input[name='seg_empresa']").val("");
							$("#doble_puente_chk").prop("checked", false);
							$("#doble_puente").val("0");
		   				//$("select[name='chofer']").find("option[value='"+datos_tabla[i].idchofer_fk+"']").val("-1");
		   				$(document).find("[name='chofer']").find("option[value='-1']").prop("selected", true);
		   				//$(document).find("[name='chofer']").find("option[value='-1']").attr('selected','selected');

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
                                <img src="http://www.transruta.cl/code/template/codemakers/images/icon-truck.png">
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Equipos</h3>
                                <small>Ingresa tus vehiculos de carga.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2">
	                    <script type="text/javascript">

							title_add = '<?php echo $modal_title_add; ?>';
							title_text_add = '<?php echo $modal_title_text_add; ?>';
							title_upd = '<?php echo $modal_title_upd; ?>';
							title_text_upd = '<?php echo $modal_title_text_upd; ?>';
							nameform = 'equipo_cu';
							idr = -1;
						</script>

						<button onClick=modalChange('<?php echo site_url().$uriadd ?>',nameform,title_add,title_text_add,idr) class="btn btn-default btn-sm destacado-btn btn-right" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-plus" aria-hidden="true"></i> Agregar Nuevo Equipo
						</button>

						<?php
							include 'modal_upper.php';
							//if($option == "show"){
							include 'equipo_modal.php';
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
	                            Tabla de Registros de Vehículos
	                        </div>
	                        <div class="panel-body">
	                            <p style="margin-bottom: 25px;">
									En este apartado podrás registrar a tus vehículos disponibles dentro de tu organización. Estos vehículos serán con los que podrás postular a transportes con los diferentes Generador de Carga que requieran asistencia. Recuerda que al momento de registrar un vehículo, tendrás que asignarle un Chofer, el cual debe estar previamente creado en el apartado “Choferes”. ¡Una vez registrado tu vehículo estás listos para crear tu primera oferta de transporte!
								</p>
								<div class="table-responsive">
	                                <table id="tableExample3" class="table table-striped table-hover">
	                                    <thead>
	                                    <tr>
	                                        <th style="width:5%">No.</th>
	                                        <th>Patente</th>
	                                        <th>Año</th>
	                                        <th>Tipo de Vehiculo</th>
	                                        <th>Max. Toneladas</th>
	                                        <th>Chofer</th>
	                                        <th>GPS</th>
	                                        <th>Seguro</th>
	                                        <th>Opciones</th>
	                                    </tr>
	                                    </thead>
	                                    <tbody>
	                                    <?php
											if(isset($equipos) && $equipos != false){
												$cont = 1;
												foreach($equipos as $s => $v){
													$id = $v["idcamion"];
													$uri2 = "?User/goservice/";
													$uriupd = "?".$usr."/".$page_name."/upd/".$id."/commit";
													$uridel = site_url()."?".$usr."/".$page_name."/del/".$id;
													$datachofer = $this->Crud_model->chofer_get_all_by_id($v["idchofer_fk"],$idUserType);
													echo '<tr>';
													echo  '<td>'.($cont++).'</td>';
													echo  '<td>'.$v["patente"].'</td>';
													echo  '<td>'.$v["anio"].'</td>';
													echo  '<td>'.$v["tipo"].'</td>';
													echo  '<td>'.$v["toneladas"].'</td>';
													//echo  '<td>'.$datachofer[0]["nombre"].' '.$datachofer[0]["apellido"].'</td>';
													echo  '<td>'.$v["nombre_chofer"].' '.$v["apellido_chofer"].'</td>';
													echo  '<td>';
													if(strlen($v["gps_empresa"]) > 0) echo "Si";
													else echo "No";
													echo '</td>';
													echo  '<td>';
													if(strlen($v["seg_num_poliza"]) > 0) echo "Si";
													else echo "No";
													echo '</td>';
													echo  '<td>';
													echo '<div class="col-md-6">';
													echo '<button onClick=modalChange("'.site_url().$uriupd.'",nameform,title_upd,title_text_upd,'.$id.') class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal" style="width:100%"><i class="fa fa-clone" aria-hidden="true"></i> Editar</button>';
													echo '</div>';
													//echo '<div class="col-md-6">';
													//echo "<a type='button' href=".site_url($uridel)." class='btn btn-danger inline-block' >Eliminar</a>";
													//echo '</div>';
													echo '<div class="col-md-6">';
													echo '<a type="button" href="#" data-toggle="modal" onClick=deleteRow("'.$uridel.'") data-target="#myModalRemove" class="btn btn-danger inline-block" style="width:100%"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
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

            <form class="form-horizontal" method="post" id ="eliminarFila"  action="#">
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
