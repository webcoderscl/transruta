			<?php 
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/cuentas/add";
			?>
			<?php echo form_open($uriadd,array('id' => 'formValidate1', 'name' => 'tablename_cu'));?>   

			<div class="modal-body">
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" id="Muser" name="Muser" class="form-control" placeholder="Email..." autocomplete="on" required >
                    </div>                   
                </div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="password" data-parsley-required="true" min="6" max="30" name="Mpassword" class="form-control" placeholder="Password..." data-length="6" autocomplete="off" required>
                    </div>                   
                </div>   

                <div class="row">
                    <div class="form-group m-bottom-md">                        
                        <select name="tipo" id="tipo" style="width:100%" data-parsley-required="true">  
                            <option value="-1">Seleccione Tipo Cuenta</option>
                            <option value="0">Administrador</option>
                            <option value="1">Transportista</option>
                            <option value="2">Generador de Carga</option>
                        </select>
                        
                    </div>                   
                </div>                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                
                <input type="submit" value="Aplicar" class="btn btn-accent" />
            </div>
            <?php echo form_close();?>
       
