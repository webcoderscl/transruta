
<div class="main-container">
	 
	<!-- <?php include 'page_info.php'; ?> -->
	<?php if (isset($flash_message)){		
		echo '<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs">'.$flash_message.'</small>';
	} ?>
	<!-- <?php if(isset($idserv)){ echo "<h1>".$idserv."</h1>"; } ?> -->
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>MODIFICAR</li>	 
			<li>EQUIPO</li>			
			<li style="float:right;color:green"><a href="<?php echo site_url('?User/vinculate_service_form');?>"><i class="fa fa-plus"></i></a></li>
			<li style="float:right;color:red"><a href="<?php echo site_url('?User/request_service_form');?>"><i class="fa fa-plus-square"></i></a></li>
			<li style="float:right;"><a href="javascript:window.print(); void 0;"><i class="fa fa-print"></i></a></li> 
		</ul>
		<?php 
			$usr = $this->session->userdata('login_type');
			$idequipo = "1";
			if(isset($equipo_datos)) $idequipo =  $equipo_datos[0]["idcamion"];
			$uriupd = "?".$usr."/editar_equipo/".$idequipo."/upd";
		?>
		<div class="login-brand text-center">	
			<div class="col-md-6">		
					
					<?php echo form_open($uriupd,array('id' => 'formValidate1'));?>   

						
						<div class="form-group m-bottom-md">
							<input type="text" data-parsley-required="true" name="patente" class="form-control" placeholder="Patente..." 
							value="<?php if(isset($equipo_datos)) echo $equipo_datos[0]["patente"]; ?>" 
							autocomplete="off">
						</div>
						<div class="form-group m-bottom-md">
							<input type="text" data-parsley-required="true" name="anio" class="form-control" placeholder="Año..." 
							value="<?php if(isset($equipo_datos)) echo $equipo_datos[0]["anio"]; ?>" 
							autocomplete="off">
						</div>
						<div class="form-group m-bottom-md">
							<input type="text" data-parsley-required="true" name="tipo" class="form-control" placeholder="Tipo..." 
							value="<?php if(isset($equipo_datos)) echo $equipo_datos[0]["tipo"]; ?>" 
							autocomplete="off">
						</div>
						<div class="form-group m-bottom-md">
							<input type="text" data-parsley-required="true" name="toneladas" class="form-control" placeholder="Toneladas..." 
							value="<?php if(isset($equipo_datos)) echo $equipo_datos[0]["toneladas"]; ?>" 
							autocomplete="off">
						</div>
						<div class="form-group m-bottom-md">
						<?php
						echo '<select name="chofer" style="width:100%" data-parsley-required="true">';   
						echo '<option value="-1">Seleccione Chofer</option>';
			                if(isset($choferes)){
			                     foreach($choferes as $s => $v):                      
			                        echo '<option value="'.$v["idchofer"].'"';
			                        if($equipo_datos[0]["idchofer_fk"] == $v["idchofer"]) echo 'selected';
			                        echo '>';
			                        echo $v["nombre"]. " ".$v["apellido"];
			                        echo '</option>';
			                    
			                    endforeach;
			                }                               
		    				echo '</select>';
						?>
						</div>
						<div class="m-top-md p-top-sm">
							<input type="submit" value="Modificar" class="btn btn-success block" style="width:100%; font-size:10px;"/>
						</div>
					<?php echo form_close();?>
				
			</div> <!-- col-md -->
			
		</div>	<!-- login-brand -->
	</div><!-- ./padding-md -->
</div><!-- /main-container -->
			
<script type="text/javascript">

	
function showValue(newValue)
{
	document.getElementById("range").innerHTML=newValue;
}
function changeFilter(newValue){
			
	//   "http://localhost:7070/Repo_RihProject/RihProject/index.php/";
	window.location= window.location.pathname + "?User/vinculate_service_form/"+newValue;
}

</script>
		
