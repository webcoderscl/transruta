				<div class="row">
                    <div class="col-lg-12">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe page-header-icon pe-7s-timer"></i>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Dashboard</h3>
                                <small>Bienvenido, comienza aquí.</small>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2 col-xs-6">
                        <div class="panel panel-filled">

                            <div class="panel-body">
                                <h2 class="m-b-none">
                                    <span class="pe-7s-users"></span> <?php if(isset($num_cuentas)) echo " ".$num_cuentas; ?> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span>
                                </h2>
                                <div class="small mrgn-tp1">Total Registrados</div>
                                <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Reciente: <span class="c-white">7 Nuevos</span>  </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-6">
                        <div class="panel panel-filled">
                            <div class="panel-body">
                                <h2 class="m-b-none">
                                    <span class="pe-7s-like2"></span> <?php if(isset($num_transportes)) echo " ".$num_transportes; ?> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span>
                                </h2>
                                <div class="small mrgn-tp1">Transportes Disponibles</div>
                                <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Reciente: <span class="c-white">15 Nuevos</span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-6">
                        <div class="panel panel-filled">
                            <div class="panel-body">
                                <h2 class="m-b-none">
                                    <span class="pe-7s-target"></span> <?php if(isset($num_cargas)) echo " ".$num_cargas; ?> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span>
                                </h2>
                                <div class="small mrgn-tp1">Cargas Publicadas</div>
                                <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Reciente: <span class="c-white">5 Nuevos</span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-6">
                        <div class="panel panel-filled">
                            <div class="panel-body">
                                <h2 class="m-b-none">
                                    <span class="pe-7s-paper-plane"></span> 12 <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span>
                                </h2>
                                <div class="small mrgn-tp1">Transportes en Curso</div>
                                <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Reciente: <span class="c-white">54</span> </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-xs-12">
                        <div class="panel panel-b-accent" style="position:relative;height: 114px">
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
                </div>

                <div class="row">
                	<!-- Item -->
                    <div class="col-md-4">
                        <div class="panel panel-b-accent" style="position:relative;height: 213px">
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

                    <!-- Item -->
                    <div class="col-md-4">
                        <div class="panel panel-filled panel-c-accent" style="min-height: 213px;">
                            <div class="panel-body h-200 list">
                                <div class="stats-title pull-left">
                                    <h4>Tu cuenta</h4>
                                </div>
                                <div class="m-t-xl">
                                    <small>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    </small>
                                </div>

                                <div class="progress m-t-xs full progress-small">
                                    <div style="width: 35%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="35" role="progressbar" class=" progress-bar progress-bar-warning">
                                        <span class="sr-only">35% Complete (success)</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="stat-label">Plan</small>
                                        <h4 class="m-t-xs">Pro 1 Año <i class="fa fa-level-up text-warning"></i></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="stat-label">Vencimiento</small>
                                        <h4 class="m-t-xs">10 Mayo, 2017 <i class="fa fa-level-down c-white"></i></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="col-md-4">
                        <div class="panel panel-filled panel-c-accent" style="min-height: 213px;">
                            <div class="panel-body h-200 list">
                                <div class="stats-title pull-left">
                                    <h4>Adquirir / Renovar Plan</h4>
                                </div>
                                <div class="m-t-xl">
                                	<div style="width:100%; height: 50px; background-color: #f6a821;"> </div>
                                	<button type="button" class="btn btn-default btn-sm destacado-btn" style="margin-top:5px;" data-toggle="modal" data-target="#myModal">¡Contratar Ahora!</button>
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h4 class="modal-title">Modal title</h4>
                                                    <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="m-t-none">Lorem Ipsum is simply</h4>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <small class="stat-label">Today</small>
                                                            <h4 class="m-t-xs">170,20 <i class="fa fa-level-up text-accent"></i></h4>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <small class="stat-label">Last month %</small>
                                                            <h4 class="m-t-xs">%20,20 <i class="fa fa-level-down c-white"></i></h4>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <small class="stat-label">Last year</small>
                                                            <h4 class="m-t-xs">246,40 <i class="fa fa-level-up text-accent"></i></h4>
                                                        </div>
                                                    </div>
                                                    <div class="progress m-t-xs full progress-small">
                                                        <div style="width: 65%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" role="progressbar" class=" progress-bar progress-bar-warning">
                                                            <span class="sr-only">65% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-accent">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p class="legend-sm" style="margin-top: 6px;">
                                	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>