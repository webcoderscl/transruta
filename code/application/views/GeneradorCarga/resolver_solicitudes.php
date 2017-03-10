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
                                <?php 
                            	if($modalidad == "oferta") { ?>
									<h3 class="m-b-xs">Solicitar Carga</h3>
                                	<small>Selecciona tu oferta con la que enviarás la solicitud.</small>
                                
                                <?php }else{ ?>                                	
                                	<h3 class="m-b-xs">Resolver Solicitud</h3>
                                	<small>Selecciona la oferta que aceptarás.</small>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2">			
						<?php
                    		if($modalidad == "oferta") {
								$uriback = "?".$usr."/buscarcarga";
								$txtBack = "Volver a Buscar Camión";
								$txtSubmit = "Enviar Solicitud";
                            }else{   	
                              	$uriback = "?".$usr."/misofertas";
                              	$txtBack = "Volver a Mis Ofertas";
                              	$txtSubmit = "Aceptar Solicitud";
                        
                        } ?>

						<a href="<?php echo site_url($uriback); ?>">
							<button class="btn btn-default btn-sm destacado-btn btn-right">
								<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> <?= $txtBack ?>
							</button>
						</a>
					</div>
                </div>


	            <div class="row">
	            	<div class="col-md-12">
	                <div class="alert alert-warning">
                        <p><strong><i class="fa fa-warning"></i> ¡Felicidades!</strong><br>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco<br><br>
                        </p>
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

								<h3 style="text-transform: uppercase; font-size: 14px; font-family: 'couturebold'" class="m-b-xs">Registro Seleccionado:</h3>
								<div class="table-responsive" style="margin-bottom:30px;">
                                    <table class="table table-hover table-striped">
                                        <thead style="font-size: 13px !important;">
                                        	<?php 
			                            	if($modalidad == "solicitud") { ?>
												<tr>
		                                            <th>Región de Origen</th>
		                                            <th>Ciudad de Origen</th>
		                                            <th>Región de Destino</th>
		                                            <th>Ciudad de Destino</th>
		                                            <th>Fecha de Carga</th>
		                                            <th>Precio Trabajo</th>
		                                           	<th>Cantidad de Carga</th>
		                                           
		                                        </tr>
			                                
			                                <?php }else{ ?>                                	
			                                	<tr>
		                                            <th>Región de Origen</th>
		                                            <th>Ciudad de Origen</th>
		                                            <th>Región de Destino</th>
		                                            <th>Ciudad de Destino</th>
		                                            <th>Fecha de Carga</th>
		                                            <th>Patente</th>
		                                            <th>Chofer</th>
		                                            <th>RUT</th>		                                            
		                                        </tr>


			                                <?php } ?>
	                                        
                                        </thead>
                                        <tbody style="font-size: 13px !important;">

                                        	<?php 
			                            	if($modalidad == "solicitud") { // MI OFERTA A SOLICITAR
												
												if(isset($laoferta) && $laoferta!= false){		
													$cont = 1;
													foreach($laoferta as  $v){	
														echo '<tr>';														
														
														echo '<td>';														
														echo $v["nregion_origen"];																					
														echo '</td>';
														echo '<td>';														
														echo $v["nciudad_origen"];																					
														echo '</td>';

														echo '<td>';														
														echo $v["nregion_destino"];																					
														echo '</td>';
														echo '<td>';														
														echo $v["nciudad_destino"];																					
														echo '</td>';
														echo '<td>';														
														
														$fecha = $this->Crud_model->formateaFecha($v["fecha_carga"]);
														echo $fecha;																					
														echo '</td>';
														echo '<td style="text_align:right;">';	
														$nbr = number_format($v["precio"],0,',','.');
														echo '$ '.$nbr;																					
														echo '</td>';

														echo '<td style="text_align:right;">';														
														echo $v["cantidad_carga"]. '[Tn]';
														echo '</td>';

														echo '</tr>';

													}
												}
			                                	
			                                
			                                }else{ // SOLICITUDES DE MI OFERTA

			                                		if(isset($laoferta) && $laoferta!= false){		
														$cont = 1;
														foreach($laoferta as  $v){	
															echo '<tr>';
															echo '<td>';														
															echo $v["nregion_origen"];																					
															echo '</td>';
															echo '<td>';														
															echo $v["nciudad_origen"];																					
															echo '</td>';

															echo '<td>';														
															echo $v["nregion_destino"];																					
															echo '</td>';
															echo '<td>';														
															echo $v["nciudad_destino"];																					
															echo '</td>';
															
															echo '<td>';														
															$fecha = $this->Crud_model->formateaFecha($v["fecha_disponibilidad"]);
															echo $fecha;															
															echo '</td>';

															echo '<td>';														
															echo $v["patente"];																					
															echo '</td>';

															echo '<td>';														
															echo $v["chofer"];																					
															echo '</td>';
															
															echo '<td>';														
															echo $v["RUT"];
															echo '</td>';
															
															echo '<td></td>';
																												

															echo '</tr>';

														}
													}
			                                	
			                                 } ?>


                                        </tbody>
                                    </table>
                                </div>

                                <h3 style="text-transform: uppercase; font-size: 14px; font-family: 'couturebold'" class="m-b-xs">Selecciona tu oferta con la que solicitas transporte:</h3>
								<div class="table-responsive">
									<?php
									$mod = "";
									if($modalidad == "oferta") { $mod ="request"; }
									else{ $mod = "join"; }
									$urijoin = "?".$usr."/resolver_solicitudes/".$mod."/".$modalidad."/".$idofertatransportista."/".$idofertacarga;
										echo form_open($urijoin);			
									?>
	                                <table id="tableExample3" class="table table-striped table-hover">
	                                   
	                                    <thead style="font-size: 13px !important;">

	                                    	<?php if($modalidad == "solicitud"){ ?>
			                                    <tr>
			                                    	<th style="width:3%">No.</th>
			                                        <th style="width:5%">Elección</th>
			                                        <th>Publicado</th>
			                                        <th>Patente</th>
			                                        <th>Chofer</th>
			                                        <th>Región de Origen</th>
		                                            <th>Ciudad de Origen</th>
		                                            <th>Región de Destino</th>
		                                            <th>Ciudad de Destino</th>                                        
			                                    </tr>

			                                <?php }else{ ?>
			                                	<tr>
			                                    	<th style="width:3%">No.</th>
			                                        <th style="width:5%">Elección</th>
			                                        <th>Publicado</th>
			                                        <th>Tipo Carga</th>
			                                         <th>Cantidad</th>
			                                        <th>Precio</th>
			                                        <th>Fecha Carga</th>			                                       
			                                        <th>Región de Origen</th>
		                                            <th>Ciudad de Origen</th>
		                                            <th>Región de Destino</th>
		                                            <th>Ciudad de Destino</th>                                        
			                                    </tr>
			                                <?php } ?>

										</thead>
										<tbody style="font-size: 13px !important;">
											<?php 
                            				if($modalidad == "solicitud") { 
                            					
												if(isset($missolicitudes) && $missolicitudes!= false){		
													$cont = 1;
													foreach($missolicitudes as  $v){	
														
														//print_r($v["idofertatransportista"]);
														
																												
														echo '<tr>';
														echo '<td>'.($cont++).'</td>';
														echo '<td>';
														echo '<input type="radio" name="idmatch" value="';														
														echo $v["idmatch"];
														echo '" required></input>';					
														echo '</td>';
														$fecha = $this->Crud_model->formateaFecha($v["fecha_publicacion"]);
														echo '<td>'.$fecha.'</td>';
														echo '<td>'.$v["patente"].'</td>';
														echo '<td>'.$v["chofer"].'</td>';														
														echo '<td>'.$v["nregion_origen"].'</td>';
														echo '<td>'.$v["nciudad_origen"].'</td>';
														echo '<td>'.$v["nregion_destino"].'</td>';
														echo '<td>'.$v["nciudad_destino"].'</td>';
													
														//echo  '<td>'.$v["idofertacarga"].'</td>';
														//echo  '<td>'.$v["idofertatransportista"].'</td>';
																			
														//echo  '<td>'.$v["descripcion_estado_solicitud"].'</td>';
														

														echo '</tr>';


													}
												}
											
											}else{ 

												if(isset($missolicitudes) && $missolicitudes!= false){		
													$cont = 1;
													foreach($missolicitudes as  $v){	
														
														
														
														echo '<tr>';
														echo '<td>'.($cont++).'</td>';
														echo '<td>';
														echo '<input type="radio" name="idmatch" value="';														
														echo $v["idmatch"];
														echo '" required></input>';																														
														$fecha = $this->Crud_model->formateaFecha($v["fecha_publicacion"]);
														$fecha_carga = $this->Crud_model->formateaFecha($v["fecha_carga"]);
														echo '<td>'.$fecha.'</td>';
														echo '<td>'.$v["tipo_carga"].'</td>';														
														echo '<td>'.$v["cantidad_carga"].' [Tn]</td>';
														$nbr = number_format($v["precio"],0,',','.');
														echo '<td> $'.$nbr.'</td>';
														echo '<td>'.$fecha_carga .'</td>';
														echo '<td>'.$v["nregion_origen"].'</td>';
														echo '<td>'.$v["nciudad_origen"].'</td>';
														echo '<td>'.$v["nregion_destino"].'</td>';
														echo '<td>'.$v["nciudad_destino"].'</td>';
														//echo  '<td>'.$v["idofertacarga"].'</td>';
														//echo  '<td>'.$v["idofertatransportista"].'</td>';
																			
														//echo  '<td>'.$v["descripcion_estado_solicitud"].'</td>';
														
														echo '</tr>';


													}
												}
											
											 } ?>

										</tbody>
	                                </table>

	                                <button class="btn btn-default btn-sm destacado-btn btn-right">
										<i class="fa fa-plus" aria-hidden="true"></i> <?= $txtSubmit; ?>
									</button>

	                                <?= form_close(); ?>

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

            <form class="form-horizontal" method="post" action="#">
	            <div class="modal-body">
	                <div class="alert alert-danger">
	                	<p><strong><i class="fa fa-warning"></i> ¡Cuidado!</strong></br>
	                    Está apunto de Eliminar de manera permanente información, la cual podría ser de importancia para su empresa, asegúrese de verificar
	                    los datos antes eliminar un registro. Al ejecutar está acción está tomando la total responsabilidad del acto.</br></br>
					 </div>
	            </div>
	                                                    
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
	            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




	
	<script type="text/javascript">
		function showLenPwdValue(newValue, idserv)
		{
			document.getElementById("pwdrange"+idserv).innerHTML="len => " +newValue;
		}
		function showLenValuationValue(newValue, idserv)
		{
			document.getElementById("valrange"+idserv).innerHTML="value => " +newValue;
		}

		function checkPwd(idvinc, mode){
			 $.ajax({                                      
		      url: window.location.pathname+'?Ajax/userCheckPwd/'+idvinc+'/'+mode,                  //the script to call to get data          
		      data: "",                        //you can insert url argumnets here to pass to api.php
		                                       //for example "id=5&parent=6"
		      dataType: 'json',                //data format      
		      success: function(data)          //on recieve of reply
		      {
		        
		        //--------------------------------------------------------------------
		        // 3) Update html content
		        //--------------------------------------------------------------------
		               
		        //for(var i=0;i<data.length;i++){
		          var id = data.id;              //get id
		          var oldpwd = data.oldpassword;           //get name
		          var pwd = data.password;           //get name
		           //alert(data.password);
		            //$.each( data, function( id, val ) {
		              //items.push( "<li id='" + id + "'>" + data[id]['Muser']  +"</li>" );
		            //});
		          
		          if(mode == 'hide'){
		          	$('#btn'+id).html('<i class="fa fa-eye"></i> Show');
		          	$('#btn'+id).removeClass("btn-success").addClass('btn-danger');
		          	$('#btn'+id).attr("onClick","checkPwd("+id+",'show')");
		          	$('#badge'+id).html('Hidden');
		          	$('#badge'+id).removeClass("badge-danger").addClass('badge-success');
		          	$('#oldpwd'+id).removeClass("badge-danger").addClass("badge-success");
		          	$('#pwd'+id).removeClass("badge-danger").addClass("badge-success");
		          	
		          }		          	
		          else if(mode == 'show'){
		          	$('#btn'+id).html('<i class="fa fa-eye-slash"></i> Hide');		          	
		          	$('#btn'+id).removeClass("btn-danger").addClass('btn-success');
		          	$('#btn'+id).attr("onClick","checkPwd("+id+",'hide')");
		          	$('#badge'+id).html('Visible');
		          	$('#badge'+id).removeClass("badge-success").addClass('badge-danger');
		          	$('#oldpwd'+id).removeClass("badge-success").addClass("badge-danger");
		          	$('#pwd'+id).removeClass("badge-success").addClass("badge-danger");
		          }

		          $('#oldpwd'+id).html(oldpwd); 
		          $('#pwd'+id).html(pwd);


		          //$('#output').html(items.join("")); //Set output element html  
		        //}
		        
		        //recommend reading up on jquery selectors they are awesome 
		        // http://api.jquery.com/category/selectors/
		      } 
		    });
		}
	</script>
	

