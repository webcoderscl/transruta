<?php if (isset($tipocamiones) && $tipocamiones != false){ ?>

 <script type="text/javascript">
 	datos_tabla = [];
   	datos_tabla = <?=json_encode($tipocamiones)?>;

</script>

 <?php } ?>
<?php
	$usr = $this->session->userdata('login_type');
	$uriadd = "?".$usr."/tipocamion/add";
?>

<script type="text/javascript" src="<?php echo base_url()?>plupload/plupload/js/plupload.full.min.js"></script>
<!-- activate Spanish translation -->
<script type="text/javascript" src="<?php echo base_url()?>plupload/plupload/js/i18n/es.js"></script>

<script type="text/javascript">
	<?= 'title_add = "'.$modal_title_add.'";' ?>;
	<?= 'title_text_add = "'.$modal_title_text_add.'";' ?>;
	<?= 'title_upd = "'.$modal_title_upd.'";' ?>;
	<?= 'title_text_upd = "'.$modal_title_text_upd.'";' ?>;
	<?= 'nameform = "tablename_cu";' ?>;

</script>
 <script type="text/javascript">
	<?= 'usr = "'.$usr.'";' ?>
	<?= 'page_name = "'.$page_name.'";' ?>
	<?= 'base_url = "'.base_url().'";' ?>
</script>

 				<div class="row">
                    <div class="col-lg-10">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-rocket"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Tipos de Camiones</h3>
                                <small>Listado de Tipos de Vehículos Registrados en el Sistema.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">

						<button onClick=modalChange('<?php echo site_url().$uriadd ?>',nameform,title_add,title_text_add) class="btn btn-default btn-sm destacado-btn btn-right" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-plus" aria-hidden="true"></i> Agregar Tipo Camión
						</button>

						<?php
							include 'modal_upper.php';
							//if($option == "show"){
							include 'tipocamion_modal.php';
							//}
							include 'modal_lower.php';
						?>
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
	                            Tabla de Registros de Tipos de Camiones
	                        </div>
	                        <div class="panel-body">
	                            <p style="margin-bottom: 25px;">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
								</p>
								<div class="table-responsive">
									<table id="tableExample3" class="table table-striped table-hover">
	                                    <thead>
											<tr>
												<th style="width:5%">No.</th>
												<th>Tipo</th>
												<th>Marca</th>
												<th style="width:25%">Descripción</th>
												<!-- <th style="width:20%">Imagen</th> -->
												<th>Opción</th>
											</tr>
										</thead>
										<tbody>
											<?php

												if(isset($tipocamiones) && $tipocamiones != false){
													$cont = 1;
													foreach($tipocamiones as $s => $v){
														$id = $v["idtipocamion"];
														$uriupd = "?".$usr."/tipocamion/upd/".$id."/commit";
														$uridel = "?".$usr."/tipocamion/del/".$id;
														echo '<tr>';
														echo '<div class="container">';
														echo  '<td>'.($cont++).'</td>';
														echo  '<td>'.$v["tipo"].'</td>';
														echo  '<td>'.$v["marca"].'</td>';
														echo  '<td>'.$v["descripcion"].'</td>';
														//echo  '<td><img class="img-responsive" src="'.base_url().'/uploads/'.$v["file_name"].'"></img></td>';
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
								</div>
							</div>
						</div>
					</div>
				</div>


				<script type="text/javascript">
				// Custom example logic


				//mOxie.Mime.addMimeType("application/pdf,pdf");

				var uploader = new plupload.Uploader({
					runtimes : 'html5,flash,silverlight,html4',
					browse_button : 'pickfiles', // you can pass an id...
					container: document.getElementById('container'), // ... or DOM Element itself
					url : 'http://www.transruta.cl/code/?Admin/archivos/upload',
					//url: 'upload.php',
					flash_swf_url : 'http://www.transruta.cl/code/plupload/plupload/js/Moxie.swf',
					silverlight_xap_url : 'http://www.transruta.cl/code/plupload/plupload/js/Moxie.xap',
					required_features: 'chunks',
					chunk_size : '1mb',
					multi_selection: false,
					filters : {
						max_file_size : '15mb',
						mime_types: [
							{title : "Image files", extensions : "jpg,png,jpeg"}
						]
					},

					init: {
						PostInit: function() {
							document.getElementById('filelist').innerHTML = '';

							document.getElementById('uploadfiles').onclick = function() {

								$(".selector_files").each(function(){
									$(this).prop("disabled",true);
								});

								$(".remove").remove();
								uploader.start();
								return false;
							};
						},



						UploadProgress: function(up, file) {
							console.log(up);
							console.log(file);
							$("#loader").show();
							var html_prct    ='<div class="progress" style="80%">';
							html_prct 	 +='    <div class="progress-bar" '
								html_prct 	 +=' role="progressbar" aria-valuenow="40" aria-valuemin="0" ';
								html_prct    +=' aria-valuemax="100"';
							  	html_prct    +=' style="width:'+file.percent+'%">';
							    html_prct    += '<span class="sr-only" >'+file.percent+'% Complete</span>';
						  	html_prct    +='   </div>';
							html_prct    +='</div>';
							document.getElementById("loader_row"+file.id).innerHTML = html_prct;
							document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
						},
						UploadComplete: function(up, file)
						{
							console.log("file");
							console.log(file);
							console.log(file[0]);
							$("#loader").hide();
							$(".selector_files").each(function(){
								$(this).prop("disabled",false);
							});

							$("#uploadFile").prop("onsubmit",true);
							var name = file[0].name;
							alert("Finalizado");
							//alert("percent: "+file[0].percent + " name: "+file[0].name + " status: "+file[0].status + " loaded: "+file[0].loaded + " size: "+file[0].size);
							$("#uploadFile").submit();
						},

						Error: function(up, err) {
							$(".selector_files").each(function(){
								$(this).prop("disabled",false);
							});

							document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
						}
					}
				});


				uploader.bind("BeforeUpload", function(up, file) {
					var nombre = file.name;
					//alert(nombre);
					var nombre_ext = nombre.split(".");
					//var category = $("#category").find("option:selected").text();
					//file.name = category + "." + nombre_ext[1];
					//up.addFile(file, nombre+"."+nombre_ext[1]);
				});



				uploader.bind('FilesAdded', function(up, files) {
				  //console.log (up);
				  //console.log (files);
				  $.each(files, function(i, file) {
				  	var name = file.name;
				  	var nombre_ext = name.split(".");
						var nombre =	$("#tipo").val();
						nombre = nombre.replace(/\s+/g,"\_");
						var file_ext = nombre_ext[1];
						file.name = nombre + "."+file_ext;
						$("#size_file").val(file.size);
						$("#file_name").val(file.name);
				    $('#filelist').append(
				      '<div id="' + file.id + '">' +
				      '<div class="row">'+
				      '<div class="col-sm-5">'+
				       nombre+'.'+file_ext+ ' (' + plupload.formatSize(file.size) + ') ' +
				      '<a href="" class="remove btn error btn-warning">X</a></div>'+
				      '<div id="loader_row'+file.id+'" class="col-sm-5"></div> <b></b> </div></div>');


				    $('#uploadfiles').css('display', 'initial');
				    $('#filelist').append('<br/>');

				    $('#' + file.id + ' a.remove').first().click(function(e) {
				      e.preventDefault();
				      up.removeFile(file);
				      $('#' + file.id).next("br").remove();
				      $('#' + file.id).remove();
				      if (up.files.length == 0) {
				        $('#uploadfiles').css('display', 'none');
				      }
				    });

				  });
				});

				// When the file is uploaded, parse the response JSON and show that URL.
				//
				uploader.bind('FileUploaded', function(up, file, response){
				  var json_response = JSON.parse( response.response )
				  if (json_response.redirect) {
				    window.location = json_response.redirect;
				  }
				  else {
				    $("#"+file.id).addClass("uploaded").html('<strong>'+file.name+'</strong>');
				    $("#"+file.id).append(' <span class="label success">Archivo subido exitosamente!</span><br/><br/>');

				    if (json_response.meta) {
				      $("#"+file.id).append('<div class="meta"></div>');
				      $('div.meta').append('<ul></ul>');
				      $('div.meta ul:only-child').append('<li>Link: <a href="'+json_response.url+'" target="_blank">'+file.name+'</a></li>');
				      $('div.meta ul:only-child').append('<li>Server: '+json_response.meta.server+'</li>');
				      $('div.meta ul:only-child').append('<li>Content Length: '+json_response.meta.content_length+' bytes</li>');
				      $('div.meta ul:only-child').append('<li>Content Type: '+json_response.meta.content_type+'</li>');
				      $('div.meta ul:only-child').append('<li>Last Updated: '+json_response.meta.last_updated+'</li>');
				    }

				  }
				});


				uploader.init();

				</script>

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
	   			if(datos_tabla[i].idtipocamion == idrow){

	   				//var fdisp = datos_tabla[i].fecha_disponibilidad;
	   				//var fdisp = (datos_tabla[i].fecha_disponibilidad).replace(/-/g,"/");
	   				//$(document).find("[name='fecha_disponibilidad']").val(fdisp);
	   				$(document).find("[name='marca']").val(datos_tabla[i].marca);
	   				$(document).find("[name='descripcion']").val(datos_tabla[i].descripcion);
	   				//$("#idcamion").find("option[cod='"+datos_tabla[i].patente+"']").prop("selected", true);
	   				$("#tipo").val(datos_tabla[i].tipo);

	   			}
	   		}

		}
		function limpiarDatos(){
			$(document).find("[name='marca']").val("");
	   		$(document).find("[name='descripcion']").val("");
			$("#tipo").val("");


		}
		function deleteRow(url){
			$("#eliminarFila").attr("action",url);
		}
		function cleanDelete(){
			$("#eliminarFila").attr("action","#");
		}

	</script>
