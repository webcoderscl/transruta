				<?php
					$usr = $this->session->userdata('login_type');
					$uri = "?".$usr."/misdatos";
				?>

				<div class="row">
                    <div class="col-lg-12">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-users"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Perfil Personal</h3>
                                <small>Ingresa tus datos personales y empresariales.</small>
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
		                                        <h4 style="font-size: 30px; margin-bottom: 27px;">
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
							                            <td>Correo Electrónico:</td>
							                            <td><?php if(isset($mis_datos[0]["mail_contacto"])) echo $mis_datos[0]["mail_contacto"]; ?></td>
							                        </tr>
							                        <tr>
							                            <td>Celular de Contacto:</td>
							                            <td><?php if(isset($mis_datos[0]["telefono_representante_legal"])) echo $mis_datos[0]["telefono_representante_legal"]; ?></td>
							                        </tr>
							                        <!--
							                        <tr>
							                            <td>Teléfono de Contacto:</td>
							                            <td><?php if(isset($mis_datos[0]["fono_contacto"])) echo $mis_datos[0]["fono_contacto"]; ?></td>
							                        </tr>
							                        -->
							                        <tr>
							                            <td>Ciudad:</td>
							                            <td><?php if(isset($mis_datos[0]["ciudad_contacto"])) echo $mis_datos[0]["ciudad_contacto"]; ?></td>
							                        </tr>
							                    </tbody>
					                        </table>

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
				                            <p style="text-align: justify; font-size: 11px; line-height: 12px;">
	                                            Sobre <?php if(isset($mis_datos[0]["razon_social"])) echo $mis_datos[0]["razon_social"]; ?>: <?php if(isset($mis_datos[0]["acerca_de"])) echo $mis_datos[0]["acerca_de"]; ?>
	                                        </p>
				                            <div class="btn-group m-t-sm" style="width:100%;">
		                                        <a href="#" class="btn btn-default btn-sm" style="width:50%;"><i class="fa fa-envelope"></i> Contactar</a>
		                                        <a href="<?= $mis_datos[0]['pag_web']; ?>" target="_blank" class="btn btn-default btn-sm" style="width:50%;"><i class="fa fa-plus-circle"></i> Website</a>
		                                    </div>
	                                    </div>
	                                </div>

	                                <!-- Item -->
				                    <div class="col-md-4">
				                        <div class="panel-body h-200 list">
				                            <div class="stats-title pull-left">
				                                <h4>Tu cuenta</h4>
				                            </div>
				                            <div class="m-t-xl">
				                                <small>
				                                    Este es el estado de tu cuenta dentro de la plataforma Transruta. Nuevas características y funciones son agregadas a las cuentas "Premium".
				                                </small>
				                            </div>

				                            <div class="progress m-t-xs full progress-small">
				                                    <div style="width: 35%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="35" role="progressbar" class=" progress-bar progress-bar-warning">
				                                        <span class="sr-only">35% Complete (success)</span>
				                                    </div>
				                            </div>

				                            <div class="row">
				                                <div class="col-md-6">
				                                        <small class="stat-label">Plan</small>
				                                        <h4 class="m-t-xs">Gratuito <i class="fa fa-level-up text-warning"></i></h4>
				                                </div>
				                                <div class="col-md-6">
				                                        <small class="stat-label">Vencimiento</small>
				                                        <h4 class="m-t-xs">Sin Vencimiento <i class="fa fa-level-down c-white"></i></h4>
				                                </div>
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
				                    Ingresa los datos de la <code>Empresa</code> en la cual trabajas o gestionas. La correcta información de ella es de tu responsabilidad. ¡Datos correctos es igual a buenos resultados!
				                </p>

	                            <?php
									$usr = $this->session->userdata('login_type');
									$uri1 = "?".$usr."/misdatos/upd/emp";
									echo form_open($uri1);
								?>
								<?php
									echo '<div class="form-group">';
									echo '<label for="exampleInputEmail1">Razón Social</label>';
									echo '<input id="misdatosemp" name="razon_social" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["razon_social"].'"/>';
	                                echo '</div>';
	                                echo '<div class="form-group">';
	                                echo '<label for="exampleInputEmail1">Giro</label>';
	                                echo '<input id="misdatosemp" name="giro" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["giro"].'"/>';
	                                echo '</div>';
	                                echo '<div class="form-group">';
	                                echo '<label for="exampleInputEmail1">R.U.T</label>';
	                                echo '<input id="misdatosemp" name="rut" pattern="^[0-9]{6,9}-[0-9Kk]$" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["RUT"].'"/>';
	                                echo '</div>';
	                                echo '<div class="form-group">';
	                                echo '<label for="exampleInputEmail1">Dirección Principal</label>';
	                                echo '<input id="misdatosemp" name="direccion" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["direccion"].'"/>';
	                                echo '</div>';
	                                echo '<div class="form-group">';
	                                echo '<label for="exampleInputEmail1">Ciudad</label>';
	                                echo '<input id="misdatosemp" name="ciudad" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["ciudad"].'"/>';
	                                echo '</div>';
	                                echo '<div class="form-group">';
	                                echo '<label style="width:100%;" for="exampleInputEmail1">Teléfono</label>';
																	$tlf = $mis_datos[0]["fono"];
																	$tlf_arr = preg_split('/\s+/',$tlf,NULL, PREG_SPLIT_NO_EMPTY);
																	if(count($tlf_arr) == 2){ $tlf = $tlf_arr[1]; }
	                                echo '	<select name="prefix_fono" style="width: 17%;display: inline-block;" class="form-control" data-parsley-required="true" required>
					                            <option value="+56" ';
																	if ($tlf_arr[0] == "+56") echo 'selected';
																	echo '>+56</option>
					                            <option value="+569" ';
																	if($tlf_arr[0] == "+569") echo 'selected';
																	echo '>+569</option>
					                        </select>
	                                		<input name="fono" style="width: 82%;display: inline-block;" data-parsley-required="true" class="form-control" pattern="^(\d{6,8})$" maxlength="9" id="misdatosemp" type="text" value="'.$tlf.'"/>';
	                                echo '</div>';
	                                echo '<div class="form-group">';
	                                echo '<label for="exampleInputEmail1">Página Web</label>';
	                                echo '<input name="pag_web" data-parsley-required="true" class="form-control" id="misdatosemp" type="text" value="'.$mis_datos[0]["pag_web"].'"/>';
	                                echo '</div>';
	                                 echo '<div class="form-group">';
	                                echo '<label for="exampleInputEmail1">Sobre su Empresa</label>';
									echo '<textarea name="acerca_de" cols="50" rows="5" maxlength="200" class="form-control" style="resize: vertical; line-height: 15px;" value="">'.$mis_datos[0]["acerca_de"].'</textarea>';
	                                echo '</div>';
	                                echo '<button type="submit" class="btn btn-accent inline-block" style="width:100%; color:#f6a821; padding: 8px;"><i class="fa fa-check"></i> Modificar</button>';
	                                ?>
	                            <?php echo form_close(); ?>
	                        </div>
	                    </div>
	                </div>

	                <div class="col-md-5">
	                    <div class="panel panel-filled">
	                        <div class="panel-body">
	                        	<div class="stats-title">
				                    <h4>Datos de Contacto</h4>
				                </div>
				                <p>
				                    Ingresa tus datos personales <code>Usuario</code> que administra esta cuenta. Verifica la información, ya que estos datos serán el medio principal de contacto ante cualquier situación.
				                </p>
				                <?php
									$usr = $this->session->userdata('login_type');
									$uri2 = "?".$usr."/misdatos/upd/rep";
									echo form_open($uri2);
								?>
								<?php
									echo '<div class="form-group">';
									echo '<label for="exampleInputEmail1">Nombre Contacto</label>';
									echo '<input name="nombre_rep_legal" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["nombre_representante_legal"].'"/>';
	                                echo '</div>';
	                                /*
	                                echo '<div class="form-group" >';
									echo '<label for="exampleInputEmail1">R.U.N</label>';
									echo '<input name="rut_rep_legal" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["rut_representante_legal"].'"/>';
	                                echo '</div>';
									*/
	                echo '<div class="form-group">';
									echo '<label style="width:100%;" for="exampleInputEmail1">Celular de Contacto</label>';
									$trl = $mis_datos[0]["telefono_representante_legal"];
									$trl_arr = preg_split('/\s+/',$trl,NULL, PREG_SPLIT_NO_EMPTY);
									if(count($trl_arr) == 2){ $trl = $trl_arr[1]; }
									echo '<input type="hidden" name="prefix_fono_rep_legal" autocomplete="on" value="+569" />';
									echo '	<input type="text" style="width: 15%;display: inline-block;" data-parsley-required="true" name="" class="form-control" placeholder="+569" autocomplete="on" disabled="disabled" value="+569" />
											<input name="fono_rep_legal" style="width: 84%;display: inline-block;" data-parsley-required="true" pattern="^(\d{6,8})$" maxlength="9" class="form-control" type="text" value="'.$trl.'"/>';
	              	echo '</div>';

									//echo '<div class="form-group">';
									//echo '<label style="width:100%;" for="exampleInputEmail1">Teléfono de Contacto</label>';
									//$fnc = $mis_datos[0]["fono_contacto"];
									//$fnc_arr = preg_split('/\s+/',$fnc,NULL, PREG_SPLIT_NO_EMPTY);
									//if(count($fnc_arr) == 2){ $fnc = $fnc_arr[1]; }
									//echo '<input type="hidden" name="prefix_fono_contacto" autocomplete="on" value="+569" />';
									//echo '	<input type="text" style="width: 15%;display: inline-block;" data-parsley-required="true" name="" class="form-control" placeholder="+569" autocomplete="on" disabled="disabled" value="+569" />';
									//echo '<input name="fono_contacto" style="width: 84%;display: inline-block;" data-parsley-required="true" pattern="^(\d{6,8})$" maxlength="9" class="form-control" type="text" value="'.$fnc.'"/>';
                  					//echo '</div>';

									echo '<div class="form-group">';
									echo '<label for="exampleInputEmail1">Ciudad</label>';
									echo '<input name="ciudad_contacto" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["ciudad_contacto"].'"/>';
	                                echo '</div>';
	                                echo '<div class="form-group">';
									echo '<label for="exampleInputEmail1">Correo Electrónico</label>';
									echo '<input name="mail_contacto" data-parsley-required="true" class="form-control" type="email" value="'.$mis_datos[0]["mail_contacto"].'"/>';
	                                echo '</div>';

	                                echo '<button type="submit" class="btn btn-accent inline-block" style="width:100%; color:#f6a821; padding: 8px;"><i class="fa fa-check"></i> Modificar</button>';
								?>
								<?php echo form_close(); ?>
				            </div>
				        </div>
				    </div>
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
