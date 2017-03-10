            <?php
                $usr = $this->session->userdata("login_type");
                $uriadd = "?".$usr."/".$page_name."/add";
             ?>


            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-6">
                        <div class="table-responsive">
                            <table class="table table-condensed" id="dataTable1">
                                <thead>
                                    <tr>
                                        <th style="width:5%">No.</th>
                                        <th style="width:40%">Variable</th>
                                        <th style="width:55%">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                    <td>1</td>
                                    <td >Código Oferta</td>
                                    <td id="idofertatransportista"> </td>
                                    </tr>

                                    <tr>
                                    <td>2</td>
                                    <td>Publicación del Anuncio</td>
                                    <td id="fecha_publicacion"><i class="fa fa-calendar" aria-hidden="true"></i>

                                    </td>
                                    </tr>

                                    <tr>
                                    <td>3</td>
                                    <td>Fecha Disponibilidad</td>
                                    <td id="fecha_disponibilidad"><i class="fa fa-calendar" aria-hidden="true"></i>

                                    </td>
                                    </tr>


                                    <tr>
                                    <td>4</td>
                                    <td>Ciudad Origen</td>
                                   <td id="nciudad_origen"></td>
                                    </tr>

                                    <tr>
                                    <td>5</td>
                                    <td>Ciudad destino</td>
                                    <td id="nciudad_destino"></td>
                                    </tr>

                                    <tr>
                                    <td>6</td>
                                    <td>Dirección Origen</td>
                                    <td id="origen_direccion"></td>
                                    </tr>

                                    <tr>
                                    <td>7</td>
                                    <td>Dirección Destino</td>
                                    <td id="destino_direccion"></td>
                                    </tr>



                                    <tr>
                                    <td>8</td>
                                    <td>Patente</td>
                                    <td id="patente"></td>
                                    </tr>



                                    <tr>
                                    <td>9</td>
                                    <td>Tipo Camión</td>
                                    <td id="tipo_camion"></td>
                                    </tr>

                                    <tr>
                                    <td>10</td>
                                    <td>GPS? / Seguro? / Doble Puente?</td>
                                    <td id="gps_seg_puente"></td>
                                    </tr>

                                    <tr>
                                    <td>11</td>
                                    <td>Detalle</td>
                                    <td id="detalle"></td>
                                    </tr>

                                    <tr>
                                    <td>12</td>
                                    <td>Estado</td>
                                    <td id="descripcion_estado"></td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-6">
                        <div class="table-responsive">
                            <table class="table table-condensed" id="dataTable1">
                                <thead>
                                    <tr>
                                      <th style="width:5%">No.</th>
                                      <th style="width:40%">Datos de</th>
                                      <th style="width:55%">Contacto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>1</td>
                                    <td>Empresa</td>
                                    <td id="razon_social"></td>
                                    </tr>

                                    <tr>
                                    <td>2</td>
                                    <td>Usuario</td>
                                    <td id="username"></td>
                                    </tr>

                                    <tr>
                                    <td>3</td>
                                    <td>Contacto</td>
                                    <td id="mail_contacto"></td>
                                    </tr>

                                    <tr>
                                    <td>4</td>
                                    <td>Telefono Contacto</td>
                                    <td id="fono_contacto"></td>
                                    </tr>

                                </tbody>

                            </table>
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
