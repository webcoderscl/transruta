
<div class="main-container">
	<?php 
			$usr = $this->session->userdata('login_type');
			$uri = "?".$usr."/misdatos";
	?>
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?User/dashboard'); ?>"> DASHBOARD</a></li>
			<li>DATOS SUCURSAL</li>	 
			<?php if(isset($service)){

				echo '<li style="text-transform: uppercase;">SERVICE '.$service['servname'].'</li>';			
				$id = $service['id'];							
				$uridel = "?User/dismiss_service/".$id;
				$uriback = "?User/myservices";
				echo '<li style="float:right;"><a href="'.site_url($uriback).'"><i class="fa fa-backward"></i></a></li>';
				echo '<li style="float:right;"><a href="'.site_url($uridel).'"><i class="fa fa-minus"></i></a></li>';

				}
			?>
			<li style="float:right;"><a href="<?php echo site_url($uri);?>"><i class="fa fa-plus"></i></a></li>			
		</ul>
	
			<?php
			$usr = $this->session->userdata('login_type');
			$uri2 = "?".$usr."/contactosucursal/upd";
			
			echo form_open($uri2);
			echo '<h2><b>DATOS DE CONTACTO</b></h2>';		
			
			?>
		<table class="table table-striped" id="dataTable1">
			
			<thead>
				<tr>
					<th style="width:5%"></th>									
					<th style="width:60%;"></th>					
					<th style="width:30%;"></th>				
					
				</tr>
			</thead>
			<tbody style="border: 2px solid #FFFFFF;">
				<?php
					
						
					echo '<tr>';
					echo '<div class="container">';
					echo  '<td>1</td>';
					echo  '<td>Nombre:</td>';
					echo  '<td>';
					echo '<input name="nombre" data-parsley-required="true" class="input-sm" type="text" value="'.$mis_datos[0]["nombre"].'"/>';
					echo '</td>';
					echo '<td>';
					echo '<div class="col-md-5">';
					echo "<button type='submit'  class='btn btn-danger inline-block'>Modificar</button>";
					echo '</div>';
					echo '</td>';
					echo '</div>';
					echo '</tr>';

					echo '<tr>';
					echo '<div class="container">';
					echo  '<td>1</td>';
					echo  '<td>Teléfono:</td>';
					echo  '<td>';
					echo '<input name="telefono" data-parsley-required="true" class="input-sm" type="text" value="'.$mis_datos[0]["telefono"].'"/>';
					echo '</td>';
					echo  '<td></td>';
					echo '</div>';
					echo '</tr>';

					
					echo '<tr>';
					echo '<div class="container">';
					echo  '<td>1</td>';
					echo  '<td>Email:</td>';
					echo  '<td>';
					echo '<input name="email" data-parsley-required="true" class="input-sm" type="text" value="'.$mis_datos[0]["email"].'"/>';
					echo '</td>';
					echo  '<td></td>';
					echo '</div>';
					echo '</tr>';

						echo '<tr>';
					echo '<div class="container">';
					echo  '<td>1</td>';
					echo  '<td>Dirección:</td>';
					echo  '<td>';
					echo '<input name="direccion" data-parsley-required="true" class="input-sm" type="text" value="'.$mis_datos[0]["direccion"].'"/>';
					echo '</td>';
					echo  '<td></td>';
					echo '</div>';
					echo '</tr>';
				?>
				
			</tbody>
			
		</table>
		<?php echo form_close(); ?>
	</div><!-- ./padding-md -->
	
	<script type="text/javascript">
		function showLenPwdValue(newValue, idserv)
		{
			document.getElementById("pwdrange"+idserv).innerHTML="len => " +newValue;
		}
		function showLenValuationValue(newValue, idserv)
		{
			document.getElementById("valrange"+idserv).innerHTML="value => " +newValue;
		}

		function checkPwd(idvinc, mode){
			 $.ajax({                                      
		      url: window.location.pathname+'?Ajax/userCheckPwd/'+idvinc+'/'+mode,                  //the script to call to get data          
		      data: "",                        //you can insert url argumnets here to pass to api.php
		                                       //for example "id=5&parent=6"
		      dataType: 'json',                //data format      
		      success: function(data)          //on recieve of reply
		      {
		        
		        //--------------------------------------------------------------------
		        // 3) Update html content
		        //--------------------------------------------------------------------
		               
		        //for(var i=0;i<data.length;i++){
		          var id = data.id;              //get id
		          var oldpwd = data.oldpassword;           //get name
		          var pwd = data.password;           //get name
		           //alert(data.password);
		            //$.each( data, function( id, val ) {
		              //items.push( "<li id='" + id + "'>" + data[id]['Muser']  +"</li>" );
		            //});
		          
		          if(mode == 'hide'){
		          	$('#btn'+id).html('<i class="fa fa-eye"></i> Show');
		          	$('#btn'+id).removeClass("btn-success").addClass('btn-danger');
		          	$('#btn'+id).attr("onClick","checkPwd("+id+",'show')");
		          	$('#badge'+id).html('Hidden');
		          	$('#badge'+id).removeClass("badge-danger").addClass('badge-success');
		          	$('#oldpwd'+id).removeClass("badge-danger").addClass("badge-success");
		          	$('#pwd'+id).removeClass("badge-danger").addClass("badge-success");
		          	
		          }		          	
		          else if(mode == 'show'){
		          	$('#btn'+id).html('<i class="fa fa-eye-slash"></i> Hide');		          	
		          	$('#btn'+id).removeClass("btn-danger").addClass('btn-success');
		          	$('#btn'+id).attr("onClick","checkPwd("+id+",'hide')");
		          	$('#badge'+id).html('Visible');
		          	$('#badge'+id).removeClass("badge-success").addClass('badge-danger');
		          	$('#oldpwd'+id).removeClass("badge-success").addClass("badge-danger");
		          	$('#pwd'+id).removeClass("badge-success").addClass("badge-danger");
		          }

		          $('#oldpwd'+id).html(oldpwd); 
		          $('#pwd'+id).html(pwd);


		          //$('#output').html(items.join("")); //Set output element html  
		        //}
		        
		        //recommend reading up on jquery selectors they are awesome 
		        // http://api.jquery.com/category/selectors/
		      } 
		    });
		}


		
	</script>
	
	
	

</div><!-- /main-container -->
