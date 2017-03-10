<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Transportista extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('Crud_model');
        $this->load->model('Transportista_model');
        $this->load->library("pagination");
        //$this->load->library('encryption');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    /***default functin, redirects to login page if no admin logged in yet***/


    public function index()
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(base_url() . '?Login', 'refresh');
        if ($this->session->userdata('user_login') == 1){
            $usertype = $this->session->userdata('login_type');
            redirect(base_url() . '?'.$usertype.'/dashboard', 'refresh');
        }
    }


    function dashboard()
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);


            $status = '0'; //ultimos sin agendar
            $status2 = '2'; //ultimos  agendados
            //$page_data['publicaciones'] = $this->Crud_model->get_lastPublicaciones($idUserType, $usrtype, $idAcc,$status);
            $page_data['agendados'] = $this->Engine_model->get_lastPublicaciones($idUserType, $usrtype, $idAcc,$status2);

            $page_data['num_cuentas'] = $this->Generic_model->get_num_filas("account");
            $page_data['num_cargas'] = $this->Transportista_model->ofertacarga_get_num();
            $page_data['num_transportes'] = $this->Transportista_model->ofertatransportista_get_num();
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'dashboard','Dashboard');
            $this->load->view('index', $page_data);

        }


    }

    function equipos($option = "show", $id = 0 , $mode = "none") //mode es para upd //EQUIPOS = CAMION
    {
        if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();
            $page_data['modal_title_add'] = 'Agregar Equipo';
            $page_data['modal_title_upd'] = 'Modificar Equipo';
            $page_data['modal_title_text_add'] = 'Para agregar por favor rellene los campos solicitados.';
            $page_data['modal_title_text_upd'] = 'Para modificar por favor rellene los campos solicitados.';
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
            $page_data["idUserType"] = $idUserType;

            //$page_data['equipos'] = $this->Crud_model->equipo_get_all_by_id(0,$idUserType);
            $page_data['choferes'] = $this->Camionero_model->fetch_tabla_chofer($idUserType,1000,0);
            $page_data["tipos_camion"] = $this->Generic_model->get_tipo_equipo();


            $config = array();
            $page_data['num_equipos'] = $this->Camionero_model->get_num_equipos_by_id($idUserType);
            $config["base_url"] = base_url() . "?".$usrtype."/equipos/$option/$id/$mode";
            $config["total_rows"] = $page_data['num_equipos'];
            $config["per_page"] = 20; //20 antes
            $config["uri_segment"] = 6;

            $config['first_link'] = '<i class="fa fa-fast-backward"></i>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = '<i class="fa fa-fast-forward"></i>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '<i class="fa fa-step-forward"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '<i class="fa fa-step-backward"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
            $limit = $config["per_page"];
            $start = $page;
            $page_data['equipos'] = $this->Camionero_model->fetch_tabla_equipo($idUserType,$limit,$start);

            $page_data["links"] = $this->pagination->create_links();


            if($option == "add"){

                 $patente = $this->input->post('patente');
                 $anio = $this->input->post('anio');
                 $tipo = $this->input->post('tipo');
                 $toneladas = $this->input->post('toneladas');
                 $idchofer = $this->input->post('chofer');
                 $gps_empresa = $this->input->post('gps_empresa');
                 $seg_num_poliza = $this->input->post('seg_no_poliza');
                 $seg_empresa = $this->input->post('seg_empresa');
                 $detalle_camion = $this->input->post('detalles');
                 $fecha_expiracion = $this->input->post('seg_no_poliza_fecha_exp');
                 $doble_puente = $this->input->post('doble_puente');

                 $data = array("patente" => $patente,
                              "anio" => $anio,
                              "tipo" => $tipo,
                              "detalle" => $detalle_camion,
                              "gps_empresa" => $gps_empresa,
                              "seg_num_poliza" => $seg_num_poliza,
                              "num_poliza_fec_expiracion" => $fecha_expiracion,
                              "seg_empresa" => $seg_empresa,
                              "toneladas" => $toneladas,
                              "doble_puente" => $doble_puente,
                              "idchofer_fk" => $idchofer);

                $this->Camionero_model->equipo_insert($data);
                //$this->load->view('index', $page_data);
                redirect(base_url()."?".$usrtype."/equipos",'refresh');
            }

            else if($option == "upd" && $id > 0){
                $page_data['equipo_datos'] = $this->Camionero_model->equipo_get_all_by_id($id, $idUserType);
                if($mode == "commit"){  //efectuar update
                    $patente = $this->input->post('patente');
                    $anio = $this->input->post('anio');
                    $tipo = $this->input->post('tipo');
                    $toneladas = $this->input->post('toneladas');
                    $idchofer = $this->input->post('chofer');
                    $gps_empresa = $this->input->post('gps_empresa');
                     $seg_num_poliza = $this->input->post('seg_no_poliza');
                     $seg_empresa = $this->input->post('seg_empresa');
                     $detalle_camion = $this->input->post('detalles');
                     $fecha_expiracion = $this->input->post('seg_no_poliza_fecha_exp');
                     $doble_puente = $this->input->post('doble_puente');
                     $data = array("patente" => $patente,
                                  "anio" => $anio,
                                  "tipo" => $tipo,
                                  "detalle" => $detalle_camion,
                                  "gps_empresa" => $gps_empresa,
                                  "seg_num_poliza" => $seg_num_poliza,
                                  "num_poliza_fec_expiracion" => $fecha_expiracion,
                                  "seg_empresa" => $seg_empresa,
                                  "toneladas" => $toneladas,
                                  "doble_puente" => $doble_puente,
                                  "idchofer_fk" => $idchofer);
                    $this->Camionero_model->equipo_update_by_id($id,$data);

                    //$page_data['chofer_datos'] = $this->Crud_model->chofer_get_all_by_id($id, $idUserType);
                    redirect(base_url()."?".$usrtype."/equipos",'refresh');
                }
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'equipos','Equipos');
                $this->load->view('index', $page_data);
            }
            else if($option == "del" && $id > 0){
                $this->Camionero_model->equipo_delete_by_id($id);
                redirect(base_url()."?".$usrtype."/equipos",'refresh');
            }
            if($option == "show"){
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'equipos','Equipos');
                $this->load->view('index', $page_data);
            }


        }


    }





    function choferes($option = "show", $id = 0 , $mode = "none") //mode es para upd
    {
        if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            /*$page_data['modal_title_add'] = 'Agregar Chofer';
            $page_data['modal_title_upd'] = 'Modificar Chofer';
            $page_data['modal_title_text_add'] = 'Para agregar por favor rellene los campos solicitados.';
            $page_data['modal_title_text_upd'] = 'Para modificar por favor rellene los campos solicitados.';*/
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
            $page_data["idUserType"] = $idUserType;

            $page_data['option'] = $option;
            //$limit = 10000;
            //$page_data['choferes'] = $this->Crud_model->fetch_tabla_chofer($limit,0);



            $config = array();
            $page_data["num_choferes"] = $this->Camionero_model->get_num_choferes_by_id($idUserType);
            $config["base_url"] = base_url() . "?".$usrtype."/choferes/$option/$id/$mode";
            $config["total_rows"] = $page_data['num_choferes'];
            $config["per_page"] = 20; //20 antes
            $config["uri_segment"] = 6;

            $config['first_link'] = '<i class="fa fa-fast-backward"></i>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = '<i class="fa fa-fast-forward"></i>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '<i class="fa fa-step-forward"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '<i class="fa fa-step-backward"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
            $limit = $config["per_page"];
            $start = $page;
            $page_data['choferes'] = $this->Camionero_model->fetch_tabla_chofer($idUserType,$limit,$start);

            $page_data["links"] = $this->pagination->create_links();

            if($option == "add"){

                 $nombre = $this->input->post('nombre');
                 $apellido = $this->input->post('apellido');
                 $rut = $this->input->post('rut');
                 $celular = $this->input->post('celular');
                 $data = array("nombre" => $nombre,
                              "apellido" => $apellido,
                              "RUT" => $rut,
                              "celular" => $celular,
                              "idtransportista_fk" => $idUserType);


                $this->Camionero_model->chofer_insert($data);
                //$this->load->view('index', $page_data);
                redirect(base_url()."?".$usrtype."/choferes",'refresh');
            }

            else if($option == "upd" && $id > 0){
                $page_data['chofer_datos'] = $this->Camionero_model->chofer_get_all_by_id($id, $idUserType);
                if($mode == "commit"){  //efectuar update
                     $nombre = $this->input->post('nombre');
                     $apellido = $this->input->post('apellido');
                     $rut = $this->input->post('rut');
                     $celular = $this->input->post('celular');


                     $data = array("nombre" => $nombre,
                                  "apellido" => $apellido,
                                  "RUT" => $rut,
                                  "celular" => $celular,
                                  );

                    $this->Camionero_model->chofer_update_by_id($id,$data);
                    //$page_data['chofer_datos'] = $this->Crud_model->chofer_get_all_by_id($id, $idUserType);
                    redirect(base_url()."?".$usrtype."/choferes/show/0/none/$page",'refresh');
                }
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'choferes','Choferes');
                $this->load->view('index', $page_data);
            }
            else if($option == "del"){
                $this->Camionero_model->chofer_delete_by_id($id);
                redirect(base_url()."?".$usrtype."/choferes",'refresh');
            }
            if($option == "show"){
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'choferes','Choferes');
                $this->load->view('index', $page_data);
            }

        }


    }






    function misdatos($action = "none",$mode = "none") //upd emp = empresa o rep = representante
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

            if($action == "upd" && $mode == "emp"){
                $razon_social = $this->input->post('razon_social');
                 $rut = $this->input->post('rut');
                 $giro = $this->input->post('giro');
                 $direccion = $this->input->post('direccion');
                 $ciudad = $this->input->post('ciudad');
                 $prefix_fono = $this->input->post('prefix_fono');
                 $fono = $this->input->post('fono');
                 $fono = $prefix_fono." ".$fono;
                 $pag_web = $this->input->post('pag_web');
                 $acerca_de = $this->input->post('acerca_de');
                 $data = array("razon_social" => $razon_social,
                              "RUT" => $rut,
                              "giro" => $giro,
                              "direccion" => $direccion,
                              "ciudad" => $ciudad,
                              "fono" => $fono,
                              "pag_web" => $pag_web,
                              "acerca_de" => $acerca_de
                              );

                $this->Empresa_model->empresa_update_by_id($idAcc,$data);

            }
            if($action == "upd" && $mode == "rep"){
                $nombre_rep_legal = $this->input->post('nombre_rep_legal');
                //$rut_rep_legal = $this->input->post('rut_rep_legal');
                $prefix_fono_rep_legal = $this->input->post('prefix_fono_rep_legal');
                $fono_rep_legal = $this->input->post('fono_rep_legal');
                $fono_rep_legal = $prefix_fono_rep_legal." ".$fono_rep_legal;

                $prefix_fono_contacto = $this->input->post('prefix_fono_contacto');
                $fono_contacto = $this->input->post('fono_contacto');
                $fono_contacto = $prefix_fono_contacto." ".$fono_contacto;
                //$fono_contacto = $this->input->post('fono_contacto');
                $mail_contacto = $this->input->post('mail_contacto');
                $ciudad_contacto = $this->input->post('ciudad_contacto');


                $data = array("nombre_representante_legal" =>
                                $nombre_rep_legal,
                              //"rut_representante_legal" =>
                              //$rut_rep_legal,
                              "telefono_representante_legal" =>
                              $fono_rep_legal,
                              "fono_contacto" =>
                              $fono_contacto,
                              "mail_contacto" =>
                              $mail_contacto,
                              "ciudad_contacto" =>
                              $ciudad_contacto
                              );
                $this->Empresa_model->empresa_update_by_id($idAcc,$data);

            }
            $limit = 10;
            $page_data['mis_datos'] = $this->Empresa_model->fetch_tabla_empresa($idAcc,$limit, 0);
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'misdatos','Mis Datos');
            $this->load->view('index', $page_data);

        }


    }

     function verdatos($idoferta)
    {
        if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

            $status = '';
            $limit = 1;
            $start = 0;
            //$query = $this->Crud_model->match_ofertas_get_all_by_id(0,$idofertatransportista,$idofertacarga,$status, $modalidad,$limit,$start);

            //if(strval($query["estado_oferta"]) == '2'){
                $limit = 10;
                //cambiar idAcc por idEmpresa

                $query =  $this->Empresa_model->fetch_tabla_empresa_by_match($usrtype,$idoferta); //VER DATOS DE LA CONTRAPARTE
                if($query != false)
                   $page_data['mis_datos'] = $query; //VER DATOS DE LA CONTRAPARTE
            //}
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'verdatos','Datos Empresa');
            $this->load->view('index', $page_data);

        }


    }
    function verdatosJSON($idoferta)
   {

           $page_data = array();
           $idAcc = $this->session->userdata('userid');
           $usrtype = $this->session->userdata('login_type');
           $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
           $query =  $this->Empresa_model->fetch_all_tabla_empresa_by_match($usrtype,$idoferta); //VER DATOS DE LA CONTRAPARTE
           if($query != false){
             $page_data['datos_empresa'] = $query; //VER DATOS DE LA CONTRAPARTE
           }
          $result = json_encode($query);
          echo $result;

   }
    function get_distancia($idcity1, $idcity2){

        $distancia = $this->Generic_model->get_distancia_ciudades(intval($idcity1),intval($idcity2));
        $data = array("distancia" => $distancia);
        echo json_encode($data);
    }

    function actualizaMatchs(){
         $idAcc = $this->session->userdata('userid');
        $usrtype = $this->session->userdata('login_type');
        $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

        $resultado = $this->Engine_model->match_ofertas($usrtype,$idUserType); //incluye los match nuevos si no existe los crea.
        $data = $resultado;
        echo json_encode($data);
    }


    function ofrecercamion($action = "none")
    {
        if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

            $page_data["ciudades"] = $this->Generic_model->fetch_tabla('ciudad',600,0);
            $page_data["regiones"] = $this->Generic_model->fetch_tabla('region',20,0);
            $page_data["camiones"] = $this->Camionero_model->equipo_get_all_by_id(0,$idUserType);

            if($action == "add"){
                $idcamion           = $this->input->post('idcamion');
                $patente            = $this->Generic_model->get_field_by_id("camion",$idcamion,"patente")->patente;
                $tipo_camion        = $this->Generic_model->get_field_by_id("camion",$idcamion,"tipo")->tipo;
                //$tipo_camion        = $this->input->post('tipo');
                $ciudad_ubicacion   = $this->input->post('ciudad_ubicacion');
                $direccion_ubicacion= ''; //$this->input->post('direccion_ubicacion');
                $ciudad_destino     = $this->input->post('ciudad_destino');
                $direccion_destino  = ''; //$this->input->post('direccion_destino');
                $region_origen      = $this->input->post('region_origen');
                $region_destino     = $this->input->post('region_destino');
                $detalle            = $this->input->post('detalles');
                $aux_disp           = $this->input->post('fecha_disponibilidad');
                $aux_strtime = strtotime($aux_disp);
                $fecha_disponibilidad = date("Y-m-d H:i:s",$aux_strtime);

                 date_default_timezone_set('America/Argentina/Buenos_Aires');
                $data = array("patente" => $patente,
                               "tipo_camion" => $tipo_camion,
                               "region_ubicacion" => $region_origen,
                               "ubicacion" => $ciudad_ubicacion,
                               "direccion_ubicacion" => $direccion_ubicacion,
                               "region_destino" => $region_destino,
                               "destino_preferente" => $ciudad_destino,
                               "direccion_destino" => $direccion_destino,
                               "detalle" => $detalle,
                               "fecha_disponibilidad" => $fecha_disponibilidad,
                               "fecha_publicacion" =>  date("Y-m-d H:i:s"),
                               "idtransportista_fk" => $idUserType
                              );
                $this->Transportista_model->ofertatransportista_insert_by_id($data);

                $this->Engine_model->match_ofertas($usrtype,$idUserType);
                $msg = "Oferta Creada satisfactoriamente... Revise la oferta en sección Mis Ofertas";
                $page_data["msg_alerta"] = $msg;

            }
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'ofrecercamion','Ofrecer Camion');
            $this->load->view('index', $page_data);

        }


    }
    function buscarcarga($action="none",$idoferta = -1,$region_origen = -1, $region_destino=-1,$tipo_camion = -1, $tipo_carga = -1)
    {
        if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $tbls = json_decode(_TABLES);
            $tbl = json_decode(_TABLE);
            print_r($tbls);

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

            $page_data["ciudades"] = $this->Generic_model->fetch_tabla('ciudad',600,0);
            $page_data["regiones"] = $this->Generic_model->fetch_tabla('region',50,0);
            $page_data["tipos_camion"] = $this->Generic_model->get_tipo_equipo();
            $page_data["tipos_carga"] = $this->Generic_model->get_tipo_carga();

            if($action == "search"){

                $region_origen          = $this->input->post('region_origen');
                //$ciudad_origen          = $this->input->post('ciudad_origen');
                //---------------------------------------------------
                //$ciudad_destino         = $this->input->post('ciudad_destino');
                $region_destino          = $this->input->post('region_destino');


                $tipo_carga             = $this->input->post('tipo_carga');
                $tipo_camion            = $this->input->post('tipo_camion');
                $eslicitacion            = "0";
                if($region_origen != '' && $region_destino != '' && $tipo_carga !='' && $tipo_camion!=''){
                    $page_data["result"]    = $this->Transportista_model->ofertacarga_search($idUserType,$region_origen,$region_destino,$tipo_carga,$tipo_camion,$eslicitacion);


                }

            }
            if($action == "detalle"){
                $limit = 1;
                $start = 0;
                $modalidad = "none";
                $page_data["detalle"]  = $this->Transportista_model->get_ofertacarga_by_id($idoferta,'',$modalidad, $limit, $start);

            }
            $page_data["region_origen"] = $region_origen;
            $page_data["region_destino"] = $region_destino;
            $page_data["tipo_camion"] = $tipo_camion;
            $page_data["tipo_carga"] = $tipo_carga;
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'buscarcarga','Buscar Carga');
            $this->load->view('index', $page_data);

        }


    }



    function misofertas($action="none", $idofertatransportista=0)
    {
        if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

            //$limit=100;
            //$page_data["misofertas"] = $this->Crud_model->fetch_tabla_ofertatransportista($idUserType,$limit,0);


            $config = array();
            $page_data['num_ofertas'] = $this->Transportista_model->get_num_ofertatransportista_by_id($idUserType);
            $page_data["ciudades"] = $this->Generic_model->fetch_tabla('ciudad',600,0);

            $page_data["regiones"] = $this->Generic_model->fetch_tabla('region',20,0);
            $page_data["camiones"] = $this->Camionero_model->equipo_get_all_by_id(0,$idUserType);
            $page_data["idoferta"] = $idofertatransportista;
            $idoferta = $idofertatransportista;

            $config["base_url"] = base_url() . "?".$usrtype."/misofertas";
            $config["total_rows"] = $page_data['num_ofertas'];
            $config["per_page"] = 20; //20 antes
            $config["uri_segment"] = 3;

            $config['first_link'] = '<i class="fa fa-fast-backward"></i>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = '<i class="fa fa-fast-forward"></i>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '<i class="fa fa-step-forward"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '<i class="fa fa-step-backward"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $limit = $config["per_page"];
            $start = $page;
            $misofertas = $this->Transportista_model->fetch_tabla_ofertatransportista($idUserType,$limit,$start);

            $modalidad = "enviadas";
             if($action == "detalle"){
                $limit = 1;
                $start = 0;

                $page_data["detalle"]       = $this->Transportista_model->get_ofertatransportista_by_id($idofertatransportista,$idUserType, $modalidad,$limit, $start);

            }

             if($action == "upd"){
                $idcamion           = $this->input->post('idcamion');
                $patente            = $this->Generic_model->get_field_by_id("camion",$idcamion,"patente")->patente;
                $tipo_camion        = $this->Generic_model->get_field_by_id("camion",$idcamion,"tipo")->tipo;
                $ciudad_ubicacion   = $this->input->post('ciudad_ubicacion');
                //$direccion_ubicacion= $this->input->post('direccion_ubicacion');
                $direccion_ubicacion='';
                $ciudad_destino     = $this->input->post('ciudad_destino');
                //$direccion_destino  = $this->input->post('direccion_destino');
                $direccion_destino = '';

                $region_origen      = $this->input->post('region_origen');
                $region_destino     = $this->input->post('region_destino');

                $detalle            = $this->input->post('detalles');
                $aux_disp           = $this->input->post('fecha_disponibilidad');
                $aux_strtime = strtotime($aux_disp);
                $fecha_disponibilidad = date("Y-m-d H:i:s",$aux_strtime);

                 date_default_timezone_set('America/Argentina/Buenos_Aires');
                $data = array("patente" => $patente,
                               "tipo_camion" => $tipo_camion,
                               "region_ubicacion" => $region_origen,
                               "ubicacion" => $ciudad_ubicacion,
                               "direccion_ubicacion" => $direccion_ubicacion,
                               "region_destino" => $region_destino,
                               "destino_preferente" => $ciudad_destino,
                               "direccion_destino" => $direccion_destino,
                               "detalle" => $detalle,
                               "fecha_disponibilidad" => $fecha_disponibilidad,
                               "fecha_publicacion" =>  date("Y-m-d H:i:s"),
                               "idtransportista_fk" => $idUserType
                              );
                $this->Transportista_model->ofertatransportista_update_by_id($idoferta,$data);
                $this->Engine_model->match_ofertas($usrtype,$idUserType);
                redirect(base_url() . '?'.$usrtype.'/misofertas', 'refresh');

            }else if($action == "del"){
                $this->Transportista_model->ofertatransportista_delete_by_id($idoferta);
                redirect(base_url() . '?'.$usrtype.'/misofertas', 'refresh');

            }

            $page_data['misofertas'] = $misofertas;
            $page_data["links"] = $this->pagination->create_links();
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'misofertas','Mis Ofertas');
            $this->load->view('index', $page_data);

        }


    }

 function resolver_solicitudes($mode="show",$modalidad="solicitud",$idofertatransportista = 0,$idofertacarga = 0){
    if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);


            if($modalidad  == "oferta") $status = '0'; //solicitud libre para ofertas de cargas disponibles
            else if($modalidad =="solicitud") $status = '1'; // solicitud en espera => 1 mis ofertas
            $limit=100;
            $start=0;
            if($mode=="join"){
                $idmatch = $this->input->post('idmatch');
                $idofertatransportistaIN = $this->Generic_model->get_field_by_id("match_ofertas",$idmatch,"idofertatransportista")->idofertatransportista;
                $idofertacargaIN = $this->Generic_model->get_field_by_id("match_ofertas",$idmatch,"idofertacarga")->idofertacarga;
                $statusQ = 1;
                $status = 2;
                $idofertatransportista = $idofertatransportistaIN;
                $idofertacarga = 0;
                $desc = "Aceptado/En proceso";
                $this->Generic_model->table_update_by_id("ofertatransportista",$idofertatransportistaIN,"estado_oferta",$status);
                $this->Generic_model->table_update_by_id("ofertatransportista",$idofertatransportistaIN,"descripcion_estado",$desc);


                $missolicitudes = $this->Engine_model->match_ofertas_get_all_by_id(0,$idofertatransportista,$idofertacarga,$statusQ,$modalidad,$limit,$start); //idmatch, idoftrans, idcarga, limit, start

                foreach($missolicitudes as $row){ // actualizo las solicitudes, uno acepto el resto se rechazan..
                    $status = 1;
                    $desc = "";
                    if($row["idofertatransportista"] == $idofertatransportistaIN && $row["idofertacarga"] == $idofertacargaIN){
                        $status = 2;
                        $desc = "Aceptado/En proceso";
                        $status_offer = -2;
                        $desc_offer = "Rechazado/Inhabilitado para ofertar";

                        $this->Generic_model->table_update_by_id("ofertacarga",$row["idofertacarga"],"estado_oferta",$status);
                        $this->Generic_model->table_update_by_id("ofertacarga",$row["idofertacarga"],"descripcion_estado",$desc);

                        //////////////////////////////////////////////////////////////////////////////////
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud",$status);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud",$desc);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta",$status_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta",$desc_offer);

                        //Inhabilito la accion de ofertar con otro
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta_GC",$status);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta_GC",$desc);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud_GC",$status_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud_GC",$desc_offer);

                    }else{
                        $status = -2;
                        $desc = "Rechazado/Inhabilitado para solicitar";
                        $status_offer = -2;
                        $desc_offer = "Rechazado/Inhabilitado para ofertar";
                        //////////////////////////////////////////////////////////////////////////////////
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud",$status_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud",$desc_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta",$status_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta",$desc_offer);

                        //Inhabilito la accion de ofertar con otro
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta_GC",$status_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta_GC",$desc_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud_GC",$status_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud_GC",$desc_offer);

                    }


                }

            //update en match y en las ofertas!!
            }

            if($mode=="request"){
                $idmatch = $this->input->post('idmatch');
                $idofertatransportistaIN = $this->Generic_model->get_field_by_id("match_ofertas",$idmatch,"idofertatransportista")->idofertatransportista;
                $idofertacargaIN = $this->Generic_model->get_field_by_id("match_ofertas",$idmatch,"idofertacarga")->idofertacarga;
                $status = 0;
                $idofertacarga = $idofertacargaIN;
                $idofertatransportista = 0;
                $desc = "En espera";
                //$this->Generic_model->table_update_by_id("ofertatransportista",$idofertatransportistaIN,"estado_oferta",$status);
                //$this->Generic_model->table_update_by_id("ofertatransportista",$idofertatransportistaIN,"descripcion_estado",$desc);
                $missolicitudes = $this->Engine_model->match_ofertas_get_all_by_id(0,$idofertatransportista,$idofertacarga,$status,$modalidad,$limit,$start); //idmatch, idoftrans, idcarga, limit, start
                foreach($missolicitudes as $row){ // actualizo las solicitudes, uno acepto el resto se rechazan..
                    $status = 1;
                    $desc = "";
                    if($row["idofertatransportista"] == $idofertatransportistaIN && $row["idofertacarga"] == $idofertacargaIN){

                        $status = 1;
                        $desc = "En espera";
                        $status_offer = 1;
                        $desc_offer = "En espera";
                        $orden = $this->Crud_model->generateRandomToken(5);
                        $orden .= $row["idmatch"];
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"orden_carga",$orden);

                        if(intval($row["estado_solicitud"]) == 1){ //SOLICITADO POR LA CONTRAPARTE SE ACEPTA POR DEFECTO
                            $status_offer = 2; $desc_offer="Aceptado por defecto.";

                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta_GC",$status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta_GC",$desc_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud", $status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud",$desc_offer);

                            //Inhabilito el resto...
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta",-1*$status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta",-1*$desc_offer);

                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud_GC",-1*$status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud_GC",$desc_offer);


                        }
                        else{


                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta",$status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta",$desc_offer);
                            /////////////////////////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////////////////////////
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud_GC",$status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud_GC",$desc_offer);
                        }


                    }else{
                        $status = -2;
                        $desc = "Rechazado/Inhabilitado para solicitar";
                        $status_offer = -2;
                        $desc_offer = "Rechazado/Inhabilitado para ofertar";
                        //Inhabilito la accion de ofertar con otro
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta",$status_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta",$desc_offer);
                        /////////////////////////////////////////////////////////////////////////////////////////////////
                        /////////////////////////////////////////////////////////////////////////////////////////////////
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud_GC",$status);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud_GC",$desc);


                    }


                }

            //update en match y en las ofertas!!
            }
            if($modalidad  == "oferta") $status = '0'; //solicitud libre para ofertas de cargas disponibles
            else if($modalidad =="solicitud") $status = '1'; // solicitud en espera => 1 mis ofertas
            $missolicitudes = $this->Engine_model->match_ofertas_get_all_by_id(0,$idofertatransportista,$idofertacarga,$status,$modalidad,$limit,$start); //idmatch, idoftrans, idcarga, limit, startlimit, start


            if($modalidad == "solicitud"){

                $laoferta = $this->Transportista_model->get_ofertatransportista_by_id($idofertatransportista,'','enviadas',$limit,$start);

            }
            else if($modalidad == "oferta"){

                $laoferta = $this->Transportista_model->get_ofertacarga_by_id($idofertacarga,'','recibidas',$limit,$start);


            }


            $page_data['idofertatransportista'] = $idofertatransportista;
            $page_data['idofertacarga'] = $idofertacarga;
            $page_data['modalidad']     = $modalidad;
            $page_data['laoferta']      = $laoferta;


            $config = array();
            $config["base_url"] = base_url() .
            "?".$usrtype."/resolver_solicitudes/show/".$modalidad."/".$idofertatransportista."/".$idofertacarga;
            $config["total_rows"] = 10;//$page_data['num_ofertas'];
            $config["per_page"] = 20; //20 antes
            $config["uri_segment"] = 7;

            $config['first_link'] = '<i class="fa fa-fast-backward"></i>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = '<i class="fa fa-fast-forward"></i>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '<i class="fa fa-step-forward"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '<i class="fa fa-step-backward"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
            $limit = $config["per_page"];
            $start = $page;


            $page_data['missolicitudes'] = $missolicitudes;
            $page_data["links"] = $this->pagination->create_links();
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'resolver_solicitudes','Mis Solicitudes');
            $this->load->view('index', $page_data);

        }

 }



function missolicitudesenviadas($action="show",$idofertatransportista = 0){
    if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

            $page_data['idofertatransportista'] = $idofertatransportista;


            //$limit=100;
            //$page_data["misofertas"] = $this->Crud_model->fetch_tabla_ofertatransportista($idUserType,$limit,0);




            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/missolicitudesenviadas/".$action."/".$idofertatransportista;
            $config["total_rows"] = 10;//$page_data['num_ofertas'];
            $config["per_page"] = 20; //20 antes
            $config["uri_segment"] = 5;

            $config['first_link'] = '<i class="fa fa-fast-backward"></i>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = '<i class="fa fa-fast-forward"></i>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '<i class="fa fa-step-forward"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '<i class="fa fa-step-backward"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $limit = $config["per_page"];
            $start = $page;
             $modalidad = "enviadas";
             $status = '1'; // solicitud en espera => 1

            $missolicitudes = $this->Engine_model->get_match_ofertatransportista_by_id($idUserType,$status,$limit,$start,$modalidad);



             if($action == "detalle"){
                $limit = 1;
                $start = 0;

                 $page_data["detalle"]       = $this->Transportista_model->get_ofertatransportista_by_id($idofertatransportista,$idUserType, $modalidad,$limit, $start);

            }

            $page_data['missolicitudes'] = $missolicitudes;
            $page_data["links"] = $this->pagination->create_links();
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'missolicitudes_enviadas','Mis Solicitudes');
            $this->load->view('index', $page_data);

        }

 }
function missolicitudesrecibidas($action="show",$idofertatransportista = 0){
    if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
            $page_data['idofertatransportista'] = $idofertatransportista;


            //$limit=100;
            //$page_data["misofertas"] = $this->Crud_model->fetch_tabla_ofertatransportista($idUserType,$limit,0);


            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/missolicitudesrecibidas/".$action."/".$idofertatransportista;
            $config["total_rows"] = 10;//$page_data['num_ofertas'];
            $config["per_page"] = 20; //20 antes
            $config["uri_segment"] = 5;

            $config['first_link'] = '<i class="fa fa-fast-backward"></i>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = '<i class="fa fa-fast-forward"></i>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '<i class="fa fa-step-forward"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '<i class="fa fa-step-backward"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $limit = $config["per_page"];
            $start = $page;
            $status = '1'; // solicitud en espera => 1

            $modalidad = "recibidas";
            $missolicitudes = $this->Engine_model->get_match_ofertatransportista_by_id($idUserType,$status,$limit,$start,$modalidad);


            if($action == "detalle"){
                $limit = 1;
                $start = 0;

                 $page_data["detalle"]       = $this->Transportista_model->get_ofertatransportista_by_id($idofertatransportista,$idUserType, $modalidad,$limit, $start);

            }
            $page_data['missolicitudes'] = $missolicitudes;
            $page_data["links"] = $this->pagination->create_links();
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'missolicitudes_recibidas','Mis Solicitudes');
            $this->load->view('index', $page_data);

        }

 }

function historial($action="show",$idofertatransportista = 0){
    if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

            $page_data['idofertatransportista'] = $idofertatransportista;


            //$limit=100;
            //$page_data["misofertas"] = $this->Crud_model->fetch_tabla_ofertatransportista($idUserType,$limit,0);

            //idmatch, idoftrans, idcarga, limit, start

            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/historial/".$action."/".$idofertatransportista;
            $config["total_rows"] = 10;//$page_data['num_ofertas'];
            $config["per_page"] = 20; //20 antes
            $config["uri_segment"] = 5;

            $config['first_link'] = '<i class="fa fa-fast-backward"></i>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = '<i class="fa fa-fast-forward"></i>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '<i class="fa fa-step-forward"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '<i class="fa fa-step-backward"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $limit = $config["per_page"];
            $start = $page;
            $status = ''; // solicitud en espera => 1
            $modalidad = "both";
            $missolicitudes = $this->Engine_model->get_match_ofertatransportista_by_id($idUserType,$status,$limit,$start,$modalidad);


            if($action == "detalle"){
                $limit = 1;
                $start = 0;

                $page_data["detalle"]       = $this->Transportista_model->get_ofertatransportista_by_id($idofertatransportista,$idUserType, $modalidad,$limit, $start);


            }
            $page_data['missolicitudes'] = $missolicitudes;
            $page_data["links"] = $this->pagination->create_links();
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'historial','Mi Historial');
            $this->load->view('index', $page_data);

        }

 }
 function reactivate($id=0){
    if ($this->session->userdata('user_login') != 1  || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            if($id > 0)
                $this->Transportista_model->reactivate_oferta($id);

            redirect(base_url().'?'.$usrtype.'/historial','refresh');

        }

 }
      /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'?Login' , 'refresh');
    }

}
