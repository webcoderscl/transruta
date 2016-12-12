	<!-- Navigation-->
    <aside class="navigation">
        <nav>
            <ul class="nav luna-nav">

                <?php
					$adm = $this->session->userdata('admin_login');
					$usr = $this->session->userdata('user_login');
					$type = $this->session->userdata('login_type');
                    $enabled = $this->session->userdata('enabled');
				?>
                <?php if ($adm  == 1){
                ?>


                <li class="active">
                    <a href="<?php echo  base_url()."?".$type;?>/dashboard">Dashboard <i class="fa fa-home" aria-hidden="true"></i></a>
                </li>
                <li class="nav-category">Registros de Usuarios</li>
                <!-- <li><a href="<?php echo  base_url().'?'.$type;?>/misdatos">Mi Perfil</a></li>  -->
                <li style="border-bottom: 1px dashed rgb(75, 75, 75); padding-bottom: 10px;">
                    <a href="<?php echo  base_url().'?'.$type;?>/cuentas">
                        <span class="badge pull-right"><?php if(isset($num_cuentas)) echo $num_cuentas; ?></span> Cuentas de Usuarios
                    </a>
                </li>
                <li >
                    <a href="<?php echo  base_url().'?'.$type;?>/empresas">
                        Empresas de Transporte
                    </a>
                </li>
                <li style="border-bottom: 1px dashed rgb(75, 75, 75); padding-bottom: 10px;">
                    <a href="<?php echo  base_url().'?'.$type;?>/ofertas">
                        Ofertas Disponibles
                    </a>
                </li>

                <li class="nav-category">Administrar Opciones</li>
                <li>
                    <a href="<?php echo  base_url().'?'.$type;?>/regiones">
                        <!-- <span class="badge pull-right"><?php if(isset($num_regiones)) echo $num_regiones; ?></span> -->
                        Regiones
                    </a>
                </li>
                 <li>
                    <a href="<?php echo  base_url().'?'.$type;?>/ciudades">
                        <!-- <span class="badge pull-right"><?php if(isset($num_ciudades)) echo $num_ciudades; ?></span> -->
                        Ciudades
                    </a>
                </li>
                <li>
                    <a href="<?php echo  base_url().'?'.$type;?>/cargas">
                        <!-- <span class="badge pull-right"><?php if(isset($num_cargas)) echo $num_cargas; ?></span> -->
                        Tipos de Cargas
                    </a>
                </li>
                <li style="border-bottom: 1px dashed rgb(75, 75, 75); padding-bottom: 10px;">
                    <a href="<?php echo  base_url().'?'.$type;?>/tipocamion">
                        <!-- <span class="badge pull-right"><?php if(isset($num_tipocamiones)) echo $num_tipocamiones; ?></span> -->
                        Tipos de Camión
                    </a>
                </li>

                <li class="nav-category">Elementos Registrados</li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/equipos"><span class="badge pull-right">
                    <?php if(isset($num_equipos)) echo $num_equipos; ?>
                </span>Equipos</a></li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/choferes"><span class="badge pull-right">
                    <?php if(isset($num_choferes)) echo $num_choferes; ?>
                </span>Choferes</a></li>


                <li class="nav-info">
                    <i class="pe pe-7s-shield text-accent"></i>
                    <div class="m-t-xs footer-text">
                        © Todos Derechos Reservados a Transruta - 2016. Queda absolutamente prohibida la reproducción total o parcial de cualquier material, código o información expuesta en esta plataforma de gestión. Todas las acciones realizadas en la plataforma, son de exclusiva responsabilidad del propio usuario, el cual hace ingreso con su respectivo correo electrónico y contraseña.
                    </div>
                    <p style="text-align:left; margin-top:5px;">
                        <a href="http://www.codemakers.cl" target="_blank">
                            <img src="http://www.codemakers.cl/static/codemakersf6a821.png">
                        </a>
                    </p>
                </li>


                <!-- ============================
                .2 MENU TRANSPORTISTA
                ============================= -->

				<?php }else if($usr == 1){
					if($type == TRANSPORTISTA){
				?>

                <li class="active"><a href="<?php echo  base_url()."?".$type;?>/dashboard">Principal <i class="fa fa-home" aria-hidden="true"></i></a></li>

                <li class="nav-category">Mis Registros</li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/choferes"><span class="badge pull-right"><?php if(isset($num_choferes)) echo $num_choferes; ?></span> Mis Choferes</a></li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/equipos"><span class="badge pull-right"><?php if(isset($num_equipos)) echo $num_equipos; ?></span> Mis Equipos</a></li>


                <?php if($enabled == 1){ ?>
                <li class="nav-category">Panel de Control</li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/ofrecercamion" class="dest-item-menu" style="border-bottom: 1px dashed #fff;">Ofrecer Camión <i class="fa fa-calendar" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/buscarcarga" class="dest-item-menu">Buscar Carga <i class="fa fa-search" aria-hidden="true"></i></a></li>

                <li><a href="<?php echo  base_url().'?'.$type;?>/misofertas"><span class="badge pull-right"><?php if(isset($num_ofertas)) echo $num_ofertas; ?></span> Mis Ofertas</a></li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/missolicitudesenviadas"><span class="badge pull-right" style="background: #f6a821; color: #fff; border-radius: 3px;"> <?php if(isset($num_solicitudes_enviadas)) echo $num_solicitudes_enviadas; ?></span> Solicitudes Enviadas en Curso</a></li>
		        <li><a href="<?php echo  base_url().'?'.$type;?>/missolicitudesrecibidas"><span class="badge pull-right" style="background: #f6a821; color: #fff; border-radius: 3px;"> <?php if(isset($num_solicitudes_recibidas)) echo $num_solicitudes_recibidas; ?></span> Peticiones Recibidas en Curso</a></li>
                <li style="border-bottom: 1px dashed rgb(75, 75, 75); padding-bottom:10px;"><a href="<?php echo  base_url().'?'.$type;?>/historial"><span class="badge pull-right"><?php if(isset($num_historial)) echo $num_historial; ?></span> Mi Historial</a></li>

                <li class="nav-category">Mi Cuenta</li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/misdatos">Perfil de Empresa</a></li>
                <?php } ?>
                <li class="nav-info">
                    <i class="pe pe-7s-shield text-accent"></i>
                    <div class="m-t-xs footer-text">
                    © Todos Derechos Reservados a Transruta - 2016. Queda absolutamente prohibida la reproducción total o parcial de cualquier material, código o información expuesta en esta plataforma de gestión. Todas las acciones realizadas en la plataforma, son de exclusiva responsabilidad del propio usuario, el cual hace ingreso con su respectivo correo electrónico y contraseña.
                    </div>
                    <p style="text-align:left; margin-top:5px;"><a href="http://www.codemakers.cl" target="_blank"><img src="http://www.codemakers.cl/static/codemakersf6a821.png"></a></p>
                </li>


                <!-- ============================
                .3 MENU GENERADOR DE CARGA
                ============================= -->
                <?php }else if($type == GENERADORCARGA ){
                ?>
                <li class="active"><a href="<?php echo  base_url()."?".$type;?>/dashboard"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>

                <li class="nav-category">Mi Cuenta</li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/misdatos">Perfil</a></li>
                <!--
                <li><a href="<?php echo  base_url().'?'.$type;?>/contactosucursal"><span class="badge pull-right"><?php if(isset($num_choferes)) echo $num_choferes; ?></span>Datos Sucursal</a></li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/sucursal"><span class="badge pull-right">
                -->
                <li><a href="#">Datos Sucursal</a></li>
                <li><a href="#">Sucursal</a></li>

                <?php if($enabled == 1){ ?>
                <li class="nav-category">Plataforma</li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/buscarcamion">Buscar Camión <i class="fa fa-search" aria-hidden="true"></i></a></li>
                <li style="border-bottom: 1px dashed rgb(75, 75, 75);"><a href="<?php echo  base_url().'?'.$type;?>/missolicitudesenviadas"><span class="badge pull-right" style="background: #f6a821; color: #fff; border-radius: 3px;"><?php if(isset($num_solicitudes_enviadas)) echo $num_solicitudes_enviadas; ?></span> Solicitudes Enviadas en Curso</a></li>

                <li><a href="<?php echo  base_url().'?'.$type;?>/ofrecercarga">Ofrecer Carga</a></li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/misofertas"><span class="badge pull-right"><?php if(isset($num_ofertas)) echo $num_ofertas; ?></span> Mis Ofertas</a></li>
		        <li style="border-bottom: 1px dashed rgb(75, 75, 75);"><a href="<?php echo  base_url().'?'.$type;?>/missolicitudesrecibidas"><span class="badge pull-right" style="background: #f6a821; color: #fff; border-radius: 3px;"><?php if(isset($num_solicitudes_recibidas)) echo $num_solicitudes_recibidas; ?></span> Peticiones Recibidas en Curso</a></li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/historial"><span class="badge pull-right"><?php if(isset($num_historial)) echo $num_historial; ?></span> Mi Historial</a></li>
                  <?php } ?>
                <li class="nav-info">
                    <i class="pe pe-7s-shield text-accent"></i>
                    <div class="m-t-xs footer-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    </div>
                    <p style="text-align:left; margin-top:5px;"><a href="http://www.codemakers.cl" target="_blank"><img src="http://www.codemakers.cl/static/codemakersf6a821.png"></a></p>
                </li>

                <?php } ?>
                <?php } ?>
            </ul>
        </nav>
    </aside>
    <!-- End navigation-->
