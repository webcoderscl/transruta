			<?php
                $usr = $this->session->userdata("login_type");
                $uriadd = "?".$usr."/".$page_name."/add";
             ?>
			

			<div class="modal-body">
                <div class="row">
                                <div class="stats-title">
                                    <h4>Datos del Anuncio</h4>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, <code>.form-control</code> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </p>
                                <div class="row">
                                <div class="col-md-12">
                                <?php
                                 
                                    $usr = $this->session->userdata('login_type');
                                    
                                    echo form_open("",array("name" => "misofertas_cu"));
                                ?>
                                <div class="col-md-6" style="padding-left: 0;">
                                    <?php
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Patente registrada</label>';
                                    echo '<select name="idcamion" data-parsley-required="true" class="form-control" data-parsley-required="true">';
                                    echo '<option value="-1">Seleccione Patente</option>';
                                        if(isset($camiones)){
                                            foreach($camiones as $s => $v):                      
                                                echo '<option value="'.$v["idcamion"].'" cod="'.$v["patente"].'"';
                                                if($topic != "search" && $topic == $v) echo 'selected';
                                                echo '>';
                                                echo $v["patente"];
                                                echo '</option>';
                                            endforeach;
                                        }                               
                                    echo '</select>';
                                    echo '</div>';

                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Región Actual</label>';
                                    echo '<select name="region_origen" id="region_origen" data-parsley-required="true" class="form-control" onchange="ciudad_region(this.value,\'ciudad_ubicacion\');">';
                                    echo '<option value="-1" cod="-1">Seleccione Región</option>';
                                        if(isset($regiones)){
                                             foreach($regiones as $s => $v):                      
                                                echo '<option value="'.$v["idregion"].'" cod="'.$v["idregion"].'"';
                                                if($topic == $v) echo 'selected';
                                                echo '>';
                                                echo $v["nombre"];
                                                echo '</option>';
                                            
                                            endforeach;
                                        }                               
                                    echo '</select>';
                                    echo '</div>';

                                    
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Región de Destino</label>';
                                    echo '<select name="region_destino" id="region_destino" data-parsley-required="true" class="form-control" onchange="ciudad_region(this.value,\'ciudad_destino\');">';
                                    echo '<option value="-1" cod="-1">Todas las regiones</option>';
                                        if(isset($regiones)){
                                            //print_r($regiones);
                                             foreach($regiones as $s => $v):                      
                                                echo '<option value="'.$v["idregion"].'" cod="'.$v["idregion"].'"';
                                                if($topic == $v) echo 'selected';
                                                echo '>';
                                                echo $v["nombre"];
                                                echo '</option>';
                                            
                                            endforeach;
                                        }                                 
                                    echo '</select>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="col-md-6">';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Fecha disponibilidad</label>';
                                    echo '<input name="fecha_disponibilidad" data-parsley-required="true" id="datepicker" 
                                        pattern="^(\d{4}/\d{2}/\d{2})$"
                                        class="form-control" placeholder="YYYY/MM/DD" type="text">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Ciudad Actual</label>';
                                    echo '<select name="ciudad_ubicacion" id="ciudad_ubicacion" data-parsley-required="true" 
                                        onchange="get_distancia();"
                                        class="form-control">';
                                    echo '<option value="-1">Seleccione Ubicación</option>';
                                        if(isset($ciudades)){
                                             foreach($ciudades as $s => $v):                      
                                                echo '<option value="'.$v["idciudad"].'" cod="'.$v["idregion_fk"].'"';
                                                if($topic != "search" && $topic == $v) echo 'selected';
                                                echo '>';
                                                echo $v["nombre"];
                                                echo '</option>';
                                            endforeach;
                                        }                               
                                    echo '</select>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Destino Preferente</label>';
                                    echo '<select name="ciudad_destino" id="ciudad_destino" class="form-control" 
                                        onchange="get_distancia();" 
                                        data-parsley-required="true">';   
                                    echo '<option value="-1">Todas las ciudades</option>';
                                        if(isset($ciudades)){
                                             foreach($ciudades as $s => $v):                      
                                                echo '<option value="'.$v["idciudad"].'" cod="'.$v["idregion_fk"].'"';
                                                if($topic != "search" && $topic == $v) echo 'selected';
                                                echo '>';
                                                echo $v["nombre"];
                                                echo '</option>';
                                            
                                            endforeach;
                                        }                               
                                    echo '</select>';
                                    echo '</div>';
                                    
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Kilometros Aproximados de Distancia</label>';
                                    echo '<input name="distancia" data-parsley-required="true" class="form-control" type="text"/>';
                                    echo '</div>';

                                echo '</div>';
                                //echo '<div class="col-md-12" style="padding-left: 0;">';
                                //echo '<label for="exampleInputEmail1">Kilometros Aproximados de Distancia</label>';
                                //echo '<input name="distancia" data-parsley-required="true" class="form-control"  value="" placeholder="" type="text">';
                                //echo '</div>';

                                echo '<div class="col-md-12" style="padding-left: 0;">';
                                echo '<label for="exampleInputEmail1">Detalle</label>';
                                echo form_textarea(
                                    array(
                                        'name'        => 'detalles',                                
                                        'maxlength'   => '200',
                                        'rows'        => '5',
                                        'cols'        => '50',
                                        'class'       => 'form-control',
                                        //'size'      => '35',
                                        'style'       => 'resize: vertical'
                                    )
                                    );
                                echo '</div>';
                                ?>
                                <?php 
                                    echo '<div class="col-md-12" style="margin-top:12px; padding-left: 0;">';
                                    echo '<button type="submit" class="btn btn-accent inline-block" style="width:100%; color:#f6a821; padding: 8px;">Editar Anuncio</button>';
                                    echo '</div>';
                                    echo form_close();
                                ?>
                                </div> 
                                </div> 
                                <div class="row" style="padding: 0px 20px 0px 10px; margin-top: 15px;">
                                    <div class="alert alert-warning">
                                        <p><strong><i class="fa fa-warning"></i> ¡Recuerda!</strong><br>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco<br><br>
                                        </p>
                                    </div>      
                                </div>   
                </div>
            </div>
            <div class="modal-footer">           
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
            </div>
           


<script type="text/javascript">
    
    //Listar las ciudades por region escogida

    function hideAll(){
        $("#ciudad_ubicacion").find("option").each(function(){ $(this).hide(); });
        $("#ciudad_destino").find("option").each(function(){ $(this).hide(); });    
    }


    /*$("#ciudad_origen").click(function(){
        alert("asd");
        $("#ciudad_origen").find("option").each(function(){ $(this).hide(); });
    });
    $("#ciudad_destino").click(function(){
        alert("asd2");
        $("#ciudad_destino").find("option").each(function(){ $(this).hide(); });
    });
    */
        
    hideAll();
    
    
    function ciudad_region(value, ciudad)
        {   
            
                if(value  == "-1"){
                    
                    $("#" + ciudad).find("option").each(function(){
                        $(this).hide();
                    });

                }else{
                    $("#" + ciudad).find("option").each(function(){
                        $(this).hide();
                    });
                    $("#" + ciudad).find("option[cod='-1']").show();                    
                    $("#" + ciudad).find("option[cod='"+value+"']").each(function(){
                        //alert($(this).text());
                        $(this).show();

                    });
                }
                $("#"+ciudad).find("option[value='-1']").attr('selected','selected');
                
            
        }
        
        //Listar la region por ciudad escogida
        /*
        function region_ciudad(obj, ciudad, region)
        {   
            //alert(value);
            //value = obj.selectedIndex();
            //alert(value);
            var val = $("#"+ciudad).find("option:selected");
            var cod = $(val).attr("cod");           
            $("#"+region).find("option[value='"+cod+"']").attr('selected','selected');

            
        }
        */
        
    function get_distancia(){

            var val1 = $("#ciudad_ubicacion").find("option:selected").val();
            var val2 = $("#ciudad_destino").find("option:selected").val();
            if($.isNumeric( val1 ) && $.isNumeric( val2 ) && val1 != -1 && val2 != -1){
                $.ajax({                                      
                  url: window.location.pathname+'?Transportista/get_distancia/'+val1+'/'+val2,                  //the script to call to get data          
                  data: "",                        //you can insert url argumnets here to pass to api.php
                                                   //for example "id=5&parent=6"
                  dataType: 'json',                //data format      
                  success: function(data)          //on recieve of reply
                  {
                    
                    //--------------------------------------------------------------------
                    // 3) Update html content
                    //--------------------------------------------------------------------
                       console.log(data);
                       var dist = data.distancia;
                       if (dist == -1) dist = 'No disponible';
                      $(document).find("input[name='distancia']").val(dist);
                    
                        //$.each( data, function( id, val ) {
                          //items.push( "<li id='" + id + "'>" + data[id]['Muser']  +"</li>" );
                        //});
                      
                        //$('#output').html(items.join("")); //Set output element html  
                    //}
                    
                    //recommend reading up on jquery selectors they are awesome 
                    // http://api.jquery.com/category/selectors/
                  } 
                });
            }
             
        }
</script>


