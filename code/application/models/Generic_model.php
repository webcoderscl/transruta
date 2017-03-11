<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generic_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}


	public function fillPageDataCounters($usertype,$idUserType,$page_data,$page_name,$page_title)
	{
		$table = json_decode(_TABLE,true);
        if($usertype == TRANSPORTISTA){
        	$page_data['page_name']  = $page_name;
	        $page_data['page_title'] = $page_title;
	        $idAcc = $this->session->userdata('userid');
	        $page_data['num_choferes'] = $this->Crud_model->get_num_choferes_by_id($idUserType);
	        $page_data['num_equipos'] = $this->Crud_model->get_num_equipos_by_id($idUserType);
	        $page_data['num_ofertas'] = $this->Crud_model->get_num_ofertatransportista_by_id($idUserType);
	        $page_data['modal_title_add'] = 'Agregar '.$page_name;
	        $page_data['modal_title_upd'] = 'Modificar '.$page_name;
            $page_data['modal_title_text_add'] = 'Para agregar por favor rellene los campos solicitados.';
            $page_data['modal_title_text_upd'] = 'Para modificar por favor rellene los campos solicitados.';
            if ($page_name == "misofertas"){
            	     $page_data['modal_title_upd'] = 'Modificar Mi Oferta';
            }
	        if ( in_array($page_name, array("missolicitudes_recibidas","missolicitudes_enviadas","historial","buscarcarga")) ){
	        	$page_data['modal_title_add'] = 'Detalle de la oferta';
		        $page_data['modal_title_upd'] = 'Detalle de la oferta';
	            $page_data['modal_title_text_add'] = 'Informacion de toda la oferta.';
	            $page_data['modal_title_text_upd'] = 'Informacion de toda la oferta.';
	        }

	        $page_data['num_solicitudes_enviadas'] = $this->Crud_model->get_num_match_ofertatransportista_by_id($idUserType,'','enviadas');
	        $page_data['num_solicitudes_recibidas'] = $this->Crud_model->get_num_match_ofertatransportista_by_id($idUserType,'','recibidas');
	        $page_data['num_historial'] = $this->Crud_model->get_num_match_ofertatransportista_by_id($idUserType,'','both');

        }
        else if($usertype == GENERADORCARGA ){
        	$page_data['page_name']  = $page_name;
	        $page_data['page_title'] = $page_title;
	        $idAcc = $this->session->userdata('userid');
	        $page_data['num_ofertas'] = $this->Crud_model->get_num_ofertacarga_by_id($idUserType);
	        $page_data['modal_title_add'] = 'Agregar '.$page_name;
            $page_data['modal_title_upd'] = 'Modificar '.$page_name;
            $page_data['modal_title_text_add'] = 'Para agregar por favor rellene los campos solicitados.';
            $page_data['modal_title_text_upd'] = 'Para modificar por favor rellene los campos solicitados.';
             if ($page_name == "misofertas"){
            	     $page_data['modal_title_upd'] = 'Modificar Mi Oferta';
            }
	        if ( in_array($page_name, array("missolicitudes_recibidas","missolicitudes_enviadas","historial","buscarcamion")) ){
	        	$page_data['modal_title_add'] = 'Detalle de la oferta';
		        $page_data['modal_title_upd'] = 'Detalle de la oferta';
	            $page_data['modal_title_text_add'] = 'Informacion de toda la oferta.';
	            $page_data['modal_title_text_upd'] = 'Informacion de toda la oferta.';
	        }

            $page_data['num_solicitudes_enviadas'] = $this->Crud_model->get_num_match_ofertacarga_by_id($idUserType,'','enviadas');
            $page_data['num_solicitudes_recibidas'] = $this->Crud_model->get_num_match_ofertacarga_by_id($idUserType,'','recibidas');
            $page_data['num_historial'] = $this->Crud_model->get_num_match_ofertacarga_by_id($idUserType,'','both');

        }else if($usertype == ADMIN ){
        	$page_data['page_name']  = $page_name;
	        $page_data['page_title'] = $page_title;
	        $idAcc = $this->session->userdata('userid');
	        $page_data['num_choferes'] = $this->Admin_model->get_num_filas($table["chofer"]["name"]);
            $page_data['num_equipos'] = $this->Admin_model->get_num_filas($table["camion"]["name"]);
            $page_data['num_cargas'] = $this->Admin_model->get_num_filas($table["carga"]["name"]);
            $page_data['num_cuentas'] = $this->Admin_model->get_num_filas($table["account"]["name"]);
            $page_data['num_regiones'] = $this->Admin_model->get_num_filas($table["region"]["name"]);
            $page_data['num_ciudades'] = $this->Admin_model->get_num_filas($table["ciudad"]["name"]);
            $page_data['num_tipocamiones'] = $this->Admin_model->get_num_filas($table["tipocamion"]["name"]);

        }
        return $page_data;
    }


    public function createPagination($url,$perpage,$urisegment,$total_rows,$dataName,$Alldata)
    {

    	$this->load->library("pagination");
		$config = array();
        $config["base_url"] = $url;
        $config["total_rows"] = $total_rows;
        $config["per_page"] = $perpage; //20 antes
        $config["uri_segment"] = $urisegment;

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
        $page = ($this->uri->segment($urisegment)) ? $this->uri->segment($urisegment) : 0;
        $limit = $config["per_page"];
        $start = $page;


        $page_data['equipos'] = $this->Crud_model->fetch_tabla_equipo($idUserType,$limit,$start);

        $page_data["links"] = $this->pagination->create_links();

        return $page_data;
    }


	public function formateaFecha($input,$showYear = "si")
	{
		$resp = "";
		$meses = array("01"=> "Ene" ,"02" => "Feb" ,"03"=> "Mar" ,"04"=> "Abr" ,"05"=> "May" ,"06"=> "Jun" ,
						"07" => "Jul" ,"08"=> "Ago" ,"09"=> "Sep" ,"10"=> "Oct" ,"11"=> "Nov" ,"12"=> "Dic");

		//$meses = array(1 => "Ene" ,2 => "Feb" ,3 => "Mar" ,4 => "Abr" ,5 => "May" ,6 => "Jun" ,
		//				7 => "Jul" ,8 => "Ago" ,9 => "Sep" ,10 => "Oct" ,11 => "Nov" , 12 => "Dic");
		$input = str_replace("-","/",$input);
		$input_arr = explode("/",$input);
		//print_r($meses[$input_arr[1]]);
		$day = intval($input_arr[2]);
		$resp = $day . " " . $meses[$input_arr[1]];
		$year = " de ".$input_arr[0];
		if($showYear== "si") $resp .= $year;
		return $resp;
	}


	public function generateRandomString($length = 10,$option = -1)
	{
			$signs = '!#$*{}+-_:.;,[]';
			$characters = array('ABCDE01FGHIJ23KLMNO45PQRST67UVWXYZ89'.$signs,
								$signs.'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
								'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'.$signs,
								$signs.'ABCDEFGHIJKLMNO01234PQRSTUVWXYZ56789',
								'56789ABCDEFGHIJKLMNO01234PQRSTUVWXYZ'.$signs,
								'abcde01fghij23klmno45pqrst67uvwxyzZ89'.$signs,
								$signs.'0123456789abcdefghijklmnopqrstuvwxyz',
								'abcdefghijklmnopqrstuvwxyz0123456789'.$signs,
								$signs.'abcdefghijklmno01234pqrstuvwxyz56789',
								'56789abcdefghijklmno01234pqrstuvwxyz'.$signs
								);


			$charactersLength = strlen($characters[0]);
			$charsetlength = count($characters);
			$randomString = '';
			if($option > $charsetlength-1) $option = 0;
			$position0 = $option;
			for ($i = 0; $i < $length; $i++) {
					$position = rand(0, $charactersLength - 1);
					if($option === -1){
						$position0 = rand(0, $charsetlength - 1);
					}
					$randomString .= strval($characters[$position0][$position]);

			}
			return $randomString;
	}


	public function generateRandomToken($length = 10)
	{
			$signs = '!#$*{}+-_:.;,[]';
			$characters = array('ABCDE01FGHIJ23KLMNO45PQRST67UVWXYZ89'
								);
			$charactersLength = strlen($characters[0]);
			$charsetlength = count($characters);
			$randomString = ''; $option = 0;
			$position0 = $option;
			for ($i = 0; $i < $length; $i++) {
					$position = rand(0, $charactersLength - 1);
					if($option === -1){
						$position0 = rand(0, $charsetlength - 1);
					}
					$randomString .= strval($characters[$position0][$position]);

			}
			return $randomString;
	}

///////////////////////////// GENERIC CRUD FOR TABLE //////////////////////////////////////////////////
	//params $querystring => a raw query string to call db->query() to solve
	public function doQuery($querystring)
	{

		$query = $this->db->query($querystring);
		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				return $data;
		}
		return false;
	}

	//params $querystring => a query made by CI active record

	public function doQueryObject($query)
	{

		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				return $data;
		}
		return false;
	}

	function delete_by_id($table = '',$id=0, $iduser)
	{

		if ($id != 0) {

			$this->db->delete($table,array('id' => $id));
			return true;

		}else{
			return false;
		}
	}

	public function get_distancia_ciudades($idciudad1, $idciudad2)
	{
		$table = json_decode(_TABLE,true);
		if(is_int($idciudad1) && is_int($idciudad2) ){
			$query = $this->db->get_where($table["distancia_ciudades"]["name"],
										  array("idciudad1" => $idciudad1, "idciudad2" => $idciudad2));
			if ($query->num_rows() > 0) {
					$dist = $query->first_row()->distancia;
					return intval($dist);
			}

		}
		return -1;
	}

	public function fetch_tabla($tabla,$limit, $start, $where = false, $data = array())
	{
		$this->db->limit($limit, $start);
		if($where){
			$query = $this->db->get_where($tabla,$data);
		}else{
			$query = $this->db->get($tabla); //add where comprado = 1 !
		}
		return $this->doQueryObject($query);
	}


	public function get_num_filas($tabla)
	{
		$total = 0;
		$total = $this->db->count_all($tabla);
		return $total;
	}


	function get_field_by_id($tbl, $id = '',$fieldname = '')
	{
		$table = json_decode(_TABLE,true);
		if($fieldname != ''){
			if($tbl == $table["account"]["name"]){
				$result = $this->db->select($fieldname)
					->get_where($tbl,array("id" => $id))
					->row();
			}else if($tbl == $table["match_ofertas"]["name"]){
				$result = $this->db->select($fieldname)
					->get_where($tbl,array("idmatch" => $id))
					->row();
			}else{
				$result = $this->db->select($fieldname)
					->get_where($tbl,array("id".$tbl => $id))
					->row();
			}

			return $result;

		}else{
			return false;
		}
	}
	function get_id_by_fieldname($tbl, $fieldname = '',$value = '')
	{
		$table = json_decode(_TABLE,true);
		if($fieldname != ''){
			if($tbl == $table["account"]["name"]){
				$result = $this->db->select("id".$tbl)
				->get_where($tbl,array($fieldname => $value))
					->row();
			}else if($tbl == $table["match_ofertas"]["name"]){
				$result = $this->db->select("idmatch")
					->get_where($tbl,array($fieldname => $value))
					->row();
			}else{
				$result = $this->db->select("id".$tbl)
					->get_where($tbl,array($fieldname => $value))
					->row();
			}

			return $result;

		}else{
			return false;
		}
	}

	function table_update_by_id($tbl,$id,$fieldname,$value)
	{
		$table = json_decode(_TABLE,true);
		$data = array($fieldname => $value);
		if($tbl == $table["account"]["name"]){
			$this->db->where('id', $id);
		}else if($tbl == $table["match_ofertas"]["name"]){
			$this->db->where('idmatch', $id);
		}else{
			$this->db->where('id'.$tbl, $id);
		}
		$value = $this->db->update($tbl, $data);
		return $value;
	}


	function table_insert($tablename, $data)
	{
		$value = $this->db->insert($tablename,$data);
		return $value;
	}
	///////////////////////////// GENERIC CRUD FOR TABLE //////////////////////////////////////////////////
	////////////------------------------------END-----------------------------------------------///////////


	function get_tipo_equipo()
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$tipocamion = $table["tipocamion"]["name"];
		$query = $this->db->query("SELECT DISTINCT tipo, file_name, size_file FROM $tipocamion");
		return $this->doQueryObject($query);
	}


	function get_tipo_carga()
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$carga = $table["carga"]["name"];
		$query = $this->db->query("SELECT DISTINCT tipo FROM $carga");
		return $this->doQueryObject($query);
	}

}
