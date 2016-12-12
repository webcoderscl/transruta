				<?php 
					$usr = $this->session->userdata('login_type');
					$uri = "?".$usr."/misdatos";
				?>
<?php if(isset($mis_datos)){ ?>


				<div class="row">
                    <div class="col-lg-12">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-users"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Perfil Empresa</h3>
                                <small>Datos de Contacto.</small>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

                
                <div class="row m-t-sm">
	                <div class="col-md-12">
	                    <div class="panel panel-filled">
	                        <div class="panel-body">
	                            <div class="row">
	                                
	                                <div class="col-md-4">
	                                    <div class="panel-body h-200 list">
				                            <div class="stats-title pull-left">
		                                        <h4>
		                                            <i class="pe pe-7s-user c-accent"></i> <?php if(isset($mis_datos[0]["nombre_representante_legal"])) echo $mis_datos[0]["nombre_representante_legal"]; ?>
		                                        </h4>
	                                        </div>
	                                        <table class="table small m-t-sm tbl">
					                            <tbody>
			                                        <tr>
							                            <td>Rut:</td>
							                            <td><?php if(isset($mis_datos[0]["rut_representante_legal"])) echo $mis_datos[0]["rut_representante_legal"]; ?></td>
							                        </tr>
							                        <tr>
							                            <td>Teléfono:</td>
							                            <td><?php if(isset($mis_datos[0]["telefono_representante_legal"])) echo $mis_datos[0]["telefono_representante_legal"]; ?></td>
							                        </tr>
							                    </tbody>
					                        </table>
	                                        <p style="text-align: justify;">
	                                            Sobre <?php if(isset($mis_datos[0]["razon_social"])) echo $mis_datos[0]["razon_social"]; ?>: <?php if(isset($mis_datos[0]["acerca_de"])) echo $mis_datos[0]["acerca_de"]; ?>
	                                        </p>
	                                        <div class="btn-group m-t-sm" style="width:100%;">
		                                        <a href="#" class="btn btn-default btn-sm" style="width:50%;"><i class="fa fa-envelope"></i> Contactar</a>
		                                        <a href="<?= $mis_datos[0]['pag_web']; ?>" target="_blank" class="btn btn-default btn-sm" style="width:50%;"><i class="fa fa-plus-circle"></i> Website</a>
		                                    </div>
	                                    </div>
	                                </div>
	                                <!-- Item -->
	                                <div class="col-md-4 m-t-sm">
	                                	<div class="panel-body h-200 list">
				                            <div class="stats-title pull-left">
				                                <h4><?php if(isset($mis_datos[0]["razon_social"])) echo $mis_datos[0]["razon_social"]; ?></h4>
				                            </div>

				                            <div class="m-t-xl">
				                                <table class="table small m-t-sm tbl">
					                                <tbody>
					                                <tr>
					                                    <td>Giro:</td>
					                                    <td><?php if(isset($mis_datos[0]["giro"])) echo $mis_datos[0]["giro"]; ?></td>
					                                </tr>
					                                <tr>
					                                    <td>Rut:</td>
					                                    <td><?php if(isset($mis_datos[0]["RUT"])) echo $mis_datos[0]["RUT"]; ?></td>
					                                </tr>
					                                <tr>
					                                    <td>Dirección:</td>
					                                    <td><?php if(isset($mis_datos[0]["direccion"])) echo $mis_datos[0]["direccion"]; ?></td>
					                                </tr>
					                                <tr>
					                                    <td>Ciudad:</td>
					                                    <td><?php if(isset($mis_datos[0]["ciudad"])) echo $mis_datos[0]["ciudad"]; ?></td>
					                                </tr>
					                                <tr>
					                                    <td>Teléfono:</td>
					                                    <td><?php if(isset($mis_datos[0]["fono"])) echo $mis_datos[0]["fono"]; ?></td>
					                                </tr>
					                                </tbody>
					                            </table>
				                            </div>
	                                    </div>
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
				<div class="row">
					<div class="col-md-2">
						<div class="panel panel-b-accent" style="position:relative;height: 555px">
                            <div style="position: absolute;bottom: 0;left: 0;right: 0">
                            </div>
                            <div class="panel-body">
                                <div class="m-t-sm">
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-xs" style="color: #fff; border-color: #FFF; padding: 5px; margin-top: 5px;">Publicidad</a>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
		            <div class="col-md-5">
	                    <div class="panel panel-filled">
	                        <div class="panel-body">
	                        	<div class="stats-title">
				                    <h4>Datos de la Empresa</h4>
				                </div>
				                <p>
				                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, <code>.form-control</code> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				                </p>

	                           
	                        </div>
	                    </div>
	                </div>

	                <div class="col-md-5">
	                    <div class="panel panel-filled">
	                        <div class="panel-body">
	                        	<div class="stats-title">
				                    <h4>Datos del Representante</h4>
				                </div>
				                <p>
				                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, <code>.form-control</code> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				                </p>
				               
				            </div>
				        </div>
				    </div>
                </div>
				-->
<?php }else{ ?>
 
 	<div class="row">
                    <div class="col-lg-12">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-users"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Usted No tiene acceso a esta información</h3>
                                <small>Debe poseer una oferta vigente con la empresa para visualizar los datos de contacto.</small>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
 
<?php } ?>	
	<script type="text/javascript">
		

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

