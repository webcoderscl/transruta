<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>TRANSRuta(CL) | Panel de Control</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/bootstrap/css/bootstrap.css"/>

    <!-- App styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/pe-icons/helper.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/stroke-icons/style.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/style.css">

</head>
<body class="blank">
  		<?php if($this->session->flashdata('flash_message') != ""):?>
        <script>
            $(document).ready(function() {
                Growl.info({title:"<?php echo $this->session->flashdata('flash_message');?>",text:" "})
            });
        </script>
        <?php endif;?>

<!-- Wrapper-->
<div class="wrapper">

    <!-- Main content-->
    <section class="content">
    	<div class="container-center animated slideInDown">
    		<div class="view-header">
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-unlock"></i>
                </div>
                <div class="header-title">
                    <h3 style="letter-spacing: 1.5px;">Registro Nuevo</h3>
                    <small>Registro de Nueva Cuenta de Usuario</small>
                </div>
            </div>

            <div class="panel panel-filled">
                <div class="panel-body">
                    <?php  if(isset($info)) echo $info; ?>
                	<?php include 'page_info.php'; ?>
					<?php echo form_open('?Login/registrar/add',array('id' => 'formValidate2', 'onsubmit' => 'return validateFields();'));?>
                    <div class="bs-example" style="margin-bottom:15px;">
                        <div class="m-t-xs footer-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </div>
                    </div>
                    <div class="form-group m-bottom-md">
                        <select name="tipo_usuario" class="form-control" data-parsley-required="true" required>
                            <option value="">Seleccione Tipo de Cuenta</option>
                            <option value="1">Transportista</option>
                            <option value="2">Generador de Cargas</option>
                        </select>
                    </div>

                    <h3 style="font-size: 13px; font-weight: bold;">DATOS DE LA EMPRESA</h3>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="razon_social" class="form-control validation" placeholder="Razon Social" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="rut" pattern="^[0-9]{6,9}-[0-9Kk]$" class="form-control" placeholder="Rut Empresa" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="giro" class="form-control validation" placeholder="Giro" autocomplete="on"/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="direccion" class="form-control validation" placeholder="Dirección" autocomplete="on" required/>
                    </div>
                    <?php 
                     echo '<div class="form-group m-bottom-md">';
                    echo '<label for="exampleInputEmail1">Región de Origen</label>';
                    echo '<select name="region_origen" id="region_origen" data-parsley-required="true" class="form-control validation" onchange="ciudad_region(this.value,\'ciudad_origen\');" required>';
                    echo '<option value="" cod="-1">Seleccione Región</option>';
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

                    echo '<div class="form-group">';
                    echo '<label for="exampleInputEmail1">Ciudad de Origen</label>';
                    echo '<select name="ciudad_origen" disabled id="ciudad_origen" data-parsley-required="true" class="form-control validation"
                         onchange="get_distancia();" required
                     >';
                    echo '<option value="" cod="-1">Seleccione Ciudad</option>';
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
                    ?>
                   
                    <div class="form-group m-bottom-md">
                        <select name="prefix_fono" style="width: 24%;display: inline-block;" class="form-control" data-parsley-required="true" required>
                            <option value="+56">+56</option>
                            <option value="+569">+569</option>
                        </select>
                        <input type="text" style="width: 75%; display: inline-block;" data-parsley-required="true" name="fono" class="form-control validation" placeholder="Teléfono" pattern="^(\d{6,8})$" maxlength="9" autocomplete="on" required/>
                    </div>


                    <h3 style="font-size: 13px; font-weight: bold;">DATOS DE USUARIO</h3>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="nombre_rep_legal" class="form-control validation" placeholder="Nombre" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="rut_rep_legal" pattern="^[0-9]{6,9}-[0-9Kk]$" class="form-control validation" placeholder="RUT" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="hidden" name="prefix_fono_rep_legal" value="+569" />
                        <input type="text" style="width: 17%;display: inline-block;" data-parsley-required="true" name="" class="form-control" placeholder="+569" autocomplete="on" disabled="disabled" value="+569" />
                        <input type="text" style="width: 82%; display: inline-block;" data-parsley-required="true" name="fono_rep_legal" class="form-control validation" maxlength="9" placeholder="Celular" pattern="^(\d{7,8})$" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="Muser" class="form-control validation" placeholder="Correo Electrónico" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="password" data-parsley-required="true" name="Mpassword" class="form-control validation" placeholder="Contraseña..." autocomplete="off" required/>
                    </div>
                    <div class="form-group m-bottom-md" style="padding-bottom:20px;">
                        <input type="password" data-parsley-required="true" name="Mpassword_again" class="form-control validation" placeholder="Repita Contraseña..." autocomplete="off" required/>
                    </div>


                    <div class="bs-example" style="margin-bottom:15px;">
                        <div class="m-t-xs footer-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                    </div>

                    <div class="form-group m-bottom-md">
                        <button class="btn btn-accent" style="color:#f6a821; width:100%">Crear Cuenta</button>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
            <div class="m-t-xs footer-text">
            	<div class="view-header" style="margin: 40px 0 -5px 0;">
	                <div class="header-icon" style="width: 50px;">
	                    <span class="pe-7s-door-lock" style="font-size: 46px;"></span>
	                </div>
	                <div class="header-title" style="margin-left: 55px;">
	                    <h3 style="letter-spacing: 0;font-size: 19px;margin-bottom: -2px;">Ya estoy registrado...</h3>
	                    <small>Si ya posee una cuenta, solo debe ingresar con sus datos.</small>
	                </div>
            	</div>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                <p style="width: 100%; margin-top:20px;"><a class="btn btn-default" href="http://www.transruta.cl/code/?Login/" data-toggle="modal" style="width: 100%">Ingresar</a></p>
                <p style="text-align:center; padding-top:20px;"><img src="<?php echo base_url();?>template/codemakers/images/logo-949ba2.png"></p>
            </div>

        </div>
    </section>
    <!-- End main content-->

</div>
<!-- End wrapper-->

<!-- Vendor scripts -->
<script src="<?php echo base_url();?>template/codemakers/vendor/pacejs/pace.min.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- App scripts -->
<script src="<?php echo base_url();?>template/codemakers/scripts/luna.js"></script>

	<script>
		$(function()	{
			//Delete Widget Confirmation
			$('#deleteWidgetConfirm').popup({
					vertical: 'top',
					pagecontainer: '.container',
					transition: 'all 0.3s'
			});

			//Form Validation
			$('#basic-constraint').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							return false;
						}
			        }
			}});

			$('#type-constraint').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							return false;
						}
			        }
			}});

			$('#formValidate2').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							alert('Registration Complete');
							return false;
						}
			        }
			}});

			$('#formValidatex2').parsley( { listeners: {
					onFieldValidate: function ( elem ) {
						// if field is not visible, do not apply Parsley validation!
						if ( !$( elem ).is( ':visible' ) ) {
							return true;
						}

						return false;
					},
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							alert('Your message has been sent');
							return false;
						}
			        }
			}});
		});



    //Listar las ciudades por region escogida

    function hideAll(){
        $("#ciudad_origen").find("option").each(function(){ $(this).hide(); });
        $("#ciudad_origen").find("option[cod='-1']").show();
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
                    $("#" + ciudad).prop("disabled",true);

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


         // VALIDACION DE CAMPOS
    function validateField(selector){
            var valid = true;
            if ($(selector).is("SELECT")){
                if($(selector).val() == -1){
                    valid = false;
                    $(selector).addClass("valid_error");
                }else{
                    $(selector).removeClass("valid_error");
                }
                //alert("is select!");
            }else if($(selector).is("INPUT")){
                if($(selector).val() == ""){
                    valid = false;
                    $(selector).addClass("valid_error");
                }else{
                    $(selector).removeClass("valid_error");
                }
            }else if($(selector).is("TEXTAREA")){
                if($(selector).val() == ""){
                    valid = false;
                    $(selector).addClass("valid_error");
                }else{
                    $(selector).removeClass("valid_error");
                }
            }

            return valid;
        }

        function validateFields(){
            var valid = true;
            $(".validation").each(function(){
                valid = validateField(this);
                //alert($(this).attr("name") + "--> "+$(this).val());
            });

            if(valid){
                //$("#form_data").submit();
                $("#error_msg").hide();
            }
            else{
                $("#error_msg").show();
            }
            return valid;
        }

	</script>

</body>
</html>
