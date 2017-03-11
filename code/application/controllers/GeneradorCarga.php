<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @author : Joyonto Roy
 *  date    : 20 August, 2013
 *  University Of Dhaka, Bangladesh
 *  Ekattor School & College Management System
 *  http://codecanyon.net/user/joyontaroy
 */

class GeneradorCarga extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('Crud_model');
        $this->load->model('Email_model');
        $this->load->model('Generic_model');
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
            $page_data['publicaciones'] = $this->Engine_model->get_lastPublicaciones($idUserType, $usrtype, $idAcc,$status);
            $page_data['agendados'] = $this->Engine_model->get_lastPublicaciones($idUserType, $usrtype, $idAcc,$status2);

            $page_data['num_cuentas'] = $this->Generic_model->get_num_filas("account");
            $page_data['num_cargas'] = $this->Generadorcarga_model->ofertacarga_get_num();
            $page_data['num_transportes'] = $this->Generadorcarga_model->ofertatransportista_get_num();
            $idAcc = $this->session->userdata('userid');
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'dashboard','Dashboard');
                       $email_msg="Hola";
             $email_sub="Test";
              $email_to = "xujafafa@divismail.ru";
            $this->Email_model->do_email($email_msg , $email_sub , $email_to);
            $this->load->view('index', $page_data);

        }
    }

     function sucursal()
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();

            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'sucursal','Sucursal');

            $this->load->view('index', $page_data);

        }


    }

    function contactosucursal($action = "show",$id = 0)
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();

            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
            $page_data['sucursales'] = $this->Empresa_model->sucursales_get_all_by_id(0,$idAcc); //listar todas

            $id = 1;
            if($action == "upd"){
                $nombre = $this->input->post('nombre');
                $telefono = $this->input->post('telefono');
                $email = $this->input->post('email');
                $direccion = $this->input->post('direccion');

                 $data = array("nombre" => $nombre,
                              "telefono" => $telefono,
                              "email" => $email,
                              "direccion" => $direccion
                              );
                $this->Empresa_model->sucursal_update_by_id($id,$data);

            }
            if($action == "show")
            {

            }
            if($id > 0)
                $page_data['mis_datos'] = $this->Empresa_model->sucursales_get_all_by_id($id,$idAcc);

            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'contactosucursal','Contacto Sucursal');
            $this->load->view('index', $page_data);

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
            $id = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');

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
                $this->Empresa_model->empresa_update_by_id($id,$data);

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
                $this->Empresa_model->empresa_update_by_id($id,$data);

            }
            $limit = 10;
            $page_data['mis_datos'] = $this->Empresa_model->fetch_tabla_empresa($id,$limit, 0);
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'misdatos','Mis Datos');

            $this->load->view('index', $page_data);

        }


    }

    function verdatos($idoferta)
    {
        if ($this->session->userdata('user_login') != 1 || $this->session->userdata('enabled') != 1){
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

        $resultado = $this->Crud_model->match_ofertas($usrtype,$idUserType); //incluye los match nuevos si no existe los crea.
        $data = $resultado;
        //$data = array("total" => $total_reg);
        echo json_encode($data);
    }


    function ofrecercarga($action = "none")
    {
        if ($this->session->userdata('user_login') != 1 || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();

            $page_data["regiones"] = $this->Crud_model->fetch_tabla('region',50,0);
            $page_data["ciudadesAll"] = $this->Crud_model->fetch_tabla('ciudad',600,0);
            $page_data["ciudades"] = $this->Crud_model->fetch_tabla('ciudad',600,0);
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
            $page_data["tipos_camion"] = $this->Generic_model->get_tipo_equipo();
            $page_data["tipos_carga"] = $this->Generic_model->get_tipo_carga();

            $page_data["distancia"] = $this->Generic_model->get_distancia_ciudades(377,384);

            $limit = 1;
            $page_data["datos_empresa"] = $this->Empresa_model->fetch_tabla_empresa($idAcc,$limit,0);


            if($action == "add"){
                $region_origen            = $this->input->post('region_origen');
                $ciudad_origen            = $this->input->post('ciudad_origen');
                $direccion_origen            = $this->input->post('direccion_origen');
                //---------------------------------------------------
                $region_destino            = $this->input->post('region_destino');
                $ciudad_destino            = $this->input->post('ciudad_destino');
                $direccion_destino        = $this->input->post('direccion_destino');
                //-------------------------------------------------------------
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $distancia   = $this->input->post('distancia');
                $distancia   = (!is_numeric($distancia))? "-1": $distancia;
                $aux_carga     = $this->input->post('fecha_carga');
                $aux_strtimecar = strtotime($aux_carga);
                $fecha_carga = date("Y-m-d H:i:s",$aux_strtimecar);

                $aux_descarga     = $this->input->post('fecha_descarga');
                $aux_strtimedesc = strtotime($aux_descarga);
                $fecha_descarga = date("Y-m-d H:i:s",$aux_strtimedesc);

                $cantidad_carga  = $this->input->post('cantidad_carga');
                $tipo_carga            = $this->input->post('tipo_carga');
                $tipo_camion            = $this->input->post('tipo_camion');
                $precio            = $this->input->post('precio');
                $detalle           = $this->input->post('detalle');
                $esLicitacion           =  '0'; //$this->input->post('esLicitacion');
                $num_viajes           = '1'; //$this->input->post('num_viajes');


                $data = array("origen_region" => $region_origen,
                               "origen_ciudad" => $ciudad_origen,
                               "origen_direccion" => $direccion_origen,
                               "destino_region" => $region_destino,
                               "destino_ciudad" => $ciudad_destino,
                               "destino_direccion" => $direccion_destino,
                               "distancia" => $distancia,
                               "fecha_carga" => $fecha_carga,
                               "fecha_descarga" => $fecha_descarga,
                               "cantidad_carga" => $cantidad_carga,
                               "tipo_carga" => $tipo_carga,
                               "tipo_camion" =>  $tipo_camion,
                               "precio" =>  $precio,
                               "detalle" =>  $detalle,
                               "esLicitacion" =>  $esLicitacion,
                               "cantidad_viajes" =>  $num_viajes,
                               "fecha_publicacion" => date("Y-m-d"),
                               "idgeneradorcarga_fk" => $idUserType
                              );
                $this->Generadorcarga_model->ofertacarga_insert_by_id($data);
                $this->Engine_model->match_ofertas($usrtype,$idUserType);
                $msg = "Oferta Creada satisfactoriamente... Revise la oferta en sección Mis Ofertas";
                $page_data["msg_alerta"] = $msg;
                
                $this->Engine_model->match_ofertas($usrtype,$idUserType);

            }
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'ofrecercarga','Ofrecer Carga');
            $this->load->view('index', $page_data);

        }


    }
    function buscarcamion($action="none",$idoferta=-1, $region_origen = -1, $region_destino=-1,$tipo_camion = -1,$doble_puente="0")
    {
        if ($this->session->userdata('user_login') != 1 || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();

            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

            $page_data["ciudades"] = $this->Crud_model->fetch_tabla('ciudad',600,0);
            $page_data["regiones"] = $this->Crud_model->fetch_tabla('region',600,0);
            $page_data["tipos_camion"] = $this->Crud_model->get_tipo_equipo();


            if($action == "search"){

                 $region_origen          = $this->input->post('region_origen');
                //$ciudad_origen          = $this->input->post('ciudad_origen');
                //---------------------------------------------------
                //$ciudad_destino         = $this->input->post('ciudad_destino');
                $region_destino          = $this->input->post('region_destino');
                $tipo_camion            = $this->input->post('tipo_camion');
                $doble_puente            = $this->input->post('doble_puente');

                if($region_origen != '' && $region_destino != '' && $tipo_camion!=''){
                    $page_data["result"]    = $this->Generadorcarga_model->ofertatransportista_search($idUserType,$region_origen,$region_destino,$tipo_camion, $doble_puente);
                }


            }
            if($action == "detalle"){
                $limit = 1;
                $start = 0;
                $modalidad = "none";
                $page_data["detalle"]  = $this->Crud_model->get_ofertatransportista_by_id($idoferta,'',$modalidad, $limit, $start);

            }

            $page_data["region_origen"] = $region_origen;
            $page_data["region_destino"] = $region_destino;
            $page_data["tipo_camion"] = $tipo_camion;
            $page_data["tipo_carga"] = $tipo_carga;
            $page_data["doble_puente"] = $doble_puente;
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'buscarcamion','Buscar Camion');

            $this->load->view('index', $page_data);

        }


    }

    function misofertas($action="none", $idoferta=0)
    {
        if ($this->session->userdata('user_login') != 1 || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();

            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

            $page_data["regiones"] = $this->Generic_model->fetch_tabla('region',50,0);
            $page_data["ciudades"] = $this->Generic_model->fetch_tabla('ciudad',600,0);
            $page_data["tipos_camion"] = $this->Generic_model->get_tipo_equipo();
            $page_data["tipos_carga"] = $this->Generic_model->get_tipo_carga();
            $limit = 1;
            $page_data["datos_empresa"] = $this->Empresa_model->fetch_tabla_empresa($idAcc,$limit,0);


            $page_data["idoferta"] = $idoferta;
            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/misofertas";
            $config["total_rows"] = 10; //$page_data['num_ofertas'];
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

            $modalidad = "enviadas";

            if($action == "upd"){
                $region_origen            = $this->input->post('region_origen');
                $ciudad_origen            = $this->input->post('ciudad_origen');
                $direccion_origen            = $this->input->post('direccion_origen');
                //---------------------------------------------------
                $region_destino            = $this->input->post('region_destino');
                $ciudad_destino            = $this->input->post('ciudad_destino');
                $direccion_destino        = $this->input->post('direccion_destino');
                //-------------------------------------------------------------
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $distancia   = $this->input->post('distancia');
                $aux_carga     = $this->input->post('fecha_carga');
                $aux_strtimecar = strtotime($aux_carga);
                $fecha_carga = date("Y-m-d H:i:s",$aux_strtimecar);

                $aux_descarga     = $this->input->post('fecha_descarga');
                $aux_strtimedesc = strtotime($aux_descarga);
                $fecha_descarga = date("Y-m-d H:i:s",$aux_strtimedesc);

                $cantidad_carga  = $this->input->post('cantidad_carga');
                $tipo_carga            = $this->input->post('tipo_carga');
                $tipo_camion            = $this->input->post('tipo_camion');
                $precio            = $this->input->post('precio');
                $detalle           = $this->input->post('detalle');


                $data = array("origen_region" => $region_origen,
                               "origen_ciudad" => $ciudad_origen,
                               "origen_direccion" => $direccion_origen,
                               "destino_region" => $region_destino,
                               "destino_ciudad" => $ciudad_destino,
                               "destino_direccion" => $direccion_destino,
                               "distancia" => $distancia,
                               "fecha_carga" => $fecha_carga,
                               "fecha_descarga" => $fecha_descarga,
                               "cantidad_carga" => $cantidad_carga,
                               "tipo_carga" => $tipo_carga,
                               "tipo_camion" =>  $tipo_camion,
                               "precio" =>  $precio,
                               "detalle" =>  $detalle,
                               "idgeneradorcarga_fk" => $idUserType
                              );
                $this->Generadorcarga_model->ofertacarga_update_by_id($idoferta,$data);
                $this->Engine_model->match_ofertas($usrtype,$idUserType);
                redirect(base_url() . '?'.$usrtype.'/misofertas', 'refresh');

            }
            else if($action == "off"){
                $data = array("fecha_publicacion" => date("Y-m-d")
                              );
                $this->Generadorcarga_model->ofertacarga_update_by_id($idoferta,$data);
                redirect(base_url() . '?'.$usrtype.'/misofertas', 'refresh');

            }
            else if($action == "del"){
                $this->Generadorcarga_model->ofertacarga_delete_by_id($idoferta);
                redirect(base_url() . '?'.$usrtype.'/misofertas', 'refresh');

            }


            if($action == "detalle"){
                $limit = 1;
                $start = 0;
                $modalidad = "none";
                $page_data["detalle"]  = $this->Generadorcarga_model->get_ofertacarga_by_id($idoferta,'',$modalidad, $limit, $start);

            }

            $misofertas = $this->Generadorcarga_model->fetch_tabla_ofertacarga($idUserType,$limit,$start);
            $page_data['misofertas'] = $misofertas;

            $page_data["links"] = $this->pagination->create_links();
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'misofertas','Mis Ofertas');

            $this->load->view('index', $page_data);

        }


    }

    function resolver_solicitudes($mode="show",$modalidad="solicitud",$idofertatransportista = 0,$idofertacarga = 0){
    if ($this->session->userdata('user_login') != 1 || $this->session->userdata('enabled') != 1){
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
                $status = 2;
                $statusQ = 1; //para query
                $idofertatransportista = 0;
                $idofertacarga = $idofertacargaIN;
                $desc = "Aceptado/En proceso";
                $this->Generic_model->table_update_by_id("ofertacarga",$idofertacargaIN,"estado_oferta",$status);
                $this->Generic_model->table_update_by_id("ofertacarga",$idofertacargaIN,"descripcion_estado",$desc);


                $missolicitudes = $this->Engine_model->match_ofertas_get_all_by_id(0,$idofertatransportista,$idofertacarga,$statusQ,$modalidad,$limit,$start); //idmatch, idoftrans, idcarga, limit, start

                foreach($missolicitudes as $row){ // actualizo las solicitudes, uno acepto el resto se rechazan..
                    $status = "1";
                    $desc = "";
                    if($row["idofertatransportista"] == $idofertatransportistaIN && $row["idofertacarga"] == $idofertacargaIN){
                        $status = "2";
                        $desc = "Aceptado/En proceso";
                        $status_offer = "-2";
                        $desc_offer = "Rechazado/Inhabilitado para ofertar";

                        $this->Generic_model->table_update_by_id("ofertatransportista",$row["idofertatransportista"],"estado_oferta",$status);
                        $this->Generic_model->table_update_by_id("ofertatransportista",$row["idofertatransportista"],"descripcion_estado",$desc);

                        //////////////////////////////////////////////////////////////////////////////////
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud_GC",$status);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud_GC",$desc);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta_GC",$status_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta_GC",$desc_offer);

                        //Inhabilito la accion de ofertar con otro
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta",$status);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta",$desc);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud",$status_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud",$desc_offer);

                    }else{
                        $status = "-2";
                        $desc = "Rechazado/Inhabilitado para solicitar";
                        $status_offer = "-2";
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
                $idofertatransportista = $idofertatransportistaIN;
                $idofertacarga = 0;
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
                        if(intval($row["estado_solicitud_GC"]) == 1){ //SOLICITADO POR LA CONTRAPARTE SE ACEPTA POR DEFECTO
                            $status_offer = 2; $desc_offer="Aceptado por defecto.";

                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta",$status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta",$desc_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud_GC", $status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud_GC",$desc_offer);

                            //Inhabilito el resto...
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta_GC",-1*$status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta_GC",-1*$desc_offer);

                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud",-1*$status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud",$desc_offer);


                        }
                        else{


                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta_GC",$status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta_GC",$desc_offer);
                            /////////////////////////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////////////////////////
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud",$status_offer);
                            $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud",$desc_offer);
                        }




                    }else{
                        $status = -2;
                        $desc = "Rechazado/Inhabilitado para solicitar";
                        $status_offer = -2;
                        $desc_offer = "Rechazado/Inhabilitado para ofertar";
                        //Inhabilito la accion de ofertar con otro
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_oferta_GC",$status_offer);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_oferta_GC",$desc_offer);
                        /////////////////////////////////////////////////////////////////////////////////////////////////
                        /////////////////////////////////////////////////////////////////////////////////////////////////
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"estado_solicitud",$status);
                        $this->Generic_model->table_update_by_id("match_ofertas",$row["idmatch"],"descripcion_estado_solicitud",$desc);


                    }


                }

            //update en match y en las ofertas!!
            }
            if($modalidad  == "oferta") $status = '0'; //solicitud libre para ofertas de cargas disponibles
            else if($modalidad =="solicitud") $status = '1'; // solicitud en espera => 1 mis ofertas
            $missolicitudes = $this->Engine_model->match_ofertas_get_all_by_id(0,$idofertatransportista,$idofertacarga,$status,$modalidad,$limit,$start); //idmatch, idoftrans, idcarga, limit, startlimit, start
            if($modalidad == "solicitud"){

                $laoferta = $this->Generadorcarga_model->get_ofertacarga_by_id($idofertacarga,'','recibidas',$limit,$start);

            }
            else if($modalidad == "oferta"){

                $laoferta = $this->Generadorcarga_model->get_ofertatransportista_by_id($idofertatransportista,'','enviadas',$limit,$start);

            }

            $page_data['idofertatransportista'] = $idofertatransportista;
            $page_data['idofertacarga'] = $idofertacarga;
            $page_data['modalidad']     = $modalidad;
            $page_data['laoferta']      = $laoferta;


            $config = array();
            $config["base_url"] = base_url() .
            "?".$usrtype."/resolver_solicitudes/".$mode."/".$modalidad."/".$idofertatransportista."/".$idofertacarga;
            $config["total_rows"] = $page_data['num_ofertas'];
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
   /*  function misofertas_editar($idoferta, $action = "none")
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();

            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
            $page_data["regiones"] = $this->Crud_model->fetch_tabla('region',50,0);
            $page_data["ciudades"] = $this->Crud_model->fetch_tabla('ciudad',600,0);
            $page_data["tipos_camion"] = $this->Crud_model->get_tipo_equipo();
            $page_data["tipos_carga"] = $this->Crud_model->get_tipo_carga();
            $limit = 1;
            $page_data["datos_empresa"] = $this->Crud_model->fetch_tabla_empresa($idAcc,$limit,0);


            $page_data["idoferta"] = $idoferta;
            $limit = 10;

            if($action == "upd"){
                $region_origen            = $this->input->post('region_origen');
                $ciudad_origen            = $this->input->post('ciudad_origen');
                $direccion_origen            = $this->input->post('direccion_origen');
                //---------------------------------------------------
                $region_destino            = $this->input->post('region_destino');
                $ciudad_destino            = $this->input->post('ciudad_destino');
                $direccion_destino        = $this->input->post('direccion_destino');
                //-------------------------------------------------------------
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $distancia   = $this->input->post('distancia');
                $aux_carga     = $this->input->post('fecha_carga');
                $aux_strtimecar = strtotime($aux_carga);
                $fecha_carga = date("Y-m-d H:i:s",$aux_strtimecar);

                $aux_descarga     = $this->input->post('fecha_descarga');
                $aux_strtimedesc = strtotime($aux_descarga);
                $fecha_descarga = date("Y-m-d H:i:s",$aux_strtimedesc);

                $cantidad_carga  = $this->input->post('cantidad_carga');
                $tipo_carga            = $this->input->post('tipo_carga');
                $tipo_camion            = $this->input->post('tipo_camion');
                $precio            = $this->input->post('precio');
                $detalle           = $this->input->post('detalle');


                $data = array("origen_region" => $region_origen,
                               "origen_ciudad" => $ciudad_origen,
                               "origen_direccion" => $direccion_origen,
                               "destino_region" => $region_destino,
                               "destino_ciudad" => $ciudad_destino,
                               "destino_direccion" => $direccion_destino,
                               "distancia" => $distancia,
                               "fecha_carga" => $fecha_carga,
                               "fecha_descarga" => $fecha_descarga,
                               "cantidad_carga" => $cantidad_carga,
                               "tipo_carga" => $tipo_carga,
                               "tipo_camion" =>  $tipo_camion,
                               "precio" =>  $precio,
                               "detalle" =>  $detalle,
                               "idgeneradorcarga_fk" => $idUserType
                              );
                $this->Generadorcarga_model->ofertacarga_update_by_id($idoferta,$data);

                redirect(base_url() . '?'.$usrtype.'/misofertas', 'refresh');

            }
            else if($action == "off"){
                $data = array("fecha_publicacion" => date("Y-m-d")
                              );
                $this->Generadorcarga_model->ofertacarga_update_by_id($idoferta,$data);
                redirect(base_url() . '?'.$usrtype.'/misofertas', 'refresh');

            }
            else if($action == "del"){
                $this->Generadorcarga_model->ofertacarga_delete_by_id($idoferta);
                redirect(base_url() . '?'.$usrtype.'/misofertas', 'refresh');

            }
            //data
            $start = 0;
            $status = ''; // solicitud en espera => 1
            $modalidad = "enviadas";
            $page_data["oferta"] = $this->Generadorcarga_model->get_ofertacarga_by_id($idoferta,$idUserType,$modalidad,$limit,$start);

            if($action == "none"){
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'ofrecercarga_editar','Editar Oferta');

                $this->load->view('index', $page_data);
            }
        }


    }
*/
  
function missolicitudesrecibidas($action="show",$idoferta = 0){
    if ($this->session->userdata('user_login') != 1 || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();

            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

             $page_data['num_ofertas'] = $this->Crud_model->get_num_ofertacarga_by_id($idUserType);
            $page_data['num_solicitudes_enviadas'] = $this->Crud_model->get_num_match_ofertacarga_by_id($idUserType,'','enviadas');
            $page_data['num_solicitudes_recibidas'] = $this->Crud_model->get_num_match_ofertacarga_by_id($idUserType,'','recibidas');
            $page_data['num_historial'] = $this->Crud_model->get_num_match_ofertacarga_by_id($idUserType,'','both');

            $page_data['idofertacarga'] = $idoferta;


            //$limit=100;
            //$page_data["misofertas"] = $this->Crud_model->fetch_tabla_ofertatransportista($idUserType,$limit,0);


            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/missolicitudesrecibidas/".$action."/".$idoferta;
            $config["total_rows"] = 10; //$page_data['num_ofertas'];
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
            $missolicitudes = $this->Engine_model->get_match_ofertacarga_by_id($idUserType,$status,$limit,$start,$modalidad);



            if($action == "detalle"){
                $limit = 1;
                $start = 0;
                $modalidad = "none";
                $page_data["detalle"]  = $this->Generadorcarga_model->get_ofertatransportista_by_id($idoferta,'',$modalidad, $limit, $start);

            }

            $page_data['missolicitudes'] = $missolicitudes;
            $page_data["links"] = $this->pagination->create_links();
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'missolicitudes_recibidas','Mis Solicitudes');

            $this->load->view('index', $page_data);

        }

 }

function historial($action="show",$idoferta = 0){
    if ($this->session->userdata('user_login') != 1 || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
            $page_data['idofertatransportista'] = $idoferta;

            //$limit=100;
            //$page_data["misofertas"] = $this->Crud_model->fetch_tabla_ofertatransportista($idUserType,$limit,0);

            //idmatch, idoftrans, idcarga, limit, start

            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/historial/".$action."/".$idoferta;
            $config["total_rows"] = 10; // $page_data['num_ofertas'];
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
            $missolicitudes = $this->Engine_model->get_match_ofertacarga_by_id($idUserType,$status,$limit,$start,$modalidad);



            if($action == "detalle"){
                $limit = 1;
                $start = 0;
                $modalidad = "none";
                $page_data["detalle"]  = $this->Generadorcarga_model->get_ofertatransportista_by_id($idoferta,'',$modalidad, $limit, $start);

            }

            $page_data['missolicitudes'] = $missolicitudes;
            $page_data["links"] = $this->pagination->create_links();
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'historial','Mi Historial');

            $this->load->view('index', $page_data);

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
