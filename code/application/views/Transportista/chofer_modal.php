			<?php
                $usr = $this->session->userdata("login_type");
                $uriadd = "?".$usr."/".$page_name."/add";
             ?>
			<?php echo form_open($uriadd,array('id' => 'formValidate1', 'name' => 'chofer_cu'));?>

			<div class="modal-body">
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="nombre" class="form-control" placeholder="Nombre" autocomplete="off" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="apellido" class="form-control" placeholder="Apellido(s)" autocomplete="off" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="rut" class="form-control" placeholder="RUT" pattern="(^[1-9]{1,3}(\.[0-9]{3}){0,2}-?[\dkK]$)|(^[1-9]\d{0,2})([0-9]{0,12}-?[\dKk]$)" autocomplete="off" required>
                        <span class="help-block small"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Ingresar RUT sin puntos. Ejemplo: 99999999-9</span>
                    </div>
                </div>
                <div class="row">
                	<div class="form-group m-bottom-md">
                        <input type="text" style="width: 17%;display: inline-block;" data-parsley-required="true" name="" class="form-control" placeholder="+569" autocomplete="on" disabled="disabled" value="+569" />
                        <input type="text" style="width: 82%; display: inline-block;" data-parsley-required="true" name="celular" min="6" max="9" class="form-control" placeholder="Celular Personal" autocomplete="off" required maxlength="10">
                        <span class="help-block small"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Ingresar Teléfono Celular (9 digitos) sin espacios. Ejemplo: 999999999</span>
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
