<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Generic_model');
		$table = json_decode(_TABLE,true);
	}
	

///////////////////////////// CRUD FOR ACCOUNT TABLE //////////////////////////////////////////////////


	function account_insert($muser, $mpassword, $salt, $type)
	{
		$table = json_decode(_TABLE,true);
		$data = array(
			'Muser' =>$muser,
			'Mpassword' =>$mpassword,
			'salt' =>$salt,
			'usertype' => $type
			);
		$value = $this->db->insert($table["account"]["name"],$data);
		return $value;
	}


	function account_delete_by_id($table = 'account',$iduser=0)
	{
		
		if ($iduser != 0) {
			$tables = array('account');
			if(in_array($table,$tables)){
				$this->db->delete($table,array('id' => $iduser));
				return true;
			}
			else{ return false; }
			
		}else{
			return false;
		}
	}


	function account_update_field_by_id($id,$namefield,$field)
	{
		$table = json_decode(_TABLE,true);
		$data = array( $namefield => $field );
		$this->db->where('id', $id);
		$value = $this->db->update($table["account"]["name"], $data);
		return $value;
	}


	function account_update_by_id($id, $newpassword= '',$newpattern = '', $newsalt= '')
	{
		$table = json_decode(_TABLE,true);
		if ($newpassword != ''){
			$data = array( 'Mpassword' => $newpassword );
			$this->db->where('id', $id);
			$this->db->update($table["account"]["name"], $data);	
		} 
		if ($newpattern != ''){
			$data = array( 'Mpattern' => $newpattern );
			$this->db->where('id', $id);
			$this->db->update($table["account"]["name"], $data);	
		} 
		if ($newsalt != ''){
			$data = array( 'salt' => $newsalt );
			$this->db->where('id', $id);
			$this->db->update($table["account"]["name"], $data);	
		} 
		return true;
	}


	function account_get_id_by_Muser($mail = '',$logged = false)
	{
		$table = json_decode(_TABLE,true);
		if ($logged == true) {
			$mail = $this->session->userdata('email');
		}
		if($mail != ''){			
			return $this->db->select('id')->get_where($table["account"]["name"], array( 'Muser'=> $mail))->row()->id;
		}else{
			return false;
		}
	}


	function account_get_all_by_Muser($mail = '',$logged = false)
	{
		$table = json_decode(_TABLE,true);
		if ($logged == true) {
			$mail = $this->session->userdata('email');
		}
		if($mail != ''){			
			return $this->db->get_where($table["account"]["name"], array( 'Muser'=> $mail))->row();
		}else{
			return false;
		}
	}


	function account_get_all_by_iduser($iduser = '',$logged = false)
	{
		$table = json_decode(_TABLE,true);
		if ($logged == true) {
			$iduser = $this->session->userdata('userid');
		}
		if($iduser != ''){			
			return $this->db->get_where($table["account"]["name"], array( 'id'=> $iduser))->row_array();
		}else{
			return false;
		}
	}

	//Type = Transportista, GeneradorCarga
	function account_get_id_by_type($idusr = 0,$type)
	{ 
		$table = json_decode(_TABLE,true);
		if ($type == TRANSPORTISTA ) {
			return $this->db->select('idtransportista')->get_where($table["transportista"]["name"], array( 'idaccount'=> $idusr))->row()->idtransportista;
		}
		else if ($type == GENERADORCARGA ) {
			return $this->db->select('idgeneradorcarga')->get_where($table["generadorcarga"]["name"], array( 'idaccount'=> $idusr))->row()->idgeneradorcarga;
		}else{
			return $idusr; //admin
		}
	}
////////////------------------------------END-----------------------------------------------///////////




}