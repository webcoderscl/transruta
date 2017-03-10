			<?php 
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/cargas/add";
			?>
			<?php echo form_open($uriadd,array('id' => 'formValidate1', 'name' => 'tablename_cu'));?>   

			<div class="modal-body">
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" id="tipo" name="tipo" class="form-control" placeholder="Tipo..." autocomplete="off" required>
                    </div>                   
                </div>
                            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                
                <input type="submit" value="Aplicar" class="btn btn-accent" />
            </div>
            <?php echo form_close();?>
       
