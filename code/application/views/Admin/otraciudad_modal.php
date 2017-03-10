			<?php 
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/ciudades/add";
			?>
			<?php echo form_open($uriadd,array('id' => 'formValidate1', 'name' => 'otrotablename_cu'));?>   

			<div class="modal-body">
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <label>Ciudad Actual: </label> <br/>
                        <input type="text" data-parsley-required="true" id="nombre2" name="nombre2" class="form-control" placeholder="Nombre(s)..." autocomplete="off" required disabled >
                    </div>                   
                </div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <label>Ciudad Actual:</label> <br/>
                        <select name="idciudad2" id="idciudad2" data-parsley-required="true">
                            <option value="-1" cod="-1" class="cremove">Seleccione Ciudad</option>                                                        
                        </select>
                        
                    </div>                   
                </div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <label>Distancia entre estas [Km]: </label> <br/>
                        <input type="text" data-parsley-required="true" id="distancia" name="distancia" min="1" class="form-control" placeholder="Distancia aprox ..." autocomplete="off" required>
                    </div>                   
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                
                <input type="submit" value="Aplicar" class="btn btn-accent" />
            </div>
            <?php echo form_close();?>
       
