<?php if (isset($empresas) && $empresas != false){ ?>

 <script type="text/javascript">
 	datos_tabla = [];
   	datos_tabla = <?=json_encode($empresas)?>;

</script>

 <?php } ?>

 				<div class="row">
                    <div class="col-lg-10">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-users"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Empresas</h3>
                                <small>Listado de Empresas de Transporte Registrados en el Sistema.</small>
                            </div>
                        </div>
                    </div>
                	<div class="col-lg-2">
	                    <script type="text/javascript">
							title_add = '<?php echo $modal_title_add; ?>';
							title_text_add = '<?php echo $modal_title_text_add; ?>';
							title_upd = '<?php echo $modal_title_upd; ?>';
							title_text_upd = '<?php echo $modal_title_text_upd; ?>';
							nameform = 'tablename_cu';
              nameform2 = 'tablenameprf_cu';
						</script>

						<?php
						include 'modal_upper.php';
						include 'account_modal.php';
						include 'modal_lower.php';
						?>

            <?php
              include 'modal2_upper.php';
              include 'perfil_modal.php';
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
	                            Tabla de Registros de Usuarios
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
											<th>Empresa Transporte</th>
											<th>R.U.T</th>
                      <th>Giro</th>
                      <th>Pag. Web</th>
                      <th>Tel. Contacto</th>
											<th>Mail Contacto</th>
											<th>Total Equipos</th>
											<th>Opción</th>
										</tr>
										</thead>
										<tbody>
											<?php
												if(isset($empresas) && $empresas != false){
													$cont = 1;
													foreach($empresas as $s => $v){

														$id = $v["idempresa"];
														$uriupd = "?".$usr."/cuentas/upd/".$id."/commit";
														$uridel = "?".$usr."/cuentas/del/".$id;
														echo '<tr>';
														echo '<div class="container">';
														echo  '<td>'.($cont++).'</td>';
                            echo  '<td>'.$v["razon_social"].'</td>';
                            echo  '<td>'.$v["RUT"].'</td>';
                            echo  '<td>'.$v["giro"].'</td>';
                            echo  '<td>'.$v["pag_web"].'</td>';
                            echo  '<td>'.$v["fono_contacto"].'</td>';
                            echo  '<td>'.$v["mail_contacto"].'</td>';
                            echo  '<td>'.$v["total"].'</td>';



														echo  '<td>';

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


<!--
##############################
   MODAL ALERTA ELIMINAR
##############################
-->
<div id="myModalHabilitar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <strong><i class="glyphicon glyphicon-trash"></i> Eliminar un Registro:</strong></br>
                <p style="width:90%">Para habilitar el registro seleccionado, haga click en el boton Habilitar de la parte inferior de esta ventana.
                </p>
            </div>

            <form class="form-horizontal" method="post"  id ="habilitarFila" action="#">
	            <div class="modal-body">
	                <div class="alert alert-danger">
	                	<p><strong><i class="fa fa-warning"></i> ¡Cuidado!</strong></br>
	                    Está apunto de Habilitar una cuenta creada.
	                    Al ejecutar está acción está tomando la total responsabilidad del acto.</br></br>
					 </div>
	            </div>

	            <div class="modal-footer">
	                <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Habilitar</button>
	                <button type="button" class="btn btn-default" onClick="cleanHabilitado()"  data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
	            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php $usr = $this->session->userdata('login_type'); ?>

<script type="text/javascript">
    <?php echo 'usertype = "'.$usr.'";'; ?>
    function saveData(mode, name, uri, classnamevalidation, idclass){//mode = 1 add , 0 upd

        var text_callback = "#text_callback";
        var idShow = "#info_callback";
        var text_callback2 = ".text_callback";
        var idShow2 = ".info_callback";
        var datos = $(document).find("form[name='"+name+"']").serialize();
        //console.log(datos);

        if(validateFields(classnamevalidation,idclass)){
            $("#saveModalInput").prop("disabled",true);
            $.ajax({
                url: uri,                  //the script to call to get data
                data: datos,                        //you can insert url argumnets here to pass to api.php
                                               //for example "id=5&parent=6"
                method:"POST",
                dataType: 'json',                //data format
                success: function(data)          //on recieve of reply
                {

                //--------------------------------------------------------------------
                // 3) Update html content
                //--------------------------------------------------------------------
                    var num_ctg = data.num_catalogos;
                    var num_dsb = data.num_disabled_accs;
                    $(idShow).show();
                    $(idShow2).show();
                    $(text_callback).text(data.msg);
                    $(text_callback2).text(data.msg);
                    console.log(data.msg);
                    //console.log(data);
                    if(mode == 1){  clearFields();// limpia grilla si esta agregando
                    }
                    $(document).find("table[name='tablaGRID']").find("tbody").children().remove();
                    datos_tabla = data.tabla;
                    llenarTabla(data.tabla); //llena grilla
                    //$(document).find("input[name='distancia']").val(data);
                    $(".clear").first().focus();
                    $(idShow).hide(2000);
                    $(idShow2).hide(2000);
                    if (num_ctg > -1) $("#num_ctg").text(num_ctg);
                    if(num_dsb > -1) $("#num_dsb").text(num_dsb);
                    //$.each( data, function( id, val ) {
                      //items.push( "<li id='" + id + "'>" + data[id]['Muser']  +"</li>" );
                    //});

                    //$('#output').html(items.join("")); //Set output element html
                //}
                  $("#saveModalInput").prop("disabled",false);
                },
                fail:function(data) {
                    $(idShow).show();
                    $(text_callback).text(data.msg);
                    $(idShow2).show();
                    $(text_callback2).text(data.msg);
                    $("#saveModalInput").prop("disabled",false);
                }
            });

        }else{
            $(idShow).show();
             $(text_callback).text("Llene los campos solicitados");
             $(idShow2).show();
              $(text_callback2).text("Llene los campos solicitados");
             $("#saveModalInput").prop("enabled",true);
             $(idShow).hide(3000);
              $(idShow2).hide(3000);

        }
    }

    //console.log(datos_tabla);
    function llenarDatosPerfil(idrow){
			limpiarDatosPerfil();

			$.ajax({
				url: window.location.pathname+'?'+usrtype.toString()+'/verdatosPerfilJSON/'+idrow,                  //the script to call to get data
				data: "",                        //you can insert url argumnets here to pass to api.php
																				 //for example "id=5&parent=6"
				dataType: 'json',                //data format
				success: function(data)          //on recieve of reply
				{
					//--------------------------------------------------------------------
					// 3) Update html content
					//--------------------------------------------------------------------
					$("#name_legal_rep").val(data[0].nombre_representante_legal);
					$("#rut_legal_rep").val(data[0].rut_representante_legal);
					$("#business_name").val(data[0].razon_social);
					$("#rut").val(data[0].RUT);
					$("#line_of_business").val(data[0].giro);
					$("#contact_phone").val(data[0].fono_contacto);
					$("#city").val(data[0].ciudad);
          $("#phone").val(data[0].fono);
          $("#contact_city").val(data[0].ciudad_contacto);
          $("#address").val(data[0].direccion);
          $("#contact_mail").val(data[0].mail_contacto);

						console.log(data);
				}
			});


		}
    function limpiarDatosPerfil(){

      $("#name_legal_rep").val("");
      $("#rut_legal_rep").val("");
      $("#business_name").val("");
      $("#rut").val("");
      $("#line_of_business").val("");
      $("#contact_phone").val("");
      $("#city").val("");
      $("#phone").val("");
      $("#contact_city").val("");
      $("#address").val("");
      $("#contact_mail").val("");

    }

		console.log(datos_tabla);
		function llenarDatos(idrow){
			limpiarDatos();
			for (var i=0;i<datos_tabla.length;i++){
	   			//lert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);
	   			if(datos_tabla[i].id == idrow){

	   				$("#Muser").val(datos_tabla[i].Muser);
	   				$("#tipo").find("option[value='"+datos_tabla[i].usertype+"']").prop("selected", true);

	   			}
	   		}

		}
		function limpiarDatos(){
			$("#Muser").val("");
			$("#tipo").find("option[value='-1']").prop("selected", true);


		}
		function deleteRow(url){
			$("#eliminarFila").attr("action",url);
		}
		function cleanDelete(){
			$("#eliminarFila").attr("action","#");
		}

		function habilitar(url){
			$("#habilitarFila").attr("action",url);
		}

		function cleanHabilitado(){
			$("#habilitarFila").attr("action","#");
		}

	</script>
