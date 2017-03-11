				<?php if (isset($result) && $result != false){ ?>

				 <script type="text/javascript">
				 	datos_tabla = [];
				   	datos_tabla = <?=json_encode($result)?>;
				</script>

				 <?php } ?>


				<?php
					$usr = $this->session->userdata('login_type');

					$uri1 = "?".$usr."/buscarcamion/search/";
					$urioffer = "?".$usr."/ofrecercarga/";

				?>

				<div class="row">
                    <div class="col-lg-10">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="fa fa-cube" aria-hidden="true"></i>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Buscar Camión</h3>
                                <small>Busque camiones disponibles en tiempo real.</small>
                            </div>
                        </div>
                    </div>

                       <script type="text/javascript">

							title_add = '<?php echo $modal_title_add; ?>';
							title_text_add = '<?php echo $modal_title_text_add; ?>';
							title_upd = '<?php echo $modal_title_upd; ?>';
							title_text_upd = '<?php echo $modal_title_text_upd; ?>';
							nameform = 'masdetalle_cu';
							idr = 0;
						</script>


						<?php
							include 'modal_upper.php';
							//if($option == "show"){
							include 'masdetalle_buscarcamion_modal.php';
							//}
							include 'modal_lower.php';
						?>

                </div>

                <?= form_open($uri1); ?>
                <div class="row">
	                <div class="col-md-12">
	                    <div class="panel panel-filled">
	                    	<div class="panel-heading">
	                            <div class="panel-tools">
	                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
	                                <a class="panel-close"><i class="fa fa-times"></i></a>
	                            </div>
	                            Buscador de Carga
	                        </div>
	                        <div class="panel-body">
	                            <div class="row">
	                            	<div class="col-md-12 col-xs-12">
			                            <p style="margin-bottom: 25px;">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
										</p>
									</div>
	                            	<?php
	                                echo '<div class="col-md-2 col-xs-6 text-center">';
	                                echo '<select class="form-control" name="region_origen" data-parsley-required="true" onchange ="changeFilter(this.value)">';
									echo '<option value="-1">Todas las Regiones</option>';
						                if(isset($regiones)){
						                     foreach($regiones as $s => $v):
						                        echo '<option value="'.$v["idregion"].'"';
						                        if($ciudad_origen == $v["idregion"]) echo 'selected';
						                        echo '>';
						                        echo $v["nombre"];
						                        echo '</option>';

						                    endforeach;
						                }
					    			echo '</select>';
	                                echo '</div>';

	                                echo '<div class="col-md-2 col-xs-6 text-center">';
	                                echo '<select class="form-control" name="region_destino" data-parsley-required="true" onchange ="changeFilter(this.value)">';
									echo '<option value="-1">Todos los Destinos</option>';
						                if(isset($regiones)){
						                     foreach($regiones as $s => $v):
						                        echo '<option value="'.$v["idregion"].'"';
						                        if($ciudad_destino == $v["idregion"]) echo 'selected';
						                        echo '>';
						                        echo $v["nombre"];
						                        echo '</option>';

						                    endforeach;
						                }
					    			echo '</select>';
	                                echo '</div>';

	                                echo '<div class="col-md-2 col-xs-6 text-center">';
	                                echo '<select class="form-control" name="tipo_camion" data-parsley-required="true" onchange ="changeFilter(this.value)">';
									echo '<option value="-1">Todos Tipo de Camión</option>';
						                if(isset($tipos_camion)){
						                     foreach($tipos_camion as $s => $v):
						                        echo '<option value="'.$v["tipo"].'"';
						                        if($tipo_camion == $v["tipo"]) echo 'selected';
						                        echo '>';
						                        echo $v["tipo"];
						                        echo '</option>';

						                    endforeach;
						                }
					    								echo '</select>';

	                                echo '</div>';
																	echo '<div class="col-md-2 col-xs-6 text-center">';
	                                echo '<select class="form-control" id="doble_puente" name="doble_puente" data-parsley-required="true" onchange ="changeFilter(this.value)">';
																	echo '<option value="-1"';
																	if($doble_puente == "-1") echo 'selected';
																	echo'>Todos</option>';
																	echo '<option value="0"';
																	if($doble_puente == "0") echo 'selected';
																	echo'>Sin Doble Puente</option>';
																	echo '<option value="1"';
																	if($doble_puente == "1") echo 'selected';
																	echo'>Con Doble Puente</option>';

												    			echo '</select>';
								                  echo '</div>';



	                                /*echo '<div class="col-md-2 col-xs-6 text-center">';
	                                echo '<select class="form-control" name="eslicitacion" data-parsley-required="true" onchange ="changeFilter(this.value)">';
									echo '<option value="-1" ';
					                echo '>Todo Tipo de Oferta</option>';
					                echo '<option value="0" ';
					                    if("0" == $v["esLicitacion"]) echo 'selected';
					                echo '>Ofertas simples</option>';
					               	echo '<option value="1" ';
					                    if("1" == $v["esLicitacion"]) echo 'selected';
					                echo '>Licitaciones</option>';
					    			echo '</select>';
	                                echo '</div>';
	                                */
	                                ?>

	                                <div class="col-md-2 col-xs-6 text-center">
										<button type="submit"  class="btn btn-w-md btn-accent" style="width: 100%;"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
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
		                    <div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-hover" id="tableExample3">
									<!--
									<table class="table table-striped table-hover" id="dataTable1">
									-->
										<thead>
											<tr>
												<th style="width:5%">No.</th>
												<th>Reg. Origen</th>
												<th>Ciudad. Origen</th>
												<th>Reg. Destino</th>
												<th>Fecha disponibilidad</th>
												<th>Tipo Camion</th>
												<th>Matchs</th>
												<th>Opciones</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if(isset($result) ){
												if($result != false){
												$num = 1;
												foreach($result as $s => $v){

											//$id = $v["idofertacarga"];
											//$urirequest = "?".$usr."/resolver_solicitudes/show/oferta/0/".$v["idofertacarga"];

											$id = $v["idofertatransportista"];
											$uridetail = "?".$usr."/buscarcamion/detalle/".$id;
											$urirequest = "?".$usr."/resolver_solicitudes/show/oferta/".$id."/0";

											echo '<tr>';
											echo '<div class="container">';
											echo  '<td>'.($num++).'</td>';


											echo  '<td>';
											echo $v["nregion_origen"];
											echo '</td>';

											echo  '<td>';
											echo $v["nciudad_origen"];
											echo '</td>';

											echo  '<td>';
											echo $v["nregion_destino"];
											echo '</td>';


											//echo  '<td>';
											$fdisp = $v["fecha_disponibilidad"];
											echo  '<td><i class="fa fa-calendar" aria-hidden="true"></i> '.$this->Crud_model->formateaFecha($fdisp).'</td>';
											//echo $v["fecha_carga"];
											//echo  '</td>';



											echo  '<td>';
											echo $v["tipo_camion"];
											echo '</td>';


											echo  '<td>';
											echo $v["solicitudes"];
											echo  '<span class="badge-quest" style="border-radius: 30px !important; padding: 4px 7px !important;"><i class="fa fa-question" aria-hidden="true"></i></span> </td>';

											echo  '<td>';
											echo '<div class="col-md-6">';

											echo '<button onClick=modalChange("",nameform,title_upd,title_text_upd,'.$id.') class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal" style="width:100%"><i class="fa fa-file-text-o" aria-hidden="true"></i> Detalles</button>';

											echo '</div>';
											
											echo '</td>';
											echo '</div>';
											echo '</tr>';
												}

											}
											else{

												echo '<div class="alert alert-danger" style="border: 1px dashed rgb(255, 151, 151);"><strong><i class="fa fa-warning"></i> ¡Lo sentimos! </strong>'.INFO_NO_DATA.'<br><br>
												<a href="'.site_url($urioffer).'" class="btn btn-w-md btn-default" style="font-weight: bold; width: 100%; border: 1px solid rgb(171, 61, 56) !important; color: rgb(255, 255, 255) !important; background: rgb(189, 68, 62) none repeat scroll 0% 0%;">Ofrecer Carga</a></div>';

											}
										}
											?>
										</tbody>
									</table>


								</div>
							</div>
						</div>
					</div>
				</div><!-- /class="row" -->



	<?php $usr = $this->session->userdata('login_type'); ?>
	<script type="text/javascript">
	    <?php echo 'usrtype = "'.$usr.'";'; ?>

			console.log(datos_tabla);
			function llenarDatos(idrow){
				limpiarDatos();
				for (var i=0;i<datos_tabla.length;i++){
		   			//lert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);
		   			if(datos_tabla[i].idofertatransportista == idrow){
		   				$(document).find("td[id='idofertatransportista']").append(datos_tabla[i].idofertatransportista+"-000-TR");
							var meses = {"01":"Ene","02":"Feb","03":"Mar","04":"Abr","05":"May","06":"Jun",
													"07":"Jul","08":"Ago","09":"Sept","10":"Oct","11":"Nov","12":"Dic"};
		   				var fpub = (datos_tabla[i].fecha_publicacion).replace(/-/g,"/");
							var fdisp = (datos_tabla[i].fecha_disponibilidad).replace(/-/g,"/");
							fpubarr = fpub.split("/"); fdisparr = fdisp.split("/");

							fpub = fpubarr[2] + " de " + meses[fpubarr[1]] + " de "+fpubarr[0];
							fdisp = fdisparr[2] + " de " + meses[fdisparr[1]] + " de "+fdisparr[0];

		   				$(document).find("td[id='fecha_publicacion']").append(fpub);
		   				$(document).find("td[id='fecha_disponibilidad']").append(fdisp);
		   				$(document).find("td[id='nciudad_origen']").append(datos_tabla[i].nciudad_origen);
		   				$(document).find("td[id='nciudad_destino']").append(datos_tabla[i].nciudad_destino);
		   				$(document).find("td[id='origen_direccion']").append(datos_tabla[i].origen_direccion);
		   				$(document).find("td[id='destino_direccion']").append(datos_tabla[i].destino_direccion);
		   				$(document).find("td[id='cantidad_carga']").append(datos_tabla[i].cantidad_carga);
		   				$(document).find("td[id='tipo_camion']").append(datos_tabla[i].tipo_camion);


		   				$(document).find("td[id='patente']").append(datos_tabla[i].patente);
		   				$(document).find("td[id='detalle']").append(datos_tabla[i].detalle);
		   				$(document).find("td[id='descripcion_estado']").append(datos_tabla[i].descripcion_estado);

							var id = datos_tabla[i].idofertatransportista;
							$.ajax({
								url: window.location.pathname+'?'+usrtype.toString()+'/verdatosJSON/'+id,                  //the script to call to get data
								data: "",                        //you can insert url argumnets here to pass to api.php
																								 //for example "id=5&parent=6"
								dataType: 'json',                //data format
								success: function(data)          //on recieve of reply
								{
									//--------------------------------------------------------------------
									// 3) Update html content
									//--------------------------------------------------------------------
									var gps = (data[0].gps_empresa.trim().length > 0)? "Si":"No";
									var seg = (data[0].seg_empresa.trim().length > 0)? "Si":"No";
									var puente = (data[0].doble_puente > 0)? "Si":"No";
									$(document).find("td[id='gps_seg_puente']").append(gps + " / " + seg + " / "+puente);
									$(document).find("td[id='mail_contacto']").append(data[0].mail_contacto);
									$(document).find("td[id='fono_contacto']").append(data[0].fono_contacto);
									$(document).find("td[id='razon_social']").append(data[0].razon_social);
									$(document).find("td[id='username']").append(data[0].Muser);
										console.log(data);
								}
							});

		   			}
		   		}

			}
			function limpiarDatos(){
				$(document).find("td[id='idofertatransportista']").text("");
   				$(document).find("td[id='fecha_publicacion']").text("");
   				$(document).find("td[id='fecha_disponibilidad']").text("");
   				$(document).find("td[id='nciudad_origen']").text("");
   				$(document).find("td[id='nciudad_destino']").text("");
   				$(document).find("td[id='origen_direccion']").text("");
   				$(document).find("td[id='destino_direccion']").text("");
   				$(document).find("td[id='cantidad_carga']").text("");
   				$(document).find("td[id='tipo_camion']").text("");
   				$(document).find("td[id='patente']").text("");
   				$(document).find("td[id='detalle']").text("");
   				$(document).find("td[id='descripcion_estado']").text("");

					$(document).find("td[id='gps_seg_puente']").text("");
					$(document).find("td[id='mail_contacto']").text("");
					$(document).find("td[id='fono_contacto']").text("");
					$(document).find("td[id='razon_social']").text("");
					$(document).find("td[id='username']").text("");



			}
			function deleteRow(url){
				$("#eliminarFila").attr("action",url);
			}
			function cleanDelete(){
				$("#eliminarFila").attr("action","#");
			}


	</script>
