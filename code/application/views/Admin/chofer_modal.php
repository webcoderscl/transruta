			<?php
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/choferes/add";
			?>
			<?php echo form_open($uriadd,array('id' => 'formValidate1', 'name' => 'tablename_cu'));?>

			<div class="modal-body">
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" id="nombre" name="nombre" class="form-control" placeholder="Nombre(s)..." autocomplete="off" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" id="apellido" name="apellido" class="form-control" placeholder="Apellido(s)..." autocomplete="off" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" id="rut" name="rut" class="form-control" placeholder="RUT..." autocomplete="off" required>
                    </div>
                </div>
                <div class="row">
                	<div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" id="celular" name="celular" class="form-control" placeholder="Celular..." autocomplete="off" required>
                    </div>
                </div>
                 
                 <div class="row">
                    <div class="form-group m-bottom-md">
                <?php
                echo '<select name="idusuario" id="idusuario" data-parsley-required="true">';
                            echo '<option value="-1" cod="-1">Seleccione Usuario</option>';
                            if(isset($idtransportistas) && $idtransportistas != false){
                                 foreach($idtransportistas as $s => $v):
                                    echo '<option value="'.$v["idtransportista"].'" cod="'.$v["idtransportista"].'"';
                                    //if($topic == $v["idregion"]) echo 'selected';
                                    echo '>';
                                    $dt = $this->Admin_model->get_name_by_id('account', $v["idaccount"], 'Muser');
                                    echo $dt;
                                    echo '</option>';

                                endforeach;
                            }
                echo '</select>';
                ?>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="submit" value="Aplicar" class="btn btn-accent" />
            </div>
            <?php echo form_close();?>
