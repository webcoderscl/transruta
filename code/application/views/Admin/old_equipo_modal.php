	<?php 
		$usr = $this->session->userdata('login_type');
		$uriadd = "?".$usr."/equipos/add";
	?>
	<?php echo form_open($uriadd,array('id' => 'formValidate1','name' => 'tablename_cu'));?>   

			<div class="modal-body">
                <div class="row">			
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true" id="patente" name="patente" class="form-control" placeholder="Patente..." autocomplete="off">
					</div>
				</div>
			 	<div class="row">	
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true" id="anio"  name="anio" class="form-control" placeholder="Año..." autocomplete="off">
					</div>
				</div>
				 <div class="row">	
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true" id="tipo" name="tipo" class="form-control" placeholder="Tipo..." autocomplete="off">
					</div>
				</div>
				 <div class="row">	
					<div class="form-group m-bottom-md">
						<input type="number" data-parsley-required="true" id="toneladas" name="toneladas" class="form-control" placeholder="Toneladas..." min="1" max="30" autocomplete="off">
					</div>
				 </div>
				 <div class="row">	
					<div class="form-group m-bottom-md">
					<?php
					echo '<select name="chofer" id="chofer" style="width:100%" data-parsley-required="true">';   
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
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                
                <input type="submit" value="Aplicar" class="btn btn-accent" />
            </div>
            <?php echo form_close();?>
			