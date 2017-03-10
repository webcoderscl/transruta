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
                                <h3 class="m-b-xs">Mis Solicitudes Pendientes</h3>
                                <small>Tus ofertas de vehículos activas.</small>
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
									<?php
									$urijoin = "?".$usr."/resolver_solicitudes/request/".$idofertatransportista;
										echo form_open($urijoin);			
									?>
	                                <table id="tableExample3" class="table table-striped table-hover">
	                                   
	                                    <thead>
		                                    <tr>
		                                    	<th style="width:5%">No.</th>
		                                        <th>Elección</th>
		                                        <th>ID. ofertaCarga</th>
		                                        <th>ID. ofertaTransportista</th>		                                        
		                                        <th >Descripción</th>		                                        
		                                    </tr>
										</thead>
										<tbody>
											
											<?php

												if(isset($missolicitudes) && $missolicitudes!= false){		
													$cont = 1;
													foreach($missolicitudes as  $v){	
														
														
														
														echo '<tr>';
														echo  '<td>'.($cont++).'</td>';
														echo '<td>';
														echo '<input type="radio" name="idmatch" value="';														
														echo $v["idmatch"];
														echo '" required></input>';																														
														echo '</td>';
														echo  '<td>'.$v["idofertacarga"].'</td>';
														echo  '<td>'.$v["idofertatransportista"].'</td>';
																			
														echo  '<td>'.$v["descripcion_estado_oferta"].'</td>';
														echo '</tr>';
													}
												}
											?>
										</tbody>
	                                </table>
	                                	<button class="btn btn-default btn-sm destacado-btn btn-right">
								<i class="fa fa-plus" aria-hidden="true"></i> Enviar Solicitud
							</button>
	                                <?php
									echo form_close();
									?>
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
	

