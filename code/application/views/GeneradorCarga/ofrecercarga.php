<?php if (isset($tipos_camion) && $tipos_camion != false){ ?>

 <script type="text/javascript">
 	datos_tipo_camion = [];
   	datos_tipo_camion = <?=json_encode($tipos_camion)?>;

</script>

<?php } ?>
                <div class="row" style="margin-top: -32px;">
                    <div class="col-lg-12">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="pe-7s-box1"></span>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Ofrecer Carga</h3>
                                <small>Publica una carga como disponible para un próximo trabajo.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-filled">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4 col-xs-6 text-center">
                                        <img src="<?php echo base_url();?>template/codemakers/images/step-example-1.png">
                                    </div>
                                    <div class="col-md-4 col-xs-6 text-center">
                                        <img src="<?php echo base_url();?>template/codemakers/images/step-example-2.png">
                                    </div>
                                    <div class="col-md-4 col-xs-6 text-center">
                                        <img src="<?php echo base_url();?>template/codemakers/images/step-example-3.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (isset($msg_alerta)){
                            echo '<p style="color:white; background-color:green"><strong><h2>'.$msg_alerta.'</h2></strong><p>';
                            echo '<script type="text/javascript">alert('.$msg_alerta.'); </script>';
                        }

                ?>

                <div class="row">
                    <div class="col-md-2 display-none-1120">
                        <div class="panel panel-b-accent" style="position:relative;height: 555px">
                            <div style="position: absolute;bottom: 0;left: 0;right: 0">
                            </div>
                            <div class="panel-body">
                                <div class="m-t-sm">
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-xs" style="color: #fff; border-color: #FFF; padding: 5px; margin-top: 5px;">Publicidad</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="panel panel-filled">
                            <div class="panel-body">
                                <div class="stats-title">
                                    <h4>Datos del Anuncio</h4>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, <code>.form-control</code> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </p>
                                <p style="color:red; background-color:green;display:none;" id="error_msg" ><strong>
                                    <h3><?php echo ERROR_VALIDACION; ?></h3></strong><p>
                                <?php
                                    $usr = $this->session->userdata('login_type');
                                    $uri1 = "?".$usr."/ofrecercarga/add";
                                    echo form_open($uri1, array("id" => "form_data","onsubmit"=>"return validateFields()"));
                                ?>
                                <div class="col-md-6" style="padding-left: 0;">
                                    <?php


                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Región de Origen</label>';
                                    echo '<select required name="region_origen" id="region_origen" data-parsley-required="true" class="form-control validation" onchange ="ciudad_region(this.value,\'ciudad_origen\');">';
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
                                    echo '<input required name="direccion_origen" data-parsley-required="true" class="form-control" placeholder="Calle/No./Población" type="text">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Región de Destino</label>';
                                    echo '<select name="region_destino" id="region_destino" data-parsley-required="true" class="form-control validation" onchange="ciudad_region(this.value,\'ciudad_destino\');">';
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
                                    echo '<input required name="direccion_destino" data-parsley-required="true" class="form-control" placeholder="Calle/No./Población" type="text">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Fecha de Carga</label>';
                                    echo '<input name="fecha_carga"
                                           id="datepicker_1"
                                        pattern="^(\d{4}/\d{2}/\d{2})$"
                                        data-parsley-required="true" class="form-control validation" placeholder="(AAAA/MM/DD)" type="text">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Cantidad (Tn. Netas)</label>';
                                    echo '<input name="cantidad_carga" pattern="^\d+$" data-parsley-required="true" class="form-control validation" placeholder="" type="number" min="1" max="100" required>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Tipo de Camión</label>';
                                    echo '<select name="tipo_camion" data-parsley-required="true" class="form-control" onchange="changeTipoCamion(this.value)">';
                                    echo '<option value="-1" cod="-1">Todo Tipo de Camión</option>';
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
                                    /*
                                    echo '<div class="form-group">';
                                        echo '<label for="exampleInputEmail1">Tipo de Oferta</label> <br>';
                                        echo '<input type="radio" name="esLicitacion" value="0" checked> Simple (1 viaje)<br>';
                                        echo '<input type="radio" name="esLicitacion" value="1"> Por Licitación';
                                    echo '</div>';
                                    */
                                echo '</div>';
                                echo '<div class="col-md-6">';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Ciudad de Origen</label>';
                                    echo '<select name="ciudad_origen" disabled id="ciudad_origen" data-parsley-required="true" class="form-control validation"
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
                                    echo '<select name="ciudad_destino" disabled id="ciudad_destino" data-parsley-required="true" class="form-control validation"
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
                                    data-parsley-required="true" class="form-control validation" placeholder="(AAAA/MM/DD)" type="text">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="exampleInputEmail1">Tipo de Carga</label>';
                                    echo '<select required name="tipo_carga" data-parsley-required="true" class="form-control validation" onchange="changeFilter(this.value)">';
                                    echo '<option value="">Seleccione Tipo de Carga</option>';
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
                                    echo '<label for="exampleInputEmail1">Precio (sin puntuación)</label>';
                                    echo '<input name="precio" pattern="^\d+$" data-parsley-required="true" class="form-control validation" placeholder="$CLP" type="text">';
                                    echo '</div>';

                                    /*echo '<label for="exampleInputEmail1">No. Viajes</label>';
                                    echo '<input name="num_viajes" data-parsley-required="true" class="form-control" placeholder="Viajes" type="number" min="1" max="20" value="1">';
                                    echo '</div>';
                                    */
                                echo '</div>';

                                echo '<div class="col-lg-12 col-md-12" style="padding-left: 0;">';
                                  echo '<div class="form-group">';
                                  echo '<img id="img_tipo_camion" src="" class="img-responsive text-center" style="display:none"></img>';
                                  echo '</div>';
                                echo '</div>';

                                echo '<div class="col-md-12" style="padding-left: 0;">';
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
                                echo '</div>';
                                ?>



                                <?php
                                    echo '<div class="col-md-12" style="margin-top:12px; padding-left: 0;">';
                                    echo '<button  class="btn btn-accent inline-block"   style="width:100%; color:#f6a821; padding: 8px;">Crear Anuncio</button>';
                                    echo '</div>';
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

                    <div class="col-md-3">
                        <div class="panel panel-filled">
                            <div class="panel-body">
                                <div class="stats-title pull-left">
                                     <h4>CGL-Chile Transportes Ltda.</h4>
                                </div>

                                <div class="m-t-xl">
                                    <table class="table small m-t-sm tbl">
                                        <tbody>
                                            <tr>
                                                <td>Giro:</td>
                                                <td>Nec Euismod In Company</td>
                                            </tr>
                                            <tr>
                                                <td>Rut:</td>
                                                <td>Nec Euismod In Company</td>
                                            </tr>
                                            <tr>
                                                <td>Dirección:</td>
                                                <td>Inceptos Hymenaeos Ltd</td>
                                            </tr>
                                            <tr>
                                                <td>Teléfono:</td>
                                                <td>Nec Euismod In Company</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="stats-title">
                                    <h4>Condiciones del Anuncio</h4>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <code>.form-control</code> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div>
                </div>


<script type="text/javascript">

    //Listar las ciudades por region escogida

    function hideAll(){
        $("#ciudad_origen").find("option").each(function(){ $(this).hide(); });
        $("#ciudad_destino").find("option").each(function(){ $(this).hide(); });
        $("#ciudad_origen").find("option[cod='-1']").show();
        $("#ciudad_destino").find("option[cod='-1']").show();
    }


    $(function(){
        hideAll();
    });

    function ciudad_region(value, ciudad)
        {

                $("#" + ciudad).prop("disabled",false);
                if(value.toString()  == "-1"){

                    $("#" + ciudad).find("option").each(function(){
                        $(this).hide();
                    });

                }else{
                    $("#" + ciudad).find("option").each(function(){
                        $(this).hide();
                    });

                    $("#" + ciudad).find("option[cod='"+value+"']").each(function(){
                        //alert($(this).text());
                        $(this).show();
                    });

                }
                $("#" + ciudad).find("option[cod='-1']").show();
                $("#"+ciudad).find("option[value='-1']").prop('selected',true);


        }

        //Listar la region por ciudad escogida
        /*
        function region_ciudad(obj, ciudad, region)
        {

            var val = $("#"+ciudad).find("option:selected");
            var cod = $(val).attr("cod");
            $("#"+region).find("option[value='"+cod+"']").prop('selected',true);


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
    $(function(){

      /*
        $("#form_ofrecercarga").on("submit",function(event){
            alert("Handler");
            event.preventDefault();
            return false;
        })
        .validate({
          rules: {
            name: "required",
            email: {
              required: true,
              email: true
            }
          },
          messages: {
            precio: "Please specify your price",
            email: {
              required: "We need your email address to contact you",
              email: "Your email address must be in the format of name@domain.com"
            }
          }
        });
        */
    });
    <?= 'base_url = "'.base_url().'";' ?>

    function changeTipoCamion(value)
    {
          return false;
          /*datos_tipo_camion.forEach(function(val, idx, obj){
          if( val.tipo ===  value){
            var file = (val.file_name === "" || val.file_name == null)? "unavailable.jpg":val.file_name;
            $("#img_tipo_camion").prop("src","uploads/"+file);
            return;
          }
      });*/
    }
</script>
