<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Generic_model');
		$table = json_decode(_TABLE,true);

	}




	public function fillPageDataCounters($usertype,$idUserType,$page_data,$page_name,$page_title)
	{

        $table = json_decode(_TABLE,true);
        if($usertype == ADMIN ){
        	$page_data['page_name']  = $page_name;
	        $page_data['page_title'] = $page_title;
	        $idAcc = $this->session->userdata('userid');

	        $page_data['modal_title_add'] = 'Agregar '.$page_name;
            $page_data['modal_title_upd'] = 'Modificar '.$page_name;
            $page_data['modal_title_text_add'] = 'Para agregar por favor rellene los campos solicitados.';
            $page_data['modal_title_text_upd'] = 'Para modificar por favor rellene los campos solicitados.';

	        $page_data['num_choferes'] = $this->Admin_model->get_num_filas($table["chofer"]["name"]);
            $page_data['num_equipos'] = $this->Admin_model->get_num_filas($table["camion"]["name"]);
            $page_data['num_cargas'] = $this->Admin_model->get_num_filas($table["carga"]["name"]);
            $page_data['num_cuentas'] = $this->Admin_model->get_num_filas($table["account"]["name"]);
            $page_data['num_regiones'] = $this->Admin_model->get_num_filas($table["region"]["name"]);
            $page_data['num_ciudades'] = $this->Admin_model->get_num_filas($table["ciudad"]["name"]);

        }
        return $page_data;
    }


	public function generateRandomString($length = 10,$option = -1)
	{
		$signs = '!#$*{}+-_:.;,[]';
		$pad = "12345678";
		$characters = array($pad.'ABCDE01FGHIJ23KLMNO45PQRST67UVWXYZ89'.$pad,
							'ABCDE01FGHIJ23KLMNO45PQRST67UVWXYZ89'.$signs,
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

///////////////////////////// GENERIC CRUD FOR TABLE //////////////////////////////////////////////////
	function delete_by_id($table = '',$id=0, $iduser = 0)
	{
		$tables = array("account","camion","carga",
		"chofer","ciudad","empresa","calculo_distancia_ciudades",
		"generadorcarga","ofertacarga","ofertatransportista",
		"region","sucursal","transportista","tipocamion");

		if ($id != 0) {

			if( in_array($table,($tables)) ){
				if($table == 'account'){
					$this->db->delete($table,array('id' => $id));
				}else if($table == 'calculo_distancia_ciudades'){
					$this->db->delete($table,array('idciudad1' => $id));
				}
				else
					$this->db->delete($table,array('id'.$table => $id));
				return true;
			}
			else{ return false; }

		}else{
			return false;
		}
	}


	function get_name_by_id($tablename, $id, $field, $limit = 1000, $start = 0)
	{
		$this->db->limit($limit, $start);
		if($tablename == 'account'){
			$query = $this->db->select($field)->get_where($tablename,array("id" => $id));
		}
		else{
			$query = $this->db->select($field)->get_where($tablename,array("id".$tablename => $id));
		}

		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$data[] = $row;
				}
				return $data[0][$field];
		}
		return false;
	}


	function get_datafield_by_id($tablename, $id, $field, $limit = 1000, $start = 0)
	{
		$this->db->limit($limit, $start);
		if($tablename == 'account'){
			$query = $this->db->select($field)->get_where($tablename,array("id" => $id));
		}
		else{
			$query = $this->db->select($field)->get_where($tablename,array("id".$tablename => $id));
		}

		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$data[] = $row;
				}
				return $data[0][$field];
		}
		return false;
	}


	function fetch_tabla($tabla,$limit = 1000, $start = 0)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get($tabla); //add where comprado = 1 !
		return $this->Generic_model->doQueryObject($query);
	}


	function get_num_filas($tabla)
	{
		$total = 0;
		$total = $this->db->count_all($tabla);
		return $total;
	}


	function table_insert($tablename, $data)
	{

		$value = $this->db->insert($tablename,$data);
		return $value;
	}


	function update_distancias($idciudad1, $idciudad2, $distancia)
	{
		$res = $this->db->query("UPDATE calculo_distancia_ciudades
								SET distancia = '$distancia'
								WHERE idciudad1 = '$idciudad1' AND idciudad2 = '$idciudad2'
								");
		return $res;
	}


	function table_update($tablename, $id, $data)
	{
		$tables = array("account","camion","carga",
		"chofer","ciudad","empresa","calculo_distancia_ciudades",
		"generadorcarga","ofertacarga","ofertatransportista",
		"region","sucursal","transportista","tipocamion");

		if( in_array($tablename, ($tables)) ){
			if($tablename == 'account'){
				$this->db->where('id', $id);
				$this->db->update($tablename,$data);
			}
			if($tablename == 'calculo_distancia_ciudades'){
				$this->db->where('idciudad1', $id);
				$this->db->update($tablename,$data);
			}
			else{
				$this->db->where('id'.strval($tablename), $id);
				$this->db->update($tablename,$data);
			}


			return true;
		}
		else{ return false; }
	}


	function table_update_field_by_id($tablename, $id, $namefield, $field)
	{
		$tables = array("account","camion","carga",
		"chofer","ciudad","empresa",
		"generadorcarga","ofertacarga","ofertatransportista",
		"region","sucursal","transportista");

		$data = array( $namefield => $field );
		if(in_array($tablename, ($tables)) ){
			if($tablename == 'account'){
				$this->db->where('id', $id);
				$this->db->update($tablename,$data);
			}
			else{
				$this->db->where('id'.strval($tablename), $id);
				$this->db->update($tablename,$data);
			}

			return true;
		}
		else{ return false; }
	}
///////////////////////////// GENERIC CRUD FOR TABLE //////////////////////////////////////////////////
////////////------------------------------END-----------------------------------------------///////////


///////////////////////////// CRUD FOR ACCOUNT TABLE //////////////////////////////////////////////////


	function account_insert($muser, $mpassword, $salt, $type)
	{
		$table = json_decode(_TABLE,true);
		$data = array(
			'Muser' =>$muser,
			'Mpassword' =>$mpassword,
			'Mpattern' =>$mpattern,
			'salt' =>$salt,
			'usertype' => $type
			);
		$value = $this->db->insert($table["account"]["name"],$data);
		return $value;
	}


	function account_delete_by_id($tbl = 'account',$iduser=0)
	{
		$table = json_decode(_TABLE,true);
		if ($iduser != 0) {
			$this->db->delete($table[$tbl]["name"],array('id' => $iduser));
			return true;

		}else{
			return false;
		}
	}


	function account_update_field_by_id($id,$namefield,$field)
	{
		$data = array( $namefield => $field );
		$table = json_decode(_TABLE,true);
		$this->db->where('id', $id);
		$value = $this->db->update($table["account"]["name"], $data);
		return $value;
	}


	function account_update_by_id($id, $newpassword= '',$newpattern = '', $newsalt= '')
	{
		$table = json_decode(_TABLE,true);
		$acctable = $table["account"]["name"];
		if ($newpassword != ''){
			$data = array( 'Mpassword' => $newpassword );
			$this->db->where('id', $id);
			$this->db->update($acctable, $data);
		}
		if ($newpattern != ''){
			$data = array( 'Mpattern' => $newpattern );
			$this->db->where('id', $id);
			$this->db->update($acctable, $data);
		}
		if ($newsalt != ''){
			$data = array( 'salt' => $newsalt );
			$this->db->where('id', $id);
			$this->db->update($acctable, $data);
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
	function account_get_id_by_type($idusr = '',$type)
	{
		$table = json_decode(_TABLE,true);
		if ($type == TRANSPORTISTA) {
			return $this->db->select('idtransportista')->get_where($table["transportista"]["name"],
							array( 'idaccount'=> $idusr))->row()->idtransportista;
		}
		else if ($type == GENERADORCARGA ) {
			return $this->db->select('idgeneradorcarga')->get_where($table["generadorcarga"]["name"],
							array( 'idaccount'=> $idusr))->row()->idgeneradorcarga;
		}else{
			return false;
		}
	}

	//Type = Transportista, GeneradorCarga
	function account_get_typename_by_id($type)
	{
		if ($type == 0) {	return ADMIN_NAME;	}
		else if ($type == 1) {	return TRANSPORTISTA_NAME;	}
		else if ($type == 2) {	return GENERADORCARGA_NAME;	}
		else{	return false;	}
	}
////////////------------------------------END-----------------------------------------------///////////




	///////////////////////////// CRUD FOR REGIONS TABLE //////////////////////////////////////////////////

	function regions_get_all()
	{
		$table = json_decode(_TABLE,true);
		$info = $this->db->get_where($table["region"]["name"],
									array('idregion' => $id));

		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				return $data[0];
		}
		return false;
	}

	///////////////////////////// END CRUD FOR REGIONS TABLE //////////////////////////////////////////////////

	///////////////////////////// CRUD FOR CHOFER TABLE //////////////////////////////////////////////////
	//insertar by id transportista!
	function chofer_insert($data)
	{
		$table = json_decode(_TABLE,true);
		$value = $this->db->insert($table["chofer"]["name"],$data);
		return $value;
	}

	//editar by id transportista!
	function chofer_update_by_id($id = 0, $data)
	{
		$table = json_decode(_TABLE,true);
		if ($id != 0) {
			$this->db->where('idchofer', $id);
			$value = $this->db->update($table["chofer"]["name"], $data);
			return true;
		}else{
			return false;
		}
	}


	function chofer_delete_by_id($id = 0)
	{
		$table = json_decode(_TABLE,true);
		if ($id != 0) {
			$this->db->delete($table["chofer"]["name"],
							  array('idchofer' => $id));
			return true;
		}else{
			return false;
		}
	}


	public function fetch_tabla_chofer($limit, $start)
	{
		$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$query = $this->db->get($table["chofer"]["name"]); //add where comprado = 1 !
		return $this->Generic_model->doQueryObject($query);
	}


	function chofer_get_all_by_id($id, $idUserType)
	{
	 	$table = json_decode(_TABLE,true);
	 	$query = $this->db->get_where($table["chofer"]["name"],
	 									array("idchofer" => $id,
	 									"idtransportista_fk" => $idUserType));
	 	return $this->Generic_model->doQueryObject($query);
	}

	// obtener todos los datos de un chofer agregado
	function get_num_choferes_by_id($idUserType)
	{

	 	$table = json_decode(_TABLE,true);
	 	$query = $this->db->get_where($table["chofer"]["name"],
	 								  array("idtransportista_fk" => $idUserType));
	 	if ($query->num_rows() > 0) {
			return 	$query->num_rows();
		}
		return false;
	}
	///////////////////////////// END CRUD FOR CHOFER TABLE //////////////////////////////////////////////////


	///////////////////////////// CRUD FOR CHOFER TABLE //////////////////////////////////////////////////
	//insertar by id transportista!
	function equipo_insert($data)
	{
		$table = json_decode(_TABLE,true);
		$value = $this->db->insert($table["camion"]["name"],$data);
		return $value;
	}

	//editar by id transportista!
	function equipo_update_by_id($id = 0, $data)
	{
		$table = json_decode(_TABLE,true);
		if ($id != 0) {
			$this->db->where('idcamion', $id);
			$value = $this->db->update($table["camion"]["name"], $data);
			return true;
		}else{
			return false;
		}
	}


	function equipo_delete_by_id($id = 0)
	{
		$table = json_decode(_TABLE,true);
		if ($id != 0) {
			$this->db->delete($table["camion"]["name"],
								array('idcamion' => $id));
			return true;
		}else{
			return false;
		}
	}


	function fetch_tabla_equipo($limit, $start)
	{
		$table = json_decode(_TABLE,true);
		$this->db->limit($limit, $start);
		$query = $this->db->get($table["camion"]["name"]); //add where comprado = 1 !
		return $this->Generic_model->doQueryObject($query);
	}


	function get_tipo_equipo()
	{
		$table = json_decode(_TABLE,true);
		$camion = $table["camion"]["name"];
		$querystr = "SELECT DISTINCT tipo FROM $camion";
		return $this->Generic_model->doQuery($querystr);
	}


	 function get_tipo_carga()
	{
		$table = json_decode(_TABLE,true);
		$carga = $table["carga"]["name"];
		$querystr = "SELECT DISTINCT tipo FROM carga";
		return $this->Generic_model->doQuery($querystr);
	}

	function equipo_get_all_by_id($id, $idUserType)
	{

		$table = json_decode(_TABLE,true);
		$camion = $table["camion"]["name"];
		$chofer = $table["chofer"]["name"];
	 	if($id != 0){
	 		$query = $this->db->query("SELECT * FROM $camion eq, $chofer ch
	 		                       WHERE idcamion = $id
	 		                       AND idchofer_fk = ch.idchofer
	 		                       AND ch.idtransportista_fk = $idUserType");
	 	}else{ // 0 lista todos los camiones
	 		$query = $this->db->query("SELECT eq.* FROM $camion eq, $chofer ch
	 		                       WHERE idchofer_fk = ch.idchofer
	 		                       AND ch.idtransportista_fk = $idUserType");
	 	}

		return $this->Generic_model->doQueryObject($query);
	}

	function get_num_equipos_by_id($idUserType)
	{
		$table = json_decode(_TABLE,true);
		$camion = $table["camion"]["name"];
		$chofer = $table["chofer"]["name"];
	 	$query = $this->db->query("SELECT eq.* FROM $camion eq, $chofer ch
	 		                       WHERE idchofer_fk = ch.idchofer
	 		                       AND ch.idtransportista_fk = $idUserType");


	 	if ($query->num_rows() > 0) {

			return $query->num_rows();
		}
		return false;
	}

	///////////////////////////// END CRUD FOR CAMION TABLE //////////////////////////////////////////////////


	///////////////////////////// CRUD FOR EMPRESA TABLE //////////////////////////////////////////////////
	function empresa_update_by_id($id,$data)
	{
		$table = json_decode(_TABLE,true);
	 	if ($id != 0) {
			$this->db->where('idaccount', $id);
			$value = $this->db->update($table["empresa"]["name"], $data);
			return true;
		}else{
			return false;
		}
	}


	function fetch_tabla_ciudades()
	{
		$table = json_decode(_TABLE,true);
		$ciudad = $table["ciudad"]["name"];								$C1 = $table["ciudad1"]["alias"];
		$distancia_ciudades = $table["distancia_ciudades"]["name"];		$CDC= $table["distancia_ciudades"]["alias"];
	 	$querystr = "
	 			SELECT
	 			T.*,
	 			ifnull(count($CDC.idciudad1),0) as resolver_distancia
	 			FROM
	 			(SELECT $C1.idciudad, 	$C1.nombre,
	 					$C1.latitud, 	$C1.longitud,	$C1.idregion_fk
	 				    FROM $ciudad $C1
	 			) T
	 			LEFT OUTER JOIN $distancia_ciudades $CDC ON T.idciudad = $CDC.idciudad1
	 			AND $CDC.distancia = '-1'
	 			GROUP BY T.idciudad,	T.nombre,	T.latitud,
	 					T.longitud,		T.idregion_fk
	 			ORDER BY T.idregion_fk, T.idciudad LIMIT 0, 10000";


		return $this->Generic_model->doQuery($querystr);
	}


	function fetch_tabla_ciudades_otras($idciudad1)
	{
	 	$data = array();
	 	$table = json_decode(_TABLE,true);
		$ciudad = $table["ciudad"]["name"];								$C1 = $table["ciudad1"]["alias"];
		$distancia_ciudades = $table["distancia_ciudades"]["name"];		$CDC= $table["distancia_ciudades"]["alias"];
	 	$querystr = "
	 			SELECT
	 			T.*
	 			FROM
	 			(SELECT $C1.idciudad, 	$C1.nombre, 	$C1.latitud,
	 					$C1.longitud,	$C1.idregion_fk
	 				    FROM $ciudad $C1
	 			) T
	 			JOIN calculo_distancia_ciudades $CDC ON T.idciudad = $CDC.idciudad2
	 			AND $CDC.distancia = '-1'
	 			AND $CDC.idciudad1 = '$idciudad1'
	 			GROUP BY T.idciudad, 	T.nombre, 	T.latitud,
	 					T.longitud,		T.idregion_fk
	 			ORDER BY T.idregion_fk, T.idciudad LIMIT 0, 10000";


	 	$query = $this->db->query($querystr);
	 	$num_data = $query->num_rows();
		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				//return $data;
		}else{
			$msg = "No data";
		}
		$datos = array("total" => $num_data, "msg" => $msg, "data" => $data);
		return $datos;
	}


	public function fetch_tabla_empresa($id,$limit, $start)
	{
		$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$query = $this->db->get_where($table["empresa"]["name"],
									  array('idaccount' => $id)); //add where comprado = 1 !

		return $this->Generic_model->doQueryObject($query);
	}

	///////////////////////////// END CRUD FOR EMPRESA TABLE //////////////////////////////////////////////////

	///////////////////////////// CRUD FOR SUCURSAL TABLE //////////////////////////////////////////////////

	function sucursales_get_all_by_id($id, $idAcc)
	{

		$table = json_decode(_TABLE,true);
		$sucursal = $table["sucursal"]["name"];								$suc = $table["sucursal"]["alias"];
		$empresa = $table["empresa"]["name"];								$emp = $table["empresa"]["alias"];
		$distancia_ciudades = $table["distancia_ciudades"]["name"];			$CDC= $table["distancia_ciudades"]["alias"];
	 	if($id != 0){
	 		$query = $this->db->query("SELECT $suc.* FROM $sucursal $suc
	 								JOIN $empresa $emp
	 									ON $emp.idempresa 	= $suc.idempresa_fk
	 		                       WHERE $emp.idaccount = $idAcc
	 		                       		AND $suc.idsucursal 	= $id");
	 	}else{ // 0 lista todos los camiones
	 		$query = $this->db->query("SELECT $suc.* FROM $sucursal $suc
	 								JOIN $empresa $emp
	 								ON $emp.idempresa 	= 	$suc.idempresa_fk
	 		                       WHERE $emp.idaccount = 	$idAcc");
	 	}

	 	return $this->Generic_model->doQueryObject($query);
	}


	function sucursal_update_by_id($id,$data)
	{

		$table = json_decode(_TABLE,true);
	 	if ($id != 0) {
			$this->db->where('idsucursal', $id);
			$value = $this->db->update($table["sucursal"]["name"], $data);
			return true;
		}else{
			return false;
		}
	}


	public function fetch_tabla_sucursal($id,$limit, $start)
	{
		$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$query = $this->db->get_where($table["sucursal"]["name"],array('idsucursal' => $id)); //add where comprado = 1 !
		return $this->Generic_model->doQueryObject($query);
	}

	///////////////////////////// END CRUD FOR SUCURSAL TABLE //////////////////////////////////////////////////


	function ofertageneradorcarga_insert_by_id($data)
	{

		$table = json_decode(_TABLE,true);
		$value = $this->db->insert($table["ofertacarga"]["name"],$data);
		return $value;
	}


	function ofertatransportista_insert_by_id($data)
	{
		$table = json_decode(_TABLE,true);
		$value = $this->db->insert($table["ofertatransportista"]["name"],$data);
		return $value;
	}


	function fetch_tabla_ofertatransportista($idUserType,$limit, $start)
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"];
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"];
		$ciudad = $table["ciudad"]["name"];
																		$C1 = $table["ciudad1"]["alias"];
																		$C2 = $table["ciudad2"]["alias"];

		$query = $this->db->query("
			SELECT
				$OT.idofertatransportista,	$OT.IDTRANSPORTISTA_FK,
				$OT.fecha_publicacion, 		$OT.patente, 			$OT.tipo_camion,
				$C1.NOMBRE AS ubicacion, 	$C2.NOMBRE AS destino,
	        	$CH.NOMBRE AS chofer
			FROM  $ofertatransportista $OT
			JOIN  $ciudad $C1 ON $C1.IDCIUDAD 			= $OT.UBICACION
			JOIN  $ciudad $C2 ON $C2.IDCIUDAD 			= $OT.DESTINO_PREFERENTE
			JOIN  $chofer $CH ON $CH.IDTRANSPORTISTA_FK = $OT.IDTRANSPORTISTA_FK
			JOIN  $camion $CA ON $CA.PATENTE = $OT.PATENTE
			WHERE 	$OT.IDTRANSPORTISTA_FK 	=	$idUserType
			AND 	$CH.IDCHOFER 			= 	$CA.IDCHOFER_FK");
		return $this->Generic_model->doQueryObject($query);
	}

	function fetch_ofertas_by_month_year($tablaOferta,$month = "-1", $year = "-1")
	{
		$table = json_decode(_TABLE,true);
		$query = "";
		$region = $table["region"]["name"];									$R1 = $table["region1"]["alias"];
																												$R2 = $table["region2"]["alias"];
		$empresa = $table["empresa"]["name"];								$E = $table["empresa"]["alias"];
		$transportista = $table["transportista"]["name"];		$TR = $table["transportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];	$GC = $table["generadorcarga"]["alias"];
		$OF = "OF"; // aslias oferta
		if($tablaOferta=="ofertacarga"){
				$select = "
							$E.razon_social as empresa,
							$E.mail_contacto as email,
							$R1.nombre as nregion_origen,
							$R2.nombre as nregion_destino,
							$OF.*";
				$JoinUser = "JOIN $generadorcarga $GC ON $GC.idgeneradorcarga = $OF.idgeneradorcarga_fk
										JOIN $empresa $E ON $E.idaccount = $GC.idaccount";
				$JoinRegion1 = "JOIN $region $R1 ON $OF.origen_region = $R1.idregion";
				$JoinRegion2 = "JOIN $region $R2 ON $OF.destino_region = $R2.idregion";

		}else if($tablaOferta=="ofertatransportista"){
			$select = "
						$E.razon_social as empresa,
						$E.mail_contacto as email,
						$R1.nombre as nregion_origen,
						$R2.nombre as nregion_destino,
						$OF.*";
			$JoinUser = "JOIN $transportista $TR ON $TR.idtransportista = $OF.idtransportista_fk
									JOIN $empresa $E ON $E.idaccount = $TR.idaccount";

			$JoinRegion1 = "JOIN $region $R1 ON $OF.region_ubicacion = $R1.idregion";
			$JoinRegion2 = "JOIN $region $R2 ON $OF.region_destino = $R2.idregion";
		}
		$query = $this->db->query("
			SELECT
			$select
			FROM $tablaOferta $OF
			$JoinUser $JoinRegion1 $JoinRegion2
			WHERE
			(MONTH( fecha_publicacion ) = ".intval($month)."
			OR ( '$month' = '-1'	AND MONTH( fecha_publicacion ) = MONTH(NOW()) ) )
			AND
			(YEAR( fecha_publicacion ) = ".intval($year)."
			OR ( '$year' = '-1'	AND YEAR( fecha_publicacion ) = YEAR(NOW()) ) )
		");



		return $this->Generic_model->doQueryObject($query);
	}

	

	function get_ofertatransportista_by_id($id,$idUserType,$limit, $start)
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"];
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"];
		$ciudad = $table["ciudad"]["name"];
																		$C1 = $table["ciudad1"]["alias"];
																		$C2 = $table["ciudad2"]["alias"];

		$query = $this->db->query("
			SELECT
				$OT.idofertatransportista,		$OT.IDTRANSPORTISTA_FK,
				$OT.fecha_publicacion, 			$OT.patente, 			$OT.tipo_camion,
				$OT.fecha_disponibilidad, 		$OT.detalle,
				$OT.ubicacion, 					$OT.DESTINO_PREFERENTE AS destino,
				$OT.direccion_ubicacion, 		$OT.direccion_destino,
	        	$CH.NOMBRE AS chofer
			FROM  $ofertatransportista $OT
			JOIN  $chofer $CH ON $CH.IDTRANSPORTISTA_FK = $OT.IDTRANSPORTISTA_FK
			JOIN  $camion $CA ON $CA.PATENTE 			= $OT.PATENTE
			WHERE $OT.IDTRANSPORTISTA_FK =	$idUserType
			AND $CH.IDCHOFER = $CA.IDCHOFER_FK
			AND $OT.idofertatransportista = $id");

		return $this->Generic_model->doQueryObject($query);
	}


	function ofertatransportista_update_by_id($id = 0, $data)
	{
		$table = json_decode(_TABLE,true);
		if ($id != 0) {
			$this->db->where('idofertatransportista', $id);
			$value = $this->db->update($table["ofertatransportista"]["name"], $data);
			return true;
		}else{
			return false;
		}
	}


	function ofertatransportista_delete_by_id($id = 0)
	{
		$table = json_decode(_TABLE,true);
		if ($id != 0) {
			$this->db->delete($table["ofertatransportista"]["name"],array('idofertatransportista' => $id));
			return true;
		}else{
			return false;
		}
	}


	function get_num_ofertatransportista_by_id($id)
	{
		$this->db->limit($limit, $start);

		$query = $this->db->query("
			SELECT
			$OT.idofertatransportista,		$OT.IDTRANSPORTISTA_FK,
			$OT.fecha_publicacion, 			$OT.patente, 			$OT.tipo_camion,
			$C1.NOMBRE AS ubicacion, 		$C2.NOMBRE AS destino,
	        $CH.NOMBRE AS chofer
			FROM  $ofertatransportista $OT
			JOIN  $ciudad $C1 ON $C1.IDCIUDAD 			= $OT.UBICACION
			JOIN  $ciudad $C2 ON $C2.IDCIUDAD 			= $OT.DESTINO_PREFERENTE
			JOIN  $chofer $CH ON $CH.IDTRANSPORTISTA_FK = $OT.IDTRANSPORTISTA_FK
			JOIN  $camion $CA ON $CA.PATENTE 			= $OT.PATENTE
			WHERE $OT.IDTRANSPORTISTA_FK =$id
			AND $CH.IDCHOFER = $CA.IDCHOFER_FK");
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return false;
	}

///////////////////////////// CRUD FOR oa TABLE //////////////////////////////////////////////////

}
