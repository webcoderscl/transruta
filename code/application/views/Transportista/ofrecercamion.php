				<?php if (isset($camiones) && $camiones != false){ ?>
				
				 <script type="text/javascript">
				 	datos_tabla = [];
				   	datos_tabla = <?=json_encode($camiones)?>;

				</script>
				
				 <?php } ?>



                <?php 
				$usr = $this->session->userdata('login_type');
				$uri = "?".$usr."/ofrecercamion";
				?>
                <div class="row" style="margin-top: -32px;">
                    <div class="col-lg-12">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-box1"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Ofrecer Camiones</h3>
                                <small>Publica un camión como disponible para un próximo trabajo.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row display-none-1120">
	                <div class="col-md-12">
	                    <div class="panel panel-filled">
	                        <div class="panel-body">
	                            <div class="row">
	                                <div class="col-md-4 col-xs-6 text-right">
	                                    <img src="<?php echo base_url();?>template/codemakers/images/step-example-1.png">
	                                </div>
	                                <div class="col-md-4 col-xs-6 text-right">
	                                    <img src="<?php echo base_url();?>template/codemakers/images/step-example-2.png">
	                                </div>
	                                <div class="col-md-4 col-xs-6 text-right">
	                                    <img src="<?php echo base_url();?>template/codemakers/images/step-example-3.png">
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>

	            <?php 
					if (isset($msg_alerta)){ 
                            echo '<p style="color:white; background-color:green"><strong><h2>'.$msg_alerta.'</h2></strong><p>'; 
                            echo '<script type="text/javascript">alert('.$msg_alerta.'); </script>';
                        }
                   
	            ?>

	            <div class="row ">
					<div class="col-md-2 display-none-1120">
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

					<div class="col-md-7">
	                    <div class="panel panel-filled">
	                        <div class="panel-body">
	                        	<div class="stats-title">
				                    <h4>Datos del Anuncio</h4>
				                </div>
				                <p>
				                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, <code>.form-control</code> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				                </p>
				                <!--
				                <p style="color:red; background-color:green; display:none;" id="error_msg" ><strong>
                                <h3><?php echo ERROR_VALIDACION; ?></h3></strong><p>
                            	-->
				                <?php
									$usr = $this->session->userdata('login_type');
									$uri1 = "?".$usr."/ofrecercamion/add";
									echo form_open($uri1, array("id" => "form_data","onsubmit"=>"return validateFields()"));
								?>
								<div class="col-md-12" id="info_camionero" style="display:none; border: 1px dashed; border-radius: 3px; padding: 10px 0px; 
								background: rgba(255, 255, 255, 0.08) none repeat scroll 0% 0%; width: 98.5%; margin:15px 0;">
									<div class="col-md-6">
										<div class="header-title">
											<h3 class="m-b-xs" style="font-size: 10px; text-transform: uppercase; color: rgb(246, 168, 33);">Datos del chofer Asociado:</h3>
										</div>
										<div class="form-group">
											<label >Nombre: </label>
											<p id="nombre_chofer">nombreee</p>
										</div>
										<div class="form-group">
											<label >Apellido: </label> 
											<p id="apellido_chofer">apellido</p>
										</div>
										<div class="form-group">
											<label style="width:100%">Número Telefónico: </label> 
											<p style="width: 10%; display: inline-block;">+569</p><p style="width: 80%; display: inline-block;" id="celular_chofer"> celular</p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="header-title">
											<h3 class="m-b-xs" style="font-size: 10px; text-transform: uppercase; color: rgb(246, 168, 33);">Datos de equipo Asociado:</h3>
										</div>
										<div class="form-group">
											<label >Tipo Camion: </label> 
											<p id="tipo_camion">tipo camion</p>
										</div>
										<div class="form-group">
											<label >Toneladas Max.: </label> 
											<p id="toneladas"> tons </p>
										</div>
										<div class="form-group">
											<label >¿Tiene Aseguradora / Nro. póliza?:</label> 
											<p id="empresa_nropoliza"> si / no </p>
										</div>
									</div>
								</div>
				                <div class="col-md-6" style="padding-left: 0;">
				                	<?php
				                	echo '<div class="form-group">';
				                	echo '<label for="exampleInputEmail1">Patente registrada</label>';
				                	echo '<select name="idcamion" onChange="switchCamionero(this.value)" data-parsley-required="true" class="form-control validation" data-parsley-required="true">';
				                	echo '<option value="-1">Seleccione Patente</option>';
				                		if(isset($camiones)){
						                    foreach($camiones as $s => $v):                      
						                        echo '<option value="'.$v["idcamion"].'"';
						                        if($topic != "search" && $topic == $v) echo 'selected';
						                        echo '>';
						                        echo $v["patente"];
						                        echo '</option>';
						                    endforeach;
						                }                               
				    				echo '</select>';
				                	echo '</div>';

				                	echo '<div class="form-group">';
				                	echo '<label for="exampleInputEmail1">Región Actual</label>';
				                	echo '<select name="region_origen" id="region_origen" data-parsley-required="true" class="form-control validation" onchange="ciudad_region(this.value,\'ciudad_ubicacion\');">';
				                	echo '<option value="-1" cod="-1">Seleccione Región</option>';
			                            if(isset($regiones)){
				                             foreach($regiones as $s => $v):                      
				                                echo '<option value="'.$v["idregion"].'" cod="'.$v["idregion"].'"';
				                                if($topic == $v) echo 'selected';
				                                echo '>';
				                                echo $v["nombre"];
				                                echo '</option>';
				                            
				                            endforeach;
				                        }                               
				    				echo '</select>';
				                	echo '</div>';

				                	
									echo '<div class="form-group">';
				                	echo '<label for="exampleInputEmail1">Región de Destino Preferente</label>';
				                	echo '<select name="region_destino" id="region_destino" data-parsley-required="true" class="form-control" onchange="ciudad_region(this.value,\'ciudad_destino\');">';
				                	echo '<option value="-1" cod="-1">Todas las regiones</option>';
			                            if(isset($regiones)){
			                            	//print_r($regiones);
				                             foreach($regiones as $s => $v):                      
				                                echo '<option value="'.$v["idregion"].'" cod="'.$v["idregion"].'"';
				                                if($topic == $v) echo 'selected';
				                                echo '>';
				                                echo $v["nombre"];
				                                echo '</option>';
				                            
				                            endforeach;
				                        }                                 
				    				echo '</select>';
				                	echo '</div>';
								echo '</div>';
					            echo '<div class="col-md-6">';
									echo '<div class="form-group">';
									echo '<label for="exampleInputEmail1">Fecha disponibilidad</label>';
									echo '<input name="fecha_disponibilidad" data-parsley-required="true" id="datepicker" 
										pattern="^(\d{4}/\d{2}/\d{2})$"
										class="form-control validation" placeholder="YYYY/MM/DD" type="text">';
									echo '</div>';
									echo '<div class="form-group">';
									echo '<label for="exampleInputEmail1">Ciudad Actual</label>';
									echo '<select name="ciudad_ubicacion" id="ciudad_ubicacion" disabled data-parsley-required="true" 
										onchange="get_distancia();"
										class="form-control validation">';
									echo '<option value="-1">Seleccione Ubicación</option>';
			                            if(isset($ciudades)){
				                             foreach($ciudades as $s => $v):                      
				                                echo '<option value="'.$v["idciudad"].'" cod="'.$v["idregion_fk"].'"';
				                                if($topic != "search" && $topic == $v) echo 'selected';
				                                echo '>';
				                                echo $v["nombre"];
				                                echo '</option>';
				                            endforeach;
				                        }                               
			                		echo '</select>';
									echo '</div>';
									echo '<div class="form-group">';
									echo '<label for="exampleInputEmail1">Destino Preferente</label>';
									echo '<select name="ciudad_destino" id="ciudad_destino" disabled class="form-control" 
										onchange="get_distancia();" 
										data-parsley-required="true">';   
									echo '<option value="-1">Todas las ciudades</option>';
			                            if(isset($ciudades)){
				                             foreach($ciudades as $s => $v):                      
				                                echo '<option value="'.$v["idciudad"].'" cod="'.$v["idregion_fk"].'"';
				                                if($topic != "search" && $topic == $v) echo 'selected';
				                                echo '>';
				                                echo $v["nombre"];
				                                echo '</option>';
				                            
				                            endforeach;
				                        }                               
		                			echo '</select>';
									echo '</div>';
									
									echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Kilometros Aproximados de Distancia</label>';
                                    echo '<input name="distancia" data-parsley-required="true" class="form-control" type="text"/>';
                                    echo '</div>';

								echo '</div>';
								//echo '<div class="col-md-12" style="padding-left: 0;">';
								//echo '<label for="exampleInputEmail1">Kilometros Aproximados de Distancia</label>';
								//echo '<input name="distancia" data-parsley-required="true" class="form-control"  value="" placeholder="" type="text">';
								//echo '</div>';

								echo '<div class="col-md-12" style="padding-left: 0;">';
								echo '<label for="exampleInputEmail1">Detalles</label>';
				                echo form_textarea(
									array(
										'name'        => 'detalles',								
										'maxlength'   => '200',
										'rows' 		  => '5',
										'cols' 		  => '50',
										'class'       => 'form-control',
										//'size'        => '35',
										'style'		  => 'resize: vertical'
									)
									);
				                echo '</div>';
				                ?>
				                <?php 
									echo '<div class="col-md-12" style="margin-top:12px; padding-left: 0;">';
									echo '<button type="submit" class="btn btn-accent inline-block" style="width:100%; font-weight:bold; color:#fff; background: rgb(246, 168, 33) !important; padding: 8px;">Crear Anuncio</button>';
									echo '</div>';
									echo form_close();
								?>
								<div class="col-md-12" style="margin-top:0px; padding-left: 0;">
									<p class="m-t-xs footer-text">
			                        	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
			                    	</p>
			                    </div>
	                        </div>
	                    </div>
	                </div>

	                <div class="col-md-3">
	                    <div class="panel panel-filled">
	                        <div class="panel-body">
	                        	<div class="stats-title">
				                    <h4>Condiciones del Anuncio</h4>
				                </div>
				                <p>
				                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, <code>.form-control</code> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				                </p>
				                <p>
				                	Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				                </p>

				                <p>
				                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				                </p>
				            </div>
				        </div>
				    </div>
                </div>


<script type="text/javascript">
	
	function hideAll(){
        $("#ciudad_origen").find("option").each(function(){ $(this).hide(); });
        $("#ciudad_destino").find("option").each(function(){ $(this).hide(); });    
        $("#ciudad_origen").find("option[cod='-1']").show();   
        $("#ciudad_destino").find("option[cod='-1']").show();   
    }

        
    $(function(){
        hideAll();
    });
    
    //Listar las ciudades por region escogida
    function ciudad_region(value, ciudad)
        {   
            
                $("#" + ciudad).prop("disabled",false);
                if(value.toString()  == "-1"){
                    
                    $("#" + ciudad).find("option").each(function(){
                        $(this).hide();
                    });

                }else{
                    $("#" + ciudad).find("option").each(function(){
                        $(this).hide();
                    });
                                     
                    $("#" + ciudad).find("option[cod='-1']").show();                    
                    $("#" + ciudad).find("option[cod='"+value+"']").each(function(){
                        //alert($(this).text());
                        $(this).show();
                    });
                   
                }
                $("#" + ciudad).find("option[cod='-1']").show();   
                $("#"+ciudad).find("option[value='-1']").prop('selected',true);
                
            
        }
        
        //Listar la region por ciudad escogida
        /*
        function region_ciudad(obj, ciudad, region)
        {   
          
            var val = $("#"+ciudad).find("option:selected");
            var cod = $(val).attr("cod");           
            $("#"+region).find("option[value='"+cod+"']").prop('selected',true);

            
        }
        */
        
	

		
	function get_distancia(){

			var val1 = $("#ciudad_ubicacion").find("option:selected").val();
			var val2 = $("#ciudad_destino").find("option:selected").val();
			if($.isNumeric( val1 ) && $.isNumeric( val2 ) && val1 != -1 && val2 != -1){
				$.ajax({                                      
			      url: window.location.pathname+'?Transportista/get_distancia/'+val1+'/'+val2,                  //the script to call to get data          
			      data: "",                        //you can insert url argumnets here to pass to api.php
			                                       //for example "id=5&parent=6"
			      dataType: 'json',                //data format      
			      success: function(data)          //on recieve of reply
			      {
			        
			        //--------------------------------------------------------------------
			        // 3) Update html content
			        //--------------------------------------------------------------------
			           console.log(data);
			          var dist = data.distancia;
			           if (dist == -1) dist = 'No disponible';
			          $(document).find("input[name='distancia']").val(dist);
			        
			            //$.each( data, function( id, val ) {
			              //items.push( "<li id='" + id + "'>" + data[id]['Muser']  +"</li>" );
			            //});
			          
			            //$('#output').html(items.join("")); //Set output element html  
			        //}
			        
			        //recommend reading up on jquery selectors they are awesome 
			        // http://api.jquery.com/category/selectors/
			      } 
			    });
			}
			 
		}
</script>



	
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
		function limpiarCamionero(){
			$("#nombre_chofer").text("");
			$("#apellido_chofer").text("");
			$("#celular_chofer").text("");

			$("#tipo_camion").text("");
			$("#toneladas").text("");			
			$("#empresa_nropoliza").text("");
		}
		function switchCamionero(idrow){

			
			limpiarCamionero();
			if(idrow== -1){
				$("#info_camionero").hide()	;
			}
			else $("#info_camionero").show();
			for (var i=0;i<datos_tabla.length;i++){
				if(datos_tabla[i].idcamion == idrow){
					$("#nombre_chofer").text(datos_tabla[i].nombre);
					$("#apellido_chofer").text(datos_tabla[i].apellido);
					$("#celular_chofer").text(datos_tabla[i].celular);

					$("#tipo_camion").text(datos_tabla[i].tipo);
					$("#toneladas").text(datos_tabla[i].toneladas + " [Tn]");
					var emp = (datos_tabla[i].seg_empresa == "")? "No": "Si";
					var num_poliza = (datos_tabla[i].seg_num_poliza == "")? "No": "Si";
					$("#empresa_nropoliza").text(emp + " / " + num_poliza);
					
				}
			}
			//$("#info_camionero").find("option:contains('"+datos_tabla[i].patente+"')").prop("selected", true);   	
		}
				   
	</script>
