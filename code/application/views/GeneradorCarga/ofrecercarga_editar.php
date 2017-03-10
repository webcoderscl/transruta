<script type="text/javascript">
	 

</script>
<div class="main-container">
	
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?User/dashboard'); ?>"> DASHBOARD</a></li>
			<li>EDITAR OFERTA CARGA</li>	 
			<?php if(isset($service)){

				echo '<li style="text-transform: uppercase;">SERVICE '.$service['servname'].'</li>';			
				$id = $service['id'];							
				$uridel = "?User/dismiss_service/".$id;
				$uriback = "?User/myservices";
				echo '<li style="float:right;"><a href="'.site_url($uriback).'"><i class="fa fa-backward"></i></a></li>';
				echo '<li style="float:right;"><a href="'.site_url($uridel).'"><i class="fa fa-minus"></i></a></li>';

				}
			?>
			<li style="float:right;"><a href="<?php echo site_url('?User/vinculate_service_form');?>"><i class="fa fa-plus"></i></a></li>			
		</ul>
	
		<?php
			$usr = $this->session->userdata('login_type');
			$uri1 = "?".$usr."/misofertas_editar/".$idoferta."/upd";
			echo form_open($uri1);
			echo '<h2><b>DATOS DE LA SOLICITUD</b></h2>';
						?>
		<table class="table table-striped" id="dataTable1">
			
			<thead>
				<tr>
					<th style="width:16%"></th>									
					<th style="width:28%;"></th>					
					<th style="width:28%;"></th>				
					<th style="width:28%;"></th>				
					
				</tr>
			</thead>
			<tbody>
				<?php
					$uri1 = "?User/goservice/";
					$uri2 = "?User/goservice/";
						


					echo '<tr>';
					echo '<div class="container">';					
					echo  '<td>Origen:</td>';
					echo  '<td>';
					echo '<select name="region_origen"  style="width:90%" id="region_origen" data-parsley-required="true" onchange ="ciudad_region(this.value,\'ciudad_origen\');">';
							echo '<option value="-1" cod="-1">Seleccione Región</option>';
                            if(isset($regiones)){
	                             foreach($regiones as $s => $v):                      
	                                echo '<option value="'.$v["idregion"].'" cod="'.$v["idregion"].'"';
	                                if($oferta[0]["origen_region"] == $v["idregion"]) echo 'selected';
	                                echo '>';
	                                echo $v["nombre"];
	                                echo '</option>';
	                            
	                            endforeach;
	                        }                               
                	echo '</select>';
					echo '</td>';
					echo  '<td>';
					echo '<select name="ciudad_origen"  style="width:90%" id="ciudad_origen" data-parsley-required="true" onChange="region_ciudad(this,\'ciudad_origen\',\'region_origen\');">';   
							echo '<option value="-1" cod="-1">Seleccione Ciudad</option>';
                            if(isset($ciudades)){
	                             foreach($ciudades as $s => $v):                      
	                                echo '<option value="'.$v["idciudad"].'" cod="'.$v["idregion_fk"].'"';
	                                if($oferta[0]["origen_ciudad"] == $v["idciudad"]) echo 'selected';
	                                echo '>';
	                                echo $v["nombre"];
	                                echo '</option>';
	                            
	                            endforeach;
	                        }                               
                	echo '</select>';
					echo  '<td>';
					echo '<input name="direccion_origen" data-parsley-required="true" class="input-sm" type="text"  placeholder="Direccion..."  style="width:90%" value="';
					if(isset($oferta)) echo $oferta[0]["origen_direccion"];
					echo '" />';
					echo '</td>';
					echo '</div>';
					echo '</tr>';


					echo '<tr>';
					echo '<div class="container">';					
					echo  '<td>Destino:</td>';
					echo  '<td>';
					echo '<select name="region_destino"  style="width:90%" id="region_destino" data-parsley-required="true" onChange="ciudad_region(this.value,\'ciudad_destino\');">';   
							echo '<option value="-1" cod="-1">Seleccione Región</option>';
                            if(isset($regiones)){
                            	//print_r($regiones);
	                             foreach($regiones as $s => $v):                      
	                                echo '<option value="'.$v["idregion"].'" cod="'.$v["idregion"].'"';
	                                if($oferta[0]["destino_region"] == $v["idregion"]) echo 'selected';
	                                echo '>';
	                                echo $v["nombre"];
	                                echo '</option>';
	                            
	                            endforeach;
	                        }                               
                	echo '</select>';
					echo '</td>';
					echo  '<td>';
					echo '<select name="ciudad_destino"  style="width:90%" id="ciudad_destino" data-parsley-required="true" onChange="region_ciudad(this.value,\'ciudad_destino\',\'region_destino\');">';   
							echo '<option value="-1" cod="-1">Seleccione Ciudad</option>';
                            if(isset($ciudades)){
	                             foreach($ciudades as $s => $v):                      
	                                echo '<option value="'.$v["idciudad"].'" cod="'.$v["idregion_fk"].'"';
	                                if($oferta[0]["destino_ciudad"] == $v["idciudad"]) echo 'selected';
	                                echo '>';
	                                echo $v["nombre"];
	                                echo '</option>';
	                            
	                            endforeach;
	                        }                               
                	echo '</select>';
					echo '</td>';
					echo  '<td>';
					echo '<input name="direccion_destino" data-parsley-required="true" class="input-sm" type="text" placeholder="Direccion..."  style="width:90%" value="';
					if(isset($oferta)) echo $oferta[0]["destino_direccion"];
					echo '" />';
					echo '</td>';
					echo '</div>';
					echo '</tr>';


					echo '<tr>';
					echo '<div class="container">';					
					echo  '<td>Km aprox:</td>';
					echo  '<td>';
					echo '<input name="distancia" data-parsley-required="true" style="width:90%" class="input-sm" type="text"  value="';
					if(isset($oferta)) echo $oferta[0]["distancia"];
					echo '"/>';
					echo '</td>';	
					echo  '<td></td>';
					echo  '<td></td>';
					echo '</div>';
					echo '</tr>';

					echo '<tr>';
					echo '<div class="container">';					
					echo  '<td>Fecha carga:</td>';
					echo  '<td>';
					echo '<input name="fecha_carga" data-parsley-required="true" class="input-sm" type="text" placeholder="Fecha (AAAA/MM/DD) ..." style="width:90%" value="';
					if(isset($oferta)) echo $oferta[0]["fecha_carga"];
					echo '" />';
					echo '</td>';
					echo  '<td></td>';
					echo  '<td></td>';
					echo '</div>';
					echo '</tr>';

					echo '<tr>';
					echo '<div class="container">';					
					echo  '<td>Fecha descarga:</td>';
					echo  '<td>';
					echo '<input name="fecha_descarga" data-parsley-required="true" class="input-sm" type="text"placeholder="Fecha (AAAA/MM/DD) ..." style="width:90%" value="';
					if(isset($oferta)) echo $oferta[0]["fecha_descarga"];
					echo '" />';
					echo '</td>';
					echo  '<td></td>';
					echo  '<td></td>';
					echo '</div>';
					echo '</tr>';


					echo '<tr>';
					echo '<div class="container">';					
					echo  '<td>Cantidad de cargas (Tn neto):</td>';
					echo  '<td>';
					echo '<input name="cantidad_carga" placeholder="Toneladas..." data-parsley-required="true" class="input-sm" type="number" min="1" max="30" value="';
					if(isset($oferta)) echo $oferta[0]["cantidad_carga"];
					echo '" step="1" style="width:90%" />';
					echo '</td>';
					echo  '<td>Tipo de carga:</td>';
					echo  '<td>';
					echo '<select name="tipo_carga" style="width:90%" data-parsley-required="true" onchange ="changeFilter(this.value)">';   
							echo '<option value="-1">Seleccione Tipo Carga</option>';
                            if(isset($tipos_carga)){
	                             foreach($tipos_carga as $s => $v):                      
	                                echo '<option value="'.$v["tipo"].'" cod="'.$v["tipo"].'"';
	                                if($oferta[0]["tipo_carga"] == $v["tipo"]) echo 'selected';
	                                echo '>';
	                                echo $v["tipo"];
	                                echo '</option>';
	                            
	                            endforeach;
	                        }                               
                	echo '</select>';
					echo '</td>';
					echo '</div>';
					echo '</tr>';


					echo '<tr>';
					echo '<div class="container">';					
					echo  '<td>Tipo de camión:</td>';
					echo  '<td>';
					echo '<select name="tipo_camion" style="width:90%" data-parsley-required="true" onchange ="changeFilter(this.value)">';   
							echo '<option value="-1" cod="-1">Seleccione Tipo Camión</option>';
                            if(isset($tipos_camion)){
	                             foreach($tipos_camion as $s => $v):                      
	                                echo '<option value="'.$v["tipo"].'" cod="'.$v["tipo"].'"';
	                                if($oferta[0]["tipo_camion"] == $v["tipo"]) echo 'selected';
	                                echo '>';
	                                echo $v["tipo"];
	                                echo '</option>';
	                            
	                            endforeach;
	                        }                               
                	echo '</select>';
					echo '</td>';
					echo  '<td></td>';
					echo  '<td></td>';
					echo '</div>';
					echo '</tr>';


					echo '<tr>';
					echo '<div class="container">';					
					echo  '<td>Precio:</td>';
					echo  '<td>';
					echo '<input name="precio" data-parsley-required="true" class="input-sm" type="text" placeholder="Precio..." style="width:90%" value="';
					if(isset($oferta)) echo $oferta[0]["precio"];
					echo '"/>';
					echo '</td>';
					echo  '<td></td>';
					echo  '<td></td>';
					echo '</div>';
					echo '</tr>';

					echo '<tr>';
					echo '<div class="container">';					
					echo  '<td>Detalles:</td>';
					echo  '<td>';
					echo form_textarea(
							array(
								'name'        => 'detalle',								
								'value'       => $oferta[0]["detalle"],
								'maxlength'   => '200',
								'rows' 		  => '5',
								'cols' 		  => '50',
								//'size'        => '35',
								'style'		  => 'resize: vertical'
							)
							);		
					echo '</td>';
					echo  '<td></td>';
					echo  '<td></td>';
					echo '</div>';
					echo '</tr>';


				?>
				
			</tbody>
			
		</table>
		
		<?php
			$uridel = "?User/dismiss_service/";
			echo form_open($uri1);
			echo '<h2><b>DATOS CONTACTO</b></h2>';		
			
			?>
		<table class="table table-striped" id="dataTable1">
			
			<thead>
				<tr>
					<th style="width:5%"></th>									
					<th style="width:30%;"></th>					
					<th style="width:40%;"></th>				
					<th style="width:40%;"></th>				
				</tr>
			</thead>
			<tbody>
				<?php
					$uri1 = "?User/goservice/";
					$uri2 = "?User/goservice/";
					
					echo '<tr>';
					echo '<div class="container">';
					echo  '<td>1</td>';
					echo  '<td>Empresa:</td>';
					echo  '<td>';
					echo '<input name="empresa" data-parsley-required="true" class="input-sm" type="text" value="';
					if(isset($datos_empresa)) echo $datos_empresa[0]["razon_social"];
					echo '" disabled="true" />';
					echo '</td>';
					echo '<td>';					
					echo '</td>';
					echo '</div>';
					echo '</tr>';

					echo '<tr>';
					echo '<div class="container">';
					echo  '<td>1</td>';
					echo  '<td>Nombre y Apellido:</td>';
					echo  '<td>';
					echo '<input name="nombre_apellido" data-parsley-required="true" class="input-sm" type="text"  value="';
					if(isset($datos_empresa)) echo $datos_empresa[0]["nombre_representante_legal"];
					echo '" disabled="true" />';
					echo '</td>';
					echo '<td>';					
					echo '</td>';
					echo '</div>';
					echo '</tr>';

					echo '<tr>';
					echo '<div class="container">';
					echo  '<td>1</td>';
					echo  '<td>Ciudad:</td>';
					echo  '<td>';
					echo '<input name="ciudad" data-parsley-required="true" class="input-sm" type="text"  value="';
					if(isset($datos_empresa)) echo $datos_empresa[0]["ciudad"];
					echo '" disabled="true" />';
					echo '</td>';
					echo '<td>';					
					echo '</td>';
					echo '</div>';
					echo '</tr>';

					
					echo '<tr>';
					echo '<div class="container">';
					echo  '<td>1</td>';
					echo  '<td>Teléfono:</td>';
					echo  '<td>';
					echo '<input name="fono" data-parsley-required="true" class="input-sm" type="text"  value="';
					if(isset($datos_empresa)) echo $datos_empresa[0]["fono"];
					echo '" disabled="true" />';
					echo '</td>';
					echo '<td>';					
					echo '</td>';
					echo '</div>';
					echo '</tr>';


					echo '<tr>';
					echo '<div class="container">';
					echo  '<td>1</td>';
					echo  '<td>Email:</td>';
					echo  '<td>';
					echo '<input name="email" data-parsley-required="true" class="input-sm" type="email"  value=""  />';
					echo '</td>';
					echo '<td>';					
					echo '</td>';
					echo '</div>';
					echo '</tr>';

				?>
				
			</tbody>
			
		</table>

		<?php
		echo '<div class="col-md-5">';
		echo "<button type='submit'  class='btn btn-success inline-block'>Aceptar</button>";
		echo '</div>';
		echo form_close();
		?>
	</div><!-- ./padding-md -->
	
	<script type="text/javascript">
	   
	   //Listar las ciudades por region escogida
		function ciudad_region(value, ciudad)
		{	
			
				if(value  == "-1"){
					
					$("#" + ciudad).find("option").each(function(){
						$(this).show();
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
				$("#"+ciudad).find("option[value='-1']").attr('selected','selected');
				
			
		}
		//Listar la region por ciudad escogida
		function region_ciudad(obj, ciudad, region)
		{	
			//alert(value);
			//value = obj.selectedIndex();
			//alert(value);
			var val = $("#"+ciudad).find("option:selected");
			var cod = $(val).attr("cod");			
			$("#"+region).find("option[value='"+cod+"']").attr('selected','selected');

			
		}


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
	
	

</div><!-- /main-container -->
