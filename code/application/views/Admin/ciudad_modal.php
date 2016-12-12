			<?php 
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/ciudades/add";
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
                        <input type="text" data-parsley-required="true" id="latitud"  name="latitud" class="form-control" placeholder="Latitud(s)..." autocomplete="off" required>
                    </div>                   
                </div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" id="longitud" name="longitud" class="form-control" placeholder="Longitud..." autocomplete="off" required>
                    </div>                   
                </div>
                <?php
                echo '<select name="region" id="region" data-parsley-required="true">';   
                            echo '<option value="-1" cod="-1">Seleccione Región</option>';
                            if(isset($regiones) && $regiones != false){
                                 foreach($regiones as $s => $v):                      
                                    echo '<option value="'.$v["idregion"].'" cod="'.$v["idregion"].'"';
                                    //if($topic == $v["idregion"]) echo 'selected';
                                    echo '>';
                                    echo $v["nombre"];
                                    echo '</option>';
                                
                                endforeach;
                            }                               
                echo '</select>';          
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                
                <input type="submit" value="Aplicar" class="btn btn-accent" />
            </div>
            <?php echo form_close();?>
       
