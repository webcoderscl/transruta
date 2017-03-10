	<?php
		$usr = $this->session->userdata('login_type');
		$uriadd = "?".$usr."/equipos/add";
	?>
	<?php echo form_open($uriadd,array('id' => 'formValidate1','name' => 'equipo_cu'));?>

			<div class="modal-body">
                <div class="row">
					<div class="form-group m-bottom-md">
						<input style="text-transform:uppercase !important;" type="text" data-parsley-required="true" name="patente" class="form-control" placeholder="" autocomplete="off" maxlength="6"/>
						<span class="help-block small"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Ingrese patente del vehículo sin guiones. Máximo 6 caracteres.</span>
					</div>
				</div>
			 	<div class="row">
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true" name="anio" class="form-control" placeholder="Año" autocomplete="off"/>
					</div>
				</div>
				 <div class="row">
					<div class="form-group m-bottom-md">

                            <select class="form-control" name="tipo" data-parsley-required="true" onchange ="changeFilter(this.value)">
								<option value="-1">Escoja Tipo de Camión</option>
				                <?php if(isset($tipos_camion)){
				                     foreach($tipos_camion as $s => $v):
				                        echo '<option value="'.$v["tipo"].'"';
				                        if($tipo_camion == $v["tipo"]) echo 'selected';
				                        echo '>';
				                        echo $v["tipo"];
				                        echo '</option>';

				                    endforeach;
				                }
				                ?>
			    			</select>

					</div>
				</div>
				<div class="row">
					<div class="form-group m-bottom-md">
						<label for="exampleInputEmail1">Detalle Camión</label>
				                <?php echo form_textarea(
									array(
										'name'        => 'detalles',
										'maxlength'   => '200',
										'rows' 		  => '3',
										'cols' 		  => '50',
										'class'       => 'form-control',
										//'size'        => '35',
										'style'		  => 'resize: vertical'
									)
									);
								?>
		                </div>
				</div>
				<div class="row">
					<div class="form-group m-bottom-md">
						<input type="number" data-parsley-required="true" name="toneladas" class="form-control" placeholder="Toneladas" min="1" max="30" autocomplete="off"/>
						<span class="help-block small"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Ingrese capacidad máxima del vehículo.</span>
					</div>
				</div>
				<div class="row bs-example" style="margin-bottom:15px;">
            <div class="m-t-xs footer-text">
                <h3 style="font-size: 13px; font-weight: bold; text-transform:uppercase;">Doble Puente</h3>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </div>
        </div>
				<div class="row" style="background-color: #494b54; border: none; border-radius: 4px; margin-bottom: 15px;">
					<div style="padding: 8px ! important; margin-bottom: 0px;" class="form-group">
						<input type="hidden" id="doble_puente" name="doble_puente" value="0" />
						<input type="checkbox" id="doble_puente_chk" name="doble_puente_chk" onchange="changeVal(this);"> ¿Este vehículo cuenta con Doble Puente?</input>
					</div>
				</div>
				<div class="row bs-example" style="margin-bottom:15px;">
                    <div class="m-t-xs footer-text">
                        <h3 style="font-size: 13px; font-weight: bold; text-transform:uppercase;">Sistema de Posicionamiento Global (GPS)</h3>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                </div>
				<div class="row" style="background-color: #494b54; border: none; border-radius: 4px; margin-bottom: 15px;">
					<div style="padding: 8px ! important; margin-bottom: 0px;" class="form-group">
						<input type="checkbox" id="gps_chk" name="gps" value="GPS" onChange="set_visibility(this,1);"> ¿Este vehículo cuenta con GPS?</input>
					</div>
				</div>
				<div class="row" id="gps_text" style="display:none">
					<div class="form-group" >
						<input type="text" id="gps_empresa"  name="gps_empresa" class="form-control" placeholder="Empresa GPS" autocomplete="off"/>
					</div>
				</div>
				<div class="row bs-example" style="margin-bottom:15px;">
                    <div class="m-t-xs footer-text">
                        <h3 style="font-size: 13px; font-weight: bold; text-transform:uppercase;">Seguro Vehicular de Carga</h3>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                </div>
				<div class="row" style="background-color: #494b54; border: none; border-radius: 4px; margin-bottom: 15px;">
					<div style="padding: 8px ! important; margin-bottom: 0px;" class="form-group">
						<input type="checkbox" id="seg_carga_chk"  value="Seguro" onChange="set_visibility(this,2);"> ¿Este vehículo cuenta con Seguro de Carga?</input>
					</div>
				</div>
				<div class="row seg_carga_text" style="display:none">
					<div class="form-group"  >
						<input type="text" id="seg_carga_text" name="seg_no_poliza" class="form-control" placeholder="No. Póliza" autocomplete="off"/>
					</div>
					<div class="form-group"  >
						<label for="exampleInputEmail1">Fecha expiración</label>
						<input type="text"  name="seg_no_poliza_fecha_exp"
						id="datepicker" value ="2020/09/13"
						pattern="^(\d{4}/\d{2}/\d{2})$"
						class="form-control seg_no_poliza_fecha_exp"  placeholder="Fecha expiración" autocomplete="off"/>
					</div>
				</div>
				<div class="row seg_carga_text" style="display:none">
					<div class="form-group" >
						<input type="text" id="seg_empresa_text" name="seg_empresa" class="form-control" placeholder="Empresa Aseguradora" autocomplete="off"/>
					</div>
				</div>
				<div class="row">
					<div class="form-group m-bottom-md">
					<?php
					echo '<select name="chofer" class="form-control" style="width:100%" data-parsley-required="true">';
					echo '<option value="-1">Seleccione Chofer</option>';
		                if(isset($choferes)){
		                     foreach($choferes as $s => $v):
		                        echo '<option value="'.$v["idchofer"].'"';
		                        if($topic != "search" && $topic == $v) echo 'selected';
		                        echo '>';
		                        echo $v["nombre"]. " ".$v["apellido"];
		                        echo '</option>';

		                    endforeach;
		                }
	    				echo '</select>';
					?>
					</div>
				</div>
				<div class="row">
                    <div class="alert alert-warning">
                        <p><strong><i class="fa fa-warning"></i> ¡Recuerda!</strong><br>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco<br><br>
                        </p>
                    </div>
                </div>
			</div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-accent" style="width: 30%;"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Agregar Registro</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
            </div>
            <?php echo form_close();?>


		<script type="text/javascript">

			function set_visibility(value, id_div){

				var div = "gps_txt";
		        //alert("asdf");
				var div_txt = (id_div == 1)? "gps_text":((id_div == 2)?"seg_carga_text":"");
		        //alert(div_txt);
				//var input = $(document).find("input[id='"+div_txt+"']");

				var input = $("#"+div_txt);
				var input2 = $("."+div_txt);

				if(value.checked){

		            console.log($(input).val());
					$(input).show();$(input2).show();
				}
				else{
					if(id_div == 2){
						$("#seg_carga_text").val("");
						$(document).find("[name='seg_carga_fex_text']").val("");
						$("#seg_empresa_text").val("");
					}
					else{
						$("#gps_empresa").val("");
					}
					$(input).hide();$(input2).hide();
				}
			}

			function changeVal(obj)
			{
				if( $(obj).is(":checked") ) $("#doble_puente").val("1");
				else $("#doble_puente").val("0");
			}


		</script>
