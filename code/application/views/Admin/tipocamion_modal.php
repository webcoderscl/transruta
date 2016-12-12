			<?php
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/tipocamion/add";
			?>
			<style type="text/css">

			.fa-spin-custom, .glyphicon-spin {
					-webkit-animation: spin 1000ms infinite linear;
					animation: spin 1000ms infinite linear;
			}
			@-webkit-keyframes spin {
					0% {
							-webkit-transform: rotate(0deg);
							transform: rotate(0deg);
					}
					100% {
							-webkit-transform: rotate(359deg);
							transform: rotate(359deg);
					}
			}
			@keyframes spin {
					0% {
							-webkit-transform: rotate(0deg);
							transform: rotate(0deg);
					}
					100% {
							-webkit-transform: rotate(359deg);
							transform: rotate(359deg);
					}
			}
			</style>

			<?php //echo form_open_multipart($uriadd, array("id" => "uploadFile","name" => "tablename_cu","onsubmit" => "return false;")); ?>


			<?php echo form_open($uriadd,array('id' => 'formValidate1', 'name' => 'tablename_cu'));?>

			<div class="modal-body">
								<div id="loader" class="text-center" style="display:none">
										<label>Cargando archivo... Esto puede tardar varios minutos, espere por favor.</label><br>
										<span class="glyphicon glyphicon-refresh glyphicon-spin"></span>
								</div>
								<div id="info_callback" style="display:none">
														<center>
														<small id="text_callback" class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs" style="margin: 0px 0px 13px; width: 100%; border: 1px dashed rgb(246, 168, 33); border-radius: 2px; padding: 7px; background-color: rgba(0, 0, 0, 0.12);">
														</small>
														</center>
								</div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" id="tipo" name="tipo" class="form-control" placeholder="Tipo..." autocomplete="off" required>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" id="marca" name="marca" class="form-control" placeholder="Marca..." autocomplete="off" required>
                    </div>
                    <div class="form-group m-bottom-md">
                        <label for="exampleInputEmail1">Descripción</label>
                                <?php echo form_textarea(
                                    array(
                                        'name'        => 'descripcion',
                                        'maxlength'   => '200',
                                        'rows'        => '3',
                                        'cols'        => '50',
                                        'class'       => 'form-control',
                                        //'size'        => '35',
                                        'style'       => 'resize: vertical'
                                    )
                                    );
                                ?>

                    </div>
                </div>
								<div class="row">
										<input type="hidden" name="size_file" id="size_file" value="0" />
										<input type="hidden" name="file_name" id="file_name" value="" />
								</div>
								<div id="filelist" class="row">Tu navegador no tiene soporte Flash, Silverlight o HTML5.</div>
								<br />

								<div id="container" class="selector_files" style="display:none">
										<a id="pickfiles" href="javascript:;" class="btn btn-w-md dim btn-default">Examinar...</a>
										<a id="uploadfiles" href="javascript:;" class="btn btn-primary dim" style="display:none;float:right">Comenzar</a>
										<br />
								<p id="console"></p>
								</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                 <input type="submit" value="Aplicar" class="btn btn-accent" />
            </div>
            <?php echo form_close();?>



						<script type="text/javascript">
							$(".input_validation").blur(function(){
								var valid = true;
								$(".input_validation").each(function(){
									if($(this).is("SELECT")){
										if($(this).val() == "-1") valid=false;
									}
									else if($(this).is("INPUT"))
									{
										if($(this).val() == "") valid=false;
									}

								});
								if(valid)
									$(".selector_files").show();
								else
									$(".selector_files").hide();

							});



						</script>
