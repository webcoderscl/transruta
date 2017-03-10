<?php if (isset($regiones) && $regiones != false){ ?>
				
 <script type="text/javascript">
 	datos_tabla = [];
   	datos_tabla = <?=json_encode($regiones)?>;

</script>

 <?php } ?>


<div class="main-container">
	
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?User/dashboard'); ?>"> DASHBOARD</a></li>
			<li>REGIONES</li>	 
			<?php if(isset($service)){

				echo '<li style="text-transform: uppercase;">SERVICE '.$service['servname'].'</li>';			
				$id = $service['id'];							
				$uridel = "?User/dismiss_service/".$id;
				$uriback = "?User/myservices";
				echo '<li style="float:right;"><a href="'.site_url($uriback).'"><i class="fa fa-backward"></i></a></li>';
				echo '<li style="float:right;"><a href="'.site_url($uridel).'"><i class="fa fa-minus"></i></a></li>';

				}
			?>
			<?php
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/regiones/add";
			?>
			<li style="float:right;"><a href="<?php echo site_url($uriadd);?>"><i class="fa fa-plus"></i></a></li>
		</ul>
		<div id="output">
			<script type="text/javascript">
				title_add = '<?php echo $modal_title_add; ?>';
				title_text_add = '<?php echo $modal_title_text_add; ?>';
				title_upd = '<?php echo $modal_title_upd; ?>';
				title_text_upd = '<?php echo $modal_title_text_upd; ?>';
				nameform = 'tablename_cu';
			</script>
			
			<button
			onClick=modalChange('<?php echo site_url().$uriadd ?>',nameform,title_add,title_text_add)  
			class="btn btn-default btn-sm destacado-btn" 
			style="margin-top:5px;" data-toggle="modal" data-target="#myModal">
			Agregar Región</button>
			
			 
			
			<?php 
			include 'modal_upper.php'; 
			//if($option == "show"){
			include 'region_modal.php'; 	
			//}
			include 'modal_lower.php'; 
			?>

		</div>
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
		<table class="table table-striped" id="dataTable1">
			
			<thead>
				<tr>
					<th style="width:5%">No.</th>									
					<th style="width:20%;">Nombre</th>
					<th style="width:10%;">Latitud</th>
					<th style="width:10%;">Longitud</th>					
					<th style="width:20%;">Opción</th>
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
							echo '<button onClick=modalChange("'.$uriupd.'",nameform,title_upd,title_text_upd,'.$id.') class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal" style="width:100%"><i class="fa fa-file-text-o" aria-hidden="true"></i> Editar</button>';
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
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
		
	</div><!-- ./padding-md -->
	
	

</div><!-- /main-container -->



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