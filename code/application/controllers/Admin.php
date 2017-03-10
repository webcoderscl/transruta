<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	@author : Joyonto Roy
 *	date	: 20 August, 2013
 *	University Of Dhaka, Bangladesh
 *   Nulled By Vokey
 *	Ekattor School & College Management System
 *	http://codecanyon.net/user/joyontaroy
 */

class Admin extends CI_Controller
{


    function __construct()
    {
        parent::__construct();


        $this->load->model('Admin_model');

        $this->load->database();
        $this->load->library("pagination");
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {


        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . '?Login', 'refresh');
        if ($this->session->userdata('admin_login') == 1){
            $usertype = $this->session->userdata('login_type');
            redirect(base_url() . '?'.$usertype.'/dashboard', 'refresh');
        }


    }


    function verdatosPerfilJSON($idaccount)
    {

           $page_data = array();
           $idAcc = $this->session->userdata('userid');
           $usrtype = $this->session->userdata('login_type');
           $query =  $this->Empresa_model->fetch_all_tabla_empresa_by_acc($idaccount); //VER DATOS DE LA CONTRAPARTE
           if($query != false){
             $page_data['datos_empresa'] = $query; //VER DATOS DE LA CONTRAPARTE
           }
          $result = json_encode($query);
          echo $result;
    }

    function actualizaMatchs(){
         $idAcc = $this->session->userdata('userid');
        $usrtype = $this->session->userdata('login_type');
        $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

        //$resultado = $this->Engine_model->match_ofertas($usrtype,$idUserType); //incluye los match nuevos si no existe los crea.
        //$data = $resultado;
        $data = array("total" => 0);
        echo json_encode($data);
    }

    function fetch_otras_ciudades($idciudad)
    {
    	$resp = $this->Admin_model->fetch_tabla_ciudades_otras($idciudad);
    	echo json_encode($resp);
    }
    /***ADMIN DASHBOARD***/
    function dashboard($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            if($param1 != ''){
                $page_data['msg'] = $param1;
            }

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);

            $page_data['num_cargas_disp'] = $this->Crud_model->ofertacarga_get_num();
            $page_data['num_transportes_disp'] = $this->Crud_model->ofertatransportista_get_num();

            //$this->session->keep_flashdata('flash_message');
            $page_data['flash_message'] = $this->session->flashdata('flash_message');
            //$this->Admin_model->insertCode(75000);
            //$this->session->set_flashdata('flash_message',$this->session->userdata('flash_message'));

            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'dashboard','Dashboard');
            $this->load->view('index', $page_data);
        }


    }

    /*
    * CUENTAS
    */

     function cuentas($option = "show", $id = 0 , $mode = "none") //mode es para upd //cargaS = carga
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $tablename = 'account';

            //$page_data['num_ofertas'] = $this->Admin_model->get_num_ofertatransportista_by_id($idUserType);
            //$page_data['cargas'] = $this->Admin_model->carga_get_all_by_id(0,$idUserType);


            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/cuentas/$option/$id/$mode";
            $config["total_rows"] = $page_data['num_cuentas'];
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
            $page_data['cuentas'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);
            //print_r($page_data["regiones"]);
            $page_data["links"] = $this->pagination->create_links();


            if($option == "add"){

                 $Muser = $this->input->post('Muser');
                 $raw_password = $this->input->post('Mpassword');
                 $acctype = $this->input->post('tipo');
                 $saltlen = 10;
                 $salt = $this->Admin_model->generateRandomString($saltlen,0);
                 $password = sha1($raw_password.$salt);
                 $data = array(
                                "Muser" => $Muser,
                                "Mpassword" => $password,
                                "salt" => $salt,
                                "usertype" => $acctype
                              );
                $this->Admin_model->table_insert($tablename,$data);
                $idacc = $this->db->insert_id();
                if($acctype == 1){
                    $tabletype = "transportista";
                    $this->Admin_model->table_insert($tabletype,array('idaccount' => $idacc));
                    $this->Admin_model->table_insert("empresa",array('idaccount' => $idacc));

                }else if($acctype== 2){
                    $tabletype = "generadorcarga";
                    $this->Admin_model->table_insert($tabletype,array('idaccount' => $idacc));
                    $this->Admin_model->table_insert("empresa",array('idaccount' => $idacc));
                }
                $email_sub = "Creación de Cuenta";
               	$usertype = ($acctype == "0")?"Admin":(($acctype == "1")?"Transportista":"GeneradorCarga");
                $result = $this->Email_model->sendCredentials($Muser,$email_sub,$usertype,$raw_password);
                //$this->load->view('index', $page_data);
                redirect(base_url()."?".$usrtype."/cuentas",'refresh');
            }

            else if($option == "upd" && $id > 0){
                $page_data['cuenta_datos'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);
                if($mode == "commit"){  //efectuar update
                	$acctype = $this->Admin_model->get_datafield_by_id($tablename, $id, "usertype");
                    $Muser = $this->input->post('Muser');
                    $raw_password = $this->input->post('Mpassword');
                    $saltlen = 10;
                    $salt = $this->Admin_model->generateRandomString($saltlen);
                    $password = sha1($raw_password.$salt);
                    $data = array(
                                "Muser" => $Muser,
                                "Mpassword" => $password,
                                "salt" => $salt

                              );
                    $this->Admin_model->table_update($tablename,$id,$data);

                	$email_sub = "Recuperación de Cuenta";
	                $usertype = ($acctype == "0")?"Admin":(($acctype == "1")?"Transportista":"GeneradorCarga");
	                $result = $this->Email_model->sendCredentials($Muser,$email_sub,$usertype,$raw_password);
                    //$page_data['chofer_datos'] = $this->Admin_model->chofer_get_all_by_id($id, $idUserType);
                    redirect(base_url()."?".$usrtype."/cuentas",'refresh');
                }
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'cuentas','Cuentas');
                $this->load->view('index', $page_data);
            }
            if($option == "prof" && $id > 0){

                $name_legal_rep = $this->input->post('name_legal_rep'); //nombre rep legal
                $rut_legal_rep = $this->input->post('rut_legal_rep'); //rut rep legal
                $business_name = $this->input->post('business_name'); //razon social
                $rut = $this->input->post('rut'); //rut empresa
                $line_of_business = $this->input->post('line_of_business'); //giro
                $phone = $this->input->post('phone'); //fono
                $contact_phone = $this->input->post('contact_phone'); //fono contacto
                $city = $this->input->post('city'); //ciudad
                $contact_city = $this->input->post('contact_city'); //ciudad contacto
                $contact_mail = $this->input->post('contact_mail'); //mail contacto
                $address = $this->input->post('address'); //direccion
                $idemp = $this->Generic_model->get_id_by_fieldname("empresa", "idaccount",$id)->idempresa;
                $data = array(
                            "razon_social" => $business_name,
                            "RUT" => $rut,
                            "giro" => $line_of_business,
                            "fono" => $phone,
                            "fono_contacto" => $contact_phone,
                            "mail_contacto" => $contact_mail,
                            "direccion" => $address,
                            "ciudad" => $city,
                            "ciudad_contacto" => $contact_city,
                            "nombre_representante_legal" => $name_legal_rep,
                            "rut_representante_legal" => $rut_legal_rep,
                        );

                $this->Admin_model->table_update("empresa",$idemp,$data);
                redirect(base_url()."?".$usrtype."/cuentas",'refresh');
            }

            if($option == "del"){
                $acctype = $this->Admin_model->get_datafield_by_id($tablename, $id, "usertype");
                print_r($acctype);
                if($acctype == 1){
                    $tabletype = "transportista";
                }else if($acctype== 2){
                    $tabletype = "generadorcarga";
                }
                //$this->Admin_model->delete_by_id($tabletype,array('idaccount' => $idacc));
                //$this->Admin_model->delete_by_id("empresa",array('idaccount' => $idacc));
                $this->Admin_model->delete_by_id($tablename,$id);
                redirect(base_url()."?".$usrtype."/cuentas",'refresh');
            }
            if($option == "hab"){
                $acctype = $this->Admin_model->get_datafield_by_id($tablename, $id, "usertype");
                //print_r($acctype);
                if($acctype == 1){
                    $tabletype = "transportista";
                }else if($acctype== 2){
                    $tabletype = "generadorcarga";
                }
                //$this->Admin_model->delete_by_id($tabletype,array('idaccount' => $idacc));
                //$this->Admin_model->delete_by_id("empresa",array('idaccount' => $idacc));
                $this->Generic_model->table_update_by_id('account',$id,'habilitado',1);
                redirect(base_url()."?".$usrtype."/cuentas",'refresh');
            }

            if($option == "show"){
            	$page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'cuentas','Cuentas');
                $this->load->view('index', $page_data);
            }

        }


    }

    /*
    * CUENTAS
    */

     function empresas($option = "show", $id = 0 , $mode = "none") //mode es para upd //cargaS = carga
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $tablename = 'account';

            //$page_data['num_ofertas'] = $this->Admin_model->get_num_ofertatransportista_by_id($idUserType);
            //$page_data['cargas'] = $this->Admin_model->carga_get_all_by_id(0,$idUserType);


            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/empresas/$option/$id/$mode";
            $config["total_rows"] = $page_data['num_cuentas'];
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
            $page_data['empresas'] = $this->Empresa_model->get_all_empresas();
            //print_r($page_data["regiones"]);
            $page_data["links"] = $this->pagination->create_links();


            if($option == "show"){
              $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'empresas','Empresas');
                $this->load->view('index', $page_data);
            }

        }


    }

    /*
    * ARCHIVOS
    */

    function archivos($action="none", $id = 0)
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $tbls = json_decode(_TABLES);
            $tbl = json_decode(_TABLE, true);


            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $tableName = $tbl["catalogo"]["name"];
            $view = "archivos"; $viewTitle = "Gestionar Archivos";
            $upload_path_url = 'uploads/tmp/';
            $consolidated_path = 'uploads/';
            $olds_path = 'uploads/olds/';
            $deleteds_path = 'uploads/deletes/';


            if($action== "upload"){
                /**
                 * upload.php
                 *
                 * Copyright 2013, Moxiecode Systems AB
                 * Released under GPL License.
                 *
                 * License: http://www.plupload.com/license
                 * Contributing: http://www.plupload.com/contributing
                 */

                #!! IMPORTANT:
                #!! this file is just an example, it doesn't incorporate any security checks and
                #!! is not recommended to be used in production environment as it is. Be sure to
                #!! revise it and customize to your needs.


                // Make sure file is not cached (as it happens for example on iOS devices)
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-store, no-cache, must-revalidate");
                header("Cache-Control: post-check=0, pre-check=0", false);
                header("Pragma: no-cache");

                /*
                // Support CORS
                header("Access-Control-Allow-Origin: *");
                // other CORS headers if any...
                if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                    exit; // finish preflight CORS requests here
                }
                */

                // 5 minutes execution time
                @set_time_limit(5 * 60);

                // Uncomment this one to fake upload time
                // usleep(5000);

                // Settings
                //$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
                $targetDir = '../code/uploads';
                $cleanupTargetDir = true; // Remove old files
                $maxFileAge = 5 * 3600; // Temp file age in seconds


                // Create target dir
                if (!file_exists($targetDir)) {
                    @mkdir($targetDir);
                }

                // Get a file name
                if (isset($_REQUEST["name"])) {
                    $fileName = $_REQUEST["name"];
                } elseif (!empty($_FILES)) {
                    $fileName = $_FILES["file"]["name"];
                } else {
                    $fileName = uniqid("file_");
                }

                $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

                // Chunking might be enabled
                $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
                $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


                // Remove old temp files
                if ($cleanupTargetDir) {
                    if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
                    }

                    while (($file = readdir($dir)) !== false) {
                        $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                        // If temp file is current file proceed to the next
                        if ($tmpfilePath == "{$filePath}.part") {
                            continue;
                        }

                        // Remove temp file if it is older than the max age and is not the current file
                        if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                            @unlink($tmpfilePath);
                        }
                    }
                    closedir($dir);
                }


                // Open temp file
                if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
                }

                if (!empty($_FILES)) {
                    if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
                    }

                    // Read binary input stream and append it to temp file
                    if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    }
                } else {
                    if (!$in = @fopen("php://input", "rb")) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    }
                }

                while ($buff = fread($in, 4096)) {
                    fwrite($out, $buff);
                }

                @fclose($out);
                @fclose($in);

                // Check if file has been uploaded
                if (!$chunks || $chunk == $chunks - 1) {
                    // Strip the temp .part suffix off
                    rename("{$filePath}.part", $filePath);
                }

                // Return Success JSON-RPC response
                die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');

            }

            if($action =="none")
            {
                //$page_data["result"] = $this->Generic_model->catalog_get_all(  );
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,$view, $viewTitle);
                $this->load->view('index', $page_data);

            }

        }


      }




    /*
    * PERFILES
    */




    /*
    * REGIONES
    */

     function regiones($option = "show", $id = 0 , $mode = "none") //mode es para upd //cargaS = carga
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{



            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $tablename = 'region';

            //$page_data['num_ofertas'] = $this->Admin_model->get_num_ofertatransportista_by_id($idUserType);
            //$page_data['cargas'] = $this->Admin_model->carga_get_all_by_id(0,$idUserType);


            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/regiones/$option/$id/$mode";
            $config["total_rows"] = $page_data['num_regiones'];
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
            $page_data['regiones'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);

            //print_r($page_data["regiones"]);
            $page_data["links"] = $this->pagination->create_links();


            if($option == "add"){

                 $nombre = $this->input->post('nombre');
                 $codigo = $this->input->post('codigo');  //numeracion de region
                 $latitud = $this->input->post('latitud');
                 $longitud = $this->input->post('longitud');

                 $data = array(
                                "nombre" => $nombre,
                                "latitud" => $latitud,
                                "codigo" => $codigo,
                                "longitud" => $longitud
                              );
                $this->Admin_model->table_insert($tablename,$data);
                //$this->load->view('index', $page_data);
                redirect(base_url()."?".$usrtype."/regiones",'refresh');
            }

            else if($option == "upd" && $id > 0){
                $page_data['region_datos'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);
                if($mode == "commit"){  //efectuar update
                     $nombre = $this->input->post('nombre');
                     $codigo = $this->input->post('codigo');  //numeracion de region
                     $latitud = $this->input->post('latitud');
                     $longitud = $this->input->post('longitud');

                     $data = array(
                                    "nombre" => $nombre,
                                    "latitud" => $latitud,
                                    "codigo" => $codigo,
                                    "longitud" => $longitud
                                  );
                    $this->Admin_model->table_update($tablename,$id,$data);

                    //$page_data['chofer_datos'] = $this->Admin_model->chofer_get_all_by_id($id, $idUserType);
                    redirect(base_url()."?".$usrtype."/regiones",'refresh');
                }

				$page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'regiones','Regiones');
                $this->load->view('index', $page_data);
            }

            else if($option == "del"){
                $this->Admin_model->delete_by_id($tablename,$id);
                redirect(base_url()."?".$usrtype."/regiones",'refresh');
            }

            if($option == "show"){
            	$page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'regiones','Regiones');
                $this->load->view('index', $page_data);
            }

        }


    }



    /*
    * CIUDADES
    */
    function ciudades($option = "show", $id = 0 , $mode = "none") //mode es para upd //cargaS = carga
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
        	$page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);

            $tablename = 'ciudad';

            //$page_data['num_ofertas'] = $this->Admin_model->get_num_ofertatransportista_by_id($idUserType);
            //$page_data['cargas'] = $this->Admin_model->carga_get_all_by_id(0,$idUserType);


            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/ciudades/$option/$id/$mode";
            $config["total_rows"] = $page_data['num_ciudades'];
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

            //print_r($page_data["regiones"]);
            $page_data["links"] = $this->pagination->create_links();


            if($option == "add"){

                 $nombre = $this->input->post('nombre');
                 $latitud = $this->input->post('latitud');
                 $longitud = $this->input->post('longitud');
                 $region = $this->input->post('region');

                 $data = array(
                                "nombre" => $nombre,
                                "latitud" => $latitud,
                                "longitud" => $longitud,
                                "idregion_fk" => $region
                              );
                $this->Admin_model->table_insert($tablename,$data);
                $insert_id = $this->db->insert_id();
                $ciudades_total = $this->Admin_model->fetch_tabla($tablename,10000,$start);
                foreach($ciudades_total as $s => $v){
                	$idciudad = $v["idciudad"];
                	$dist = -1;
                	if($insert_id == $idciudad){ $dist = 0; }
                    else{// agrego bidireccionalidad entre ciudades
                        $data_row2 = array("idciudad1" => $idciudad,
                                    "idciudad2" => $insert_id,
                                    "distancia" => $dist);
                        $data_batch[] = $data_row2;
                    }
                	$data_row = array("idciudad1" => $insert_id,
                					"idciudad2" => $idciudad,
                					"distancia" => $dist);
                	$data_batch[] = $data_row;
                }
                //print_r($data_batch);
                $this->db->insert_batch('calculo_distancia_ciudades',$data_batch);
                //$this->load->view('index', $page_data);
                redirect(base_url()."?".$usrtype."/ciudades",'refresh');
            }

            else if($option == "upd" && $id > 0){
                $page_data['ciudad_datos'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);
                if($mode == "commit"){  //efectuar update
                     $nombre = $this->input->post('nombre');
                     $latitud = $this->input->post('latitud');
                     $longitud = $this->input->post('longitud');
                     $region = $this->input->post('region');

                     $data = array(
                                "nombre" => $nombre,
                                "latitud" => $latitud,
                                "longitud" => $longitud,
                                "idregion_fk" => $region
                              );
                    $this->Admin_model->table_update($tablename,$id,$data);

                    //$page_data['chofer_datos'] = $this->Admin_model->chofer_get_all_by_id($id, $idUserType);
                    redirect(base_url()."?".$usrtype."/ciudades",'refresh');
                }
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'ciudades','Ciudades');
                $this->load->view('index', $page_data);
            }
            else if($option == "del"){
                $this->Admin_model->delete_by_id($tablename,$id);
                $this->Admin_model->delete_by_id('calculo_distancia_ciudades',$id);
                redirect(base_url()."?".$usrtype."/ciudades",'refresh');
            }
            else if($option == "dist"){
            	$idcity2 = $this->input->post("idciudad2");
            	$distancia = $this->input->post("distancia");
                $this->Admin_model->update_distancias($id,$idcity2,$distancia);
                redirect(base_url()."?".$usrtype."/ciudades",'refresh');
            }

            $page_data['ciudades'] = $this->Admin_model->fetch_tabla_ciudades();
            $page_data['regiones'] = $this->Admin_model->fetch_tabla("region");
            if($option == "show"){
            	$page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'ciudades','Ciudades');
                $this->load->view('index', $page_data);
            }



        }


    }

    /*
    * CARGAS
    */
    function tipocamion($option = "show", $id = 0 , $mode = "none") //mode es para upd //cargaS = carga
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);


            $tablename = 'tipocamion';
            //$page_data['num_ofertas'] = $this->Admin_model->get_num_ofertatransportista_by_id($idUserType);
            //$page_data['cargas'] = $this->Admin_model->carga_get_all_by_id(0,$idUserType);


            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/tipocamion/$option/$id/$mode";
            $config["total_rows"] = 10; //$page_data['num_cargas'];
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
            $page_data['tipocamiones'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);

            $page_data["links"] = $this->pagination->create_links();


            if($option == "add"){

                 $tipo = $this->input->post('tipo');
                 $marca = $this->input->post('marca');
                 $desc = $this->input->post('descripcion');
                 $file_name = $this->input->post('file_name');
                 $size_file = $this->input->post('size_file');
                 $data = array(
                              "tipo" => $tipo,
                              "marca" => $marca,
                              "descripcion" => $desc,
                              "file_name" => $file_name,
                              "size_file" => $size_file
                              );
                $this->Admin_model->table_insert($tablename,$data);
                //$this->load->view('index', $page_data);
                redirect(base_url()."?".$usrtype."/tipocamion",'refresh');
            }

            else if($option == "del"){
                $this->Admin_model->delete_by_id($tablename,$id);
                redirect(base_url()."?".$usrtype."/tipocamion",'refresh');
            }

            else if($option == "upd" && $id > 0){
                $page_data['carga_datos'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);
                if($mode == "commit"){  //efectuar update
                    $tipo = $this->input->post('tipo');
                    $marca = $this->input->post('marca');
                    $desc = $this->input->post('descripcion');
                    $file_name = $this->input->post('file_name');
                    $size_file = $this->input->post('size_file');
                    $data = array(
                                 "tipo" => $tipo,
                                 "marca" => $marca,
                                 "descripcion" => $desc,
                                 "file_name" => $file_name,
                                 "size_file" => $size_file
                                 );
                    $this->Admin_model->table_update($tablename,$id,$data);

                    //$page_data['chofer_datos'] = $this->Admin_model->chofer_get_all_by_id($id, $idUserType);
                    redirect(base_url()."?".$usrtype."/tipocamion",'refresh');
                }
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'tipocamion','Tipo de Camión');
                $this->load->view('index', $page_data);
            }
            if($option == "show"){
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'tipocamion','Tipo de Camión');
                $this->load->view('index', $page_data);
            }

        }


    }


    /*
    * CARGAS
    */
    function cargas($option = "show", $id = 0 , $mode = "none") //mode es para upd //cargaS = carga
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);


            $tablename = 'carga';
            //$page_data['num_ofertas'] = $this->Admin_model->get_num_ofertatransportista_by_id($idUserType);
            //$page_data['cargas'] = $this->Admin_model->carga_get_all_by_id(0,$idUserType);


            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/cargas/$option/$id/$mode";
            $config["total_rows"] = $page_data['num_cargas'];
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
            $page_data['cargas'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);

            $page_data["links"] = $this->pagination->create_links();


            if($option == "add"){

                 $tipo = $this->input->post('tipo');
                 $data = array(
                              "tipo" => $tipo
                              );
                $this->Admin_model->table_insert($tablename,$data);
                //$this->load->view('index', $page_data);
                redirect(base_url()."?".$usrtype."/cargas",'refresh');
            }

            else if($option == "del"){
                $this->Admin_model->delete_by_id($tablename,$id);
                redirect(base_url()."?".$usrtype."/cargas",'refresh');
            }

            else if($option == "upd" && $id > 0){
                $page_data['carga_datos'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);
                if($mode == "commit"){  //efectuar update
                    $tipo = $this->input->post('tipo');
                     $data = array(
                              "tipo" => $tipo
                              );
                    $this->Admin_model->table_update($tablename,$id,$data);

                    //$page_data['chofer_datos'] = $this->Admin_model->chofer_get_all_by_id($id, $idUserType);
                    redirect(base_url()."?".$usrtype."/cargas",'refresh');
                }
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'cargas','Cargas');
                $this->load->view('index', $page_data);
            }
            if($option == "show"){
            	$page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'cargas','Cargas');
                $this->load->view('index', $page_data);
            }

        }


    }


    /*
    * CARGAS
    */
    function ofertas($option = "show", $id = 0 , $mode = "none") //mode es para upd //cargaS = carga
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);

            $month = "-1";
            $year = "-1";
            if($option == "fetch")
            {
                $month = $this->input->post("month");
                $year = $this->input->post("year");
                //var_dump($year); var_dump($month); exit();
            }
            $tablenameT = 'ofertatransportista';
            $tablenameGC = 'ofertacarga';
            $page_data['year'] = $year;
            $page_data['month'] = $month;
            $page_data['ofertas_transportista'] = $this->Admin_model->fetch_ofertas_by_month_year($tablenameT,$month,$year);
            $page_data['ofertas_gencarga'] = $this->Admin_model->fetch_ofertas_by_month_year($tablenameGC,$month,$year);
            $page_data['num_of_transporte'] = $this->Generic_model->get_num_filas('ofertatransportista');
            $page_data['num_of_carga'] = $this->Generic_model->get_num_filas('ofertacarga');
            $page_data['num_of_transporte_mes'] = count($page_data['ofertas_transportista']);
            $page_data['num_of_carga_mes'] = count( $page_data['ofertas_gencarga']);

            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/ofertas/$option/$id/$mode";
            $config["total_rows"] = $page_data['num_cargas'];
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

            $page_data["links"] = $this->pagination->create_links();


            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'ofertas','Ofertas');
              $this->load->view('index', $page_data);

        }


    }




    /*
    * EQUIPOS
    */

     function equipos($option = "show", $id = 0 , $mode = "none") //mode es para upd //EQUIPOS = CAMION
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);

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
            $page_data['equipos'] = $this->Admin_model->fetch_tabla('camion',$limit,$start);
            $page_data['choferes'] = $this->Admin_model->fetch_tabla('chofer');

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
                $page_data['equipo_datos'] = $this->Admin_model->equipo_get_all_by_id($id, $idUserType);
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
                    //$this->Admin_model->equipo_update_by_id($id,$data);

                    //$page_data['chofer_datos'] = $this->Admin_model->chofer_get_all_by_id($id, $idUserType);
                    redirect(base_url()."?".$usrtype."/equipos",'refresh');
                }
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'equipos','Equipos');
                $this->load->view('index', $page_data);
            }
            else if($option == "del"){
                $this->Admin_model->equipo_delete_by_id($id);
                redirect(base_url()."?".$usrtype."/equipos",'refresh');
            }
            if($option == "show"){
            	$page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'equipos','Equipos');
                $this->load->view('index', $page_data);
            }

        }


    }



    /*
    * CHOFERES
    */



    function choferes($option = "show", $id = 0 , $mode = "none") //mode es para upd
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data  = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            //$page_data['num_ofertas'] = $this->Admin_model->get_num_filas('oferta');
            $page_data['option'] = $option;
            //$limit = 10000;
            //$page_data['choferes'] = $this->Admin_model->fetch_tabla_chofer($limit,0);



            $config = array();
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
            $page_data['choferes'] = $this->Admin_model->fetch_tabla('chofer',$limit,$start);
 			$page_data["idtransportistas"] = $this->Admin_model->fetch_tabla('transportista',$limit,$start);
            $page_data["links"] = $this->pagination->create_links();

            if($option == "add"){

                 $nombre = $this->input->post('nombre');
                 $apellido = $this->input->post('apellido');
                 $rut = $this->input->post('rut');
                 $celular = $this->input->post('celular');
                 $idusuario = $this->input->post('idusuario');

                 $data = array("nombre" => $nombre,
                              "apellido" => $apellido,
                              "RUT" => $rut,
                              "celular" => $celular,
                              "idtransportista_fk" => $idusuario);
                $this->Admin_model->chofer_insert($data);
                //$this->load->view('index', $page_data);
                redirect(base_url()."?".$usrtype."/choferes",'refresh');
            }

            else if($option == "upd" && $id > 0){
                $page_data['chofer_datos'] = $this->Admin_model->chofer_get_all_by_id($id, $idUserType);
                if($mode == "commit"){  //efectuar update
                     $nombre = $this->input->post('nombre');
                     $apellido = $this->input->post('apellido');
                     $rut = $this->input->post('rut');
                     $celular = $this->input->post('celular');
                     $idusuario = $this->input->post('idusuario');

                     $data = array("nombre" => $nombre,
                                  "apellido" => $apellido,
                                  "RUT" => $rut,
                                  "celular" => $celular,
                              	  "idtransportista_fk" => $idusuario);

                    $this->Admin_model->chofer_update_by_id($id,$data);
                    //$page_data['chofer_datos'] = $this->Admin_model->chofer_get_all_by_id($id, $idUserType);
                    redirect(base_url()."?".$usrtype."/choferes/show/0/none/$page",'refresh');
                }
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'choferes','Choferes');
                $this->load->view('index', $page_data);
            }
            else if($option == "del"){
                $this->Admin_model->chofer_delete_by_id($id);
                redirect(base_url()."?".$usrtype."/choferes",'refresh');
            }

            if($option == "show"){
            	$page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'choferes','Choferes');
                $this->load->view('index', $page_data);
            }

        }


    }




    function renew_service($idserv = 0){
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $result = $this->Admin_model->service_get_all_by_id($idserv);
            if($idserv == 0 || $idserv < 0 || $result == false) redirect(base_url().'?Admin/services','refresh');

            $page_data['page_name']  = 'edit_theservice';
            $page_data['page_title'] = 'Edit Service';
            $page_data['nservices'] = $this->Admin_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->Admin_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->Admin_model->get_num_filas('account')+1;
            //print_r($this->input->post('edit'));
            //print_r($_POST['edit']);
            switch ($this->input->post('edit')) {
                case 'Edit Name':
                    # code...
                    $field = "name";
                    break;
                case 'Edit Topic':
                    # code...
                    $field = "topic";
                    break;
                case 'Edit Description':
                    # code...
                    $field = "desc";
                    break;
                case 'Edit Url':
                    # code...
                    $field = "url";
                    break;
                case 'Edit All':
                    # code...
                    $field = "all";
                    break;

                default:
                    # code...
                    $field = "all";
                    break;
            }
            if($field == "all"){
                $name = $this->input->post('name');
                $topic =$this->input->post('topic');
                $desc = $this->input->post('desc');
                $url = $this->input->post('url');
                $data = array('name' => $name,
                              'url' => $url,
                              'topic' => $topic,
                              'desc' => $desc
                );
                $this->Admin_model->service_update_fields_by_id($idserv,$data);
            }else{
                $val = $this->input->post($field);
                if($val != '')
                    $this->Admin_model->service_update_field_by_id($idserv,$field,$val);
            }
            $result = $this->Admin_model->service_get_all_by_id($idserv);
            $page_data['service'] = $result[0];
            //print_r($result);
            $this->load->view('index', $page_data);
        }
    }


    function services_to_excel()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'Services to Excel';
            $page_data['page_name']  = 'services_to_excel';
            $total = $this->Admin_model->get_num_filas('service');
            $limit = 20;
            $start = 0;
            $finalresult = array();

            for($start; $start <= $total; $start += $limit){
                $result = $this->Admin_model->fetch_tabla('service',$limit,$start);
                if ($result != false)
                    foreach($result as $res)
                        $finalresult[] = $res;

            }

            $page_data["services"] = $finalresult;
            $this->load->view('admin/services_to_excel', $page_data);
        }

    }
    function services_to_xml()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'Services to XML';
            $page_data['page_name']  = 'services_to_xml';
            $total = $this->Admin_model->get_num_filas('service');
            $limit = 50;
            $start = 0;
            $finalresult = array();

            for($start; $start <= $total; $start += $limit){
                $result = $this->Admin_model->fetch_tabla('service',$limit,$start);
                if ($result != false)
                    foreach($result as $res)
                        $finalresult[] = $res;

            }

            $page_data["services"] = $finalresult;
            //$page_data["output"] = $output;
            $this->load->view('admin/services_to_xml', $page_data);
        }

    }


/*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup($operation = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $tablenames = $this->db->list_tables();
        $page_data['nservices'] = $this->Admin_model->service_get_num_filas(true);
        $page_data['nservicesforapproval'] = $this->Admin_model->service_get_num_filas(false);
        $page_data['nusers'] = $this->Admin_model->get_num_filas('account')+1;

        if ($operation == 'backup') {
            $type = $this->input->post('table');
            $this->Admin_model->create_backup($type);
        }
        if ($operation == 'restore') {
            //print_r($_FILES['userfile']['tmp_name']);
            $this->Admin_model->restore_backup();
            //$this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?Admin/backup_restore/', 'refresh');
        }


        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['tables'] = $tablenames;
        $page_data['page_title'] = 'Backup and Restore Data';
        $this->load->view('index', $page_data);
    }



      /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'?Login' , 'refresh');
    }


     /***DEFAULT NOT FOUND PAGE*****/
    function four_zero_four()
    {
        $page_data['page_title'] = '404NotFound';
        $page_data['page_name']  = 'four_zero_four';
        $this->load->view('index',$page_data);
    }



}
