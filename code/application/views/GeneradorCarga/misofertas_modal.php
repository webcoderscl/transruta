            <?php
                $usr = $this->session->userdata("login_type");
                $uriadd = "?".$usr."/".$page_name."/upd";
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
                                    echo '<label for="exampleInputEmail1">Región de Origen</label>';
                                    echo '<select name="region_origen" id="region_origen" data-parsley-required="true" class="form-control" onchange ="ciudad_region(this.value,\'ciudad_origen\');">';
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
                                    echo '<label for="exampleInputEmail1">Dirección Específica de Origen</label>';
                                    echo '<input name="direccion_origen" data-parsley-required="true" class="form-control" placeholder="Calle/No./Población" type="text">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Región de Destino</label>';
                                    echo '<select name="region_destino" id="region_destino" data-parsley-required="true" class="form-control" onchange="ciudad_region(this.value,\'ciudad_destino\');">';
                                    echo '<option value="-1" cod="-1">Seleccione Región</option>';
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
                                    echo '<div class="form-group" style="margin-bottom:50px;">';
                                    echo '<label for="exampleInputEmail1">Dirección Específica de Destino</label>';
                                    echo '<input name="direccion_destino" data-parsley-required="true" class="form-control" placeholder="Calle/No./Población" type="text">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Fecha de Carga</label>';
                                    echo '<input name="fecha_carga" 
                                           id="datepicker" 
                                        pattern="^(\d{4}/\d{2}/\d{2})$"
                                        data-parsley-required="true" class="form-control" placeholder="(AAAA/MM/DD)" type="text">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Cantidad (Tn. Netas)</label>';
                                    echo '<input name="cantidad_carga" data-parsley-required="true" class="form-control" placeholder="" type="number" min="1" max="100">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Tipo de Camión</label>';
                                    echo '<select name="tipo_camion" id="tipo_camion" data-parsley-required="true" class="form-control" onchange="changeFilter(this.value)">';
                                    echo '<option value="-1" cod="-1">Seleccione Tipo de Camión</option>';
                                        if(isset($tipos_camion)){
                                        foreach($tipos_camion as $s => $v):                      
                                            echo '<option value="'.$v["tipo"].'" cod="'.$v["tipo"].'"';
                                            if($topic == $v["tipo"]) echo 'selected';
                                            echo '>';
                                            echo $v["tipo"];
                                            echo '</option>';
                                        
                                        endforeach;
                                    }                                  
                                    echo '</select>';
                                    echo '</div>';
                                    
                                    /*echo '<div class="form-group">';
                                         echo '<label for="exampleInputEmail1">Tipo de Oferta</label> <br>';
                                        echo '<input type="radio" name="esLicitacion" value="0" checked> Simple (1 viaje)<br>';
                                        echo '<input type="radio" name="esLicitacion" value="1"> Por Licitación'; 
                                    echo '</div>';
                                    */
                                    ?>
                                </div>
                                <div class="col-md-6" style="padding-left: 0;">
                                    <?php
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Ciudad de Origen</label>';
                                    echo '<select name="ciudad_origen" id="ciudad_origen" data-parsley-required="true" class="form-control"
                                         onchange="get_distancia();"    
                                     >';
                                    echo '<option value="-1" cod="-1">Seleccione Ciudad</option>';
                                        if(isset($ciudades)){
                                             foreach($ciudades as $s => $v):                      
                                                echo '<option value="'.$v["idciudad"].'" cod="'.$v["idregion_fk"].'"';
                                                if($topic == $v) echo 'selected';
                                                echo '>';
                                                echo $v["nombre"];
                                                echo '</option>';
                                            
                                            endforeach;
                                        }                                  
                                    echo '</select>';
                                    echo '</div>';
                                    echo '<div style="height:70px; width:100%;"></div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Ciudad de Destino</label>';
                                    echo '<select name="ciudad_destino" id="ciudad_destino" data-parsley-required="true" class="form-control"
                                         onchange="get_distancia();"                                     
                                         >';
                                    echo '<option value="-1" cod="-1">Seleccione Ciudad</option>';
                                        if(isset($ciudades)){
                                         foreach($ciudades as $s => $v):                      
                                            echo '<option value="'.$v["idciudad"].'" cod="'.$v["idregion_fk"].'"';
                                            if($topic == $v) echo 'selected';
                                            echo '>';
                                            echo $v["nombre"];
                                            echo '</option>';
                                        
                                        endforeach;
                                    }                                  
                                    echo '</select>';
                                    echo '</div>';
                                    echo '<div class="form-group" style="margin-bottom:50px;">';
                                    echo '<label for="exampleInputEmail1">Kilometros Aproximados de Distancia</label>';
                                    echo '<input name="distancia" data-parsley-required="true" class="form-control"  value="" placeholder="" type="text">';

                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Fecha de Entrega</label>';
                                    echo '<input name="fecha_descarga" 
                                            id="datepicker_2" 
                                            pattern="^(\d{4}/\d{2}/\d{2})$" 
                                    data-parsley-required="true" class="form-control" placeholder="(AAAA/MM/DD)" type="text">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Tipo de Carga</label>';
                                    echo '<select name="tipo_carga" id="tipo_carga" data-parsley-required="true" class="form-control" onchange="changeFilter(this.value)">';
                                    echo '<option value="-1">Seleccione Tipo de Carga</option>';
                                        if(isset($tipos_carga)){
                                             foreach($tipos_carga as $s => $v):                      
                                                echo '<option value="'.$v["tipo"].'" cod="'.$v["tipo"].'"';
                                                if($topic == $v["tipo"]) echo 'selected';
                                                echo '>';
                                                echo $v["tipo"];
                                                echo '</option>';
                                            
                                            endforeach;
                                        }                                 
                                    echo '</select>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Precio</label>';
                                    echo '<input name="precio" data-parsley-required="true" class="form-control" placeholder="$CLP" type="text">';
                                    echo '</div>';

                                /*echo '<label for="exampleInputEmail1">No. Viajes</label>';
                                    echo '<input name="num_viajes" data-parsley-required="true" class="form-control" placeholder="Viajes" type="number" min="1" max="20" value="1">';
                                    echo '</div>';                                  
                                */
                                ?>
                                </div>

                                <div class="col-md-12" style="padding-left: 0;">
                                    <?php
                                        echo '<label for="exampleInputEmail1">Detalles</label>';
                                        echo form_textarea(
                                            array(
                                                'name'        => 'detalle',                             
                                                'maxlength'   => '200',
                                                'rows'        => '5',
                                                'cols'        => '50',
                                                'class'       => 'form-control',
                                                //'size'        => '35',
                                                'style'       => 'resize: vertical'
                                            )
                                            );
                                    ?>
                                </div>
                        
                                <div class="col-md-12" style="margin-top:12px; padding-left: 0;">
                                    <button type="submit" class="btn btn-accent inline-block" style="width:100%; color:#f6a821; padding: 8px;">Crear Anuncio</button>
                                </div>

                                 <?php 
                                    echo form_close();
                                ?>
                                <div class="col-md-12" style="margin-top:0px; padding-left: 0;">
                                    <p class="m-t-xs footer-text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    </p>
                                </div>
                        </div>
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
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
            </div>
           

<script type="text/javascript">
    
    //Listar las ciudades por region escogida

    function hideAll(){
        $("#ciudad_origen").find("option").each(function(){ $(this).hide(); });
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

            var val1 = $("#ciudad_origen").find("option:selected").val();
            var val2 = $("#ciudad_destino").find("option:selected").val();
            if($.isNumeric( val1 ) && $.isNumeric( val2 ) && val1 != -1 && val2 != -1){
                $.ajax({                                      
                  url: window.location.pathname+'?GeneradorCarga/get_distancia/'+val1+'/'+val2,                  //the script to call to get data          
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