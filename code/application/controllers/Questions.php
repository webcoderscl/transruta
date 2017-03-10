<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	date	: 20 August, 2013
 *	University Of Dhaka, Bangladesh
 *	Ekattor School & College Management System
 *	http://codecanyon.net/user/joyontaroy
 */

class Questions extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        
		$this->load->database();
        $this->load->model('Crud_model');
        $this->load->library("pagination");
        //$this->load->library('encryption');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    function generateRandomString($length = 8) {
      $characters = '';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    /***default functin, redirects to login page if no admin logged in yet***/

   
    public function index()
    {
        if ($this->session->userdata('playername') == 'None')
            redirect(base_url() . '?Startpage', 'refresh');
        else{
            $page_data['page_name']  = 'startgame';
            $page_data['page_title'] = 'Aprende Chino';
            $id = $this->session->userdata("idoa");
            $result = $this->Crud_model->oa_set_countdown_by_id($id);
            $current_question = $this->Crud_model->oa_get_field_by_id($id,'current_question')->current_question;
            $total = $this->Crud_model->oa_get_field_by_id($id,"total")->total;
            //print_r($current_question);
            if(intval($current_question) == 1 && intval($current_question) <= $total  && intval($result["currenttimeSeconds"]) > 0){
                $page_data['currenttimeFormat'] = $result["currenttimeFormat"];
                $page_data['currenttimeSeconds'] = $result["currenttimeSeconds"];
                $page_data['current_question'] = $current_question;
                $page_data['BtnNext'] = ($current_question < $total) ? "Siguiente":"Finalizar";
                $this->Crud_model->createQuestions();
                $page_data["questions"] = $this->Crud_model->questions_get_all_by_id($id,$current_question);                
                $this->load->view("questions",$page_data);
            }else{ //muestro pag error
                $page_data['current_question'] = $current_question;
                if(intval($result["currenttimeSeconds"]) == 0 || $current_question > $total) {
                    redirect(base_url() . '?Questions/finalreport', 'refresh');
                }else{
                    $this->load->view("four_zero_four",$page_data);    
                }
                
            }
        }
    }
   
    /*trying ajax response!! */
    public function next_question($number = 1){
         if ($this->session->userdata('playername') == 'None')
            redirect(base_url() . '?Startpage', 'refresh');
        else{            
             
            $id = $this->session->userdata("idoa");            
            $current_question = $this->Crud_model->oa_get_field_by_id($id,'current_question')->current_question;
            $result = $this->Crud_model->oa_get_countdown_by_id($id);
            $total = $this->Crud_model->oa_get_field_by_id($id,"total")->total;
            if(intval($current_question + 1) == $number && intval($current_question) <= ($total)  && intval($result["currenttimeSeconds"]) > 0){                                          
                $this->Crud_model->oa_update_field_by_id($id,'current_question',$number);  
                $chosen_tone = $this->input->post("tonos");
                $data = array('chosen_tone' => $this->input->post("tonos") );                
                $this->Crud_model->questions_update_fields_by_id_numberq($id,$current_question,$data,true);
                //despues de actualizar compruebo la respuesta y la guardo como hit o miss
                $this->Crud_model->questions_update_and_check_fields_by_id_numberq($id,$current_question,$data);
                redirect(base_url().'?Questions/curr_question/'.$number,'refresh');
            
            } else{ //muestra error
                $page_data['current_question'] = $current_question;
                if(intval($result["currenttimeSeconds"]) == 0 || $current_question > $total) {
                    redirect(base_url() . '?Questions/finalreport', 'refresh');
                }else{
                    $this->load->view("four_zero_four",$page_data);    
                }
            
            }
        }
    }

    public function curr_question($number = 1){
         if ($this->session->userdata('playername') == 'None')
            redirect(base_url() . '?Startpage', 'refresh');
        else{            
            $page_data['page_name']  = 'questions';
            $page_data['page_title'] = 'Aprende Chino';
            $id = $this->session->userdata("idoa");            
            $current_question = $this->Crud_model->oa_get_field_by_id($id,'current_question')->current_question;
            $result = $this->Crud_model->oa_get_countdown_by_id($id);
            $total = $this->Crud_model->oa_get_field_by_id($id,"total")->total;
            //print_r($current_question);
            if(intval($current_question) == $number && intval($current_question) <= $total && intval($result["currenttimeSeconds"]) > 0){
                $page_data['currenttimeFormat'] = $result["currenttimeFormat"];
                $page_data['currenttimeSeconds'] = $result["currenttimeSeconds"];
                $page_data['current_question'] = $current_question;                
                $page_data['BtnNext'] = ($current_question < $total) ? "Siguiente":"Finalizar";
                $page_data["questions"] = $this->Crud_model->questions_get_all_by_id($id,$current_question); 
                $this->load->view("questions",$page_data);
            
            } else{ //muestra error
                $page_data['current_question'] = $current_question;
                if(intval($result["currenttimeSeconds"]) == 0 || $current_question > $total) {
                    redirect(base_url() . '?Questions/finalreport', 'refresh');
                }else{
                    $this->load->view("four_zero_four",$page_data);    
                }
            
            }
        }
    }
    
    public function finalreport(){
         if ($this->session->userdata('playername') == 'None'){
            redirect(base_url() . '?Startpage', 'refresh');
        }else{                   

           $page_data['page_name']  = 'finalresult';
            $page_data['page_title'] = 'Resultados';
            $idoa = $this->session->userdata('idoa');
            $result = array();
            $datarow = array();
            $i = 1;
            $best_tone = array("tone" => -1,"freq" => -1,"pct" => 0);
            $worst_tone = array("tone" => -1,"freq" => -1, "pct" => 0);
            for ($i = 1;$i <=4;$i++){
                $rights = intval($this->Crud_model->questions_get_percent_by_id($idoa,$i,"right") );
                $wrongs = intval($this->Crud_model->questions_get_percent_by_id($idoa,$i,"wrong") );
                //$total = intval($this->Crud_model->questions_get_percent_by_id($idoa,$i,"total") );
                $total = $rights + $wrongs;    
                if ($total == 0)
                    $datarow = array("percent_miss" => "No aplica", "percent_hits" => "No aplica");
                else{
                    $ms = number_format( (($wrongs/$total)*100), 2 , ",", ".");
                    $ht = number_format( (($rights/$total)*100), 2 , ",", ".");
                    if( intval($best_tone["pct"]) < intval($ht)  ){ $best_tone["tone"] = $i; $best_tone["freq"] = $rights;$best_tone["pct"] = $ht; }
                    if( intval($worst_tone["pct"]) < intval($ms) ){ $worst_tone["tone"] = $i; $worst_tone["freq"] = $wrongs; $worst_tone["pct"] = $ms; }
                
                    $datarow = array("percent_miss" => $ms, "percent_hits" => $ht);
                }
                $result[$i]  = $datarow;
            }
            $globalresult = $this->Crud_model->oa_get_all_by_id($idoa);
            $page_data['result_percent'] = $result;
            $page_data['finalresult'] = $globalresult;
            $page_data['best'] = $best_tone;
            $page_data['worst'] = $worst_tone;            
            $this->load->view("finalresult",$page_data);
           
        }
        
        
    }
   
     public function send(){
         if ($this->session->userdata('playername') == 'None'){
            redirect(base_url() . '?Startpage', 'refresh');
        }else{                              
            
            $idoa = $this->session->userdata('idoa');
            $result = array();
            $datarow = array();
            $i = 1;
            $best_tone = array("tone" => -1,"freq" => -1,"pct" => 0);
            $worst_tone = array("tone" => -1,"freq" => -1, "pct" => 0);
            for ($i = 1;$i <=4;$i++){
                $rights = intval($this->Crud_model->questions_get_percent_by_id($idoa,$i,"right") );
                $wrongs = intval($this->Crud_model->questions_get_percent_by_id($idoa,$i,"wrong") );
                //$total = intval($this->Crud_model->questions_get_percent_by_id($idoa,$i,"total") );
                $total = $rights + $wrongs;    
                if ($total == 0)
                    $datarow = array("percent_miss" => "No aplica", "percent_hits" => "No aplica");
                else{
                    $ms = number_format( (($wrongs/$total)*100), 2 , ",", ".");
                    $ht = number_format( (($rights/$total)*100), 2 , ",", ".");
                    if( intval($best_tone["pct"]) < intval($ht)  ){ $best_tone["tone"] = $i; $best_tone["freq"] = $rights;$best_tone["pct"] = $ht; }
                    if( intval($worst_tone["pct"]) < intval($ms) ){ $worst_tone["tone"] = $i; $worst_tone["freq"] = $wrongs; $worst_tone["pct"] = $ms; }
                
                    $datarow = array("percent_miss" => $ms, "percent_hits" => $ht);
                }
                $result[$i]  = $datarow;
            }
            $globalresult = $this->Crud_model->oa_get_all_by_id($idoa);
            
            $this->Email_model->sendReport($globalresult,$result);
            redirect(base_url()."?Questions/finalreport",'refresh');
            
           
        }
        
        
    }

   

        /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();       
        redirect(base_url() , 'refresh');
    }
    
        
}
