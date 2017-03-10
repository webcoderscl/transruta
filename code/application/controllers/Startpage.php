<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Startpage extends CI_Controller
{
    /* Configuration settings */

    public $total_questions = 10;
    public $teacher_mail = "x.magdato@gmail.com";
    public $dificultad_secondsperquestion = array("facil" => 90, "intermedio" => 60, "dificil" => 30);

    /*end Configuration settings */

    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->database();
        /*cash control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    /***default function, redirects to login page if no admin logged in yet***/
    public function index()
    {
        $page_data['page_title'] = 'Ejercita Tonos';
        $this->Crud_model->oa_insert($this->total_questions);
        $idoa = $this->db->insert_id();        
        $this->session->set_userdata('idoa', $idoa);
        $this->session->set_userdata('playername', 'None');
        $this->session->set_userdata('dificultad', 'None');
        $this->session->set_userdata('teacher_mail', $this->teacher_mail);

        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'email'));

        $config = array(
            array(
                'field' => 'playername',
                'label' => 'Playername',
                'rules' => 'required|xss_clean'
            ),      
            array(
                'field' => 'dificultad',
                'label' => 'Dificultad',
                'rules' => 'required|xss_clean|callback__validate_creation'
            )     
        );
        
        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('_validate_creation',  ' Creación fallida!');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">
                                <button type="button" class="close" data-dismiss="alert">×</button>', '</div>');
        
        
        if ($this->form_validation->run() == FALSE) {
            
            $page_data['flash_message'] = 'Hola, por favor ingrese estos campos antes de comenzar!!';       
            $this->load->view('startpage',$page_data);
        } else {
            $pname = $this->session->userdata('playername');
            $dificultad = $this->session->userdata('dificultad');           

            if ($pname != 'None' && $dificultad != 'None'){
                $this->session->unset_userdata('secperquestion');
                $this->session->set_userdata('secperquestion', strval($this->dificultad_secondsperquestion[$dificultad]));  
                $this->Crud_model->oa_update_field_by_id($this->session->userdata("idoa"),'player_name',$pname);
                $this->Crud_model->oa_update_field_by_id($this->session->userdata("idoa"),'dificultad',$dificultad);
                $this->Crud_model->questions_insert($this->total_questions);
                redirect(base_url() . '?Questions', 'refresh');
            }
            else{
                //print_r($pname);
                //print_r($dificultad);
                $page_data['flash_message'] = 'Campos ingresados invalidos';       
                $this->load->view('startpage',$page_data);
            }
        }


    }
    
    /***validate login****/
    function _validate_creation($str)
    {
        $playername = $this->input->post('playername');
        $dificultad = $this->input->post('dificultad');               
        $this->session->unset_userdata('dificultad');
        $this->session->set_userdata('dificultad', $dificultad);
        $this->session->unset_userdata('playername');
        $this->session->set_userdata('playername', $playername);
        $idoa = $this->session->userdata('idoa');

        return (intval($idoa) > 0 && $playername != 'None' && $dificultad != 'None');
            
    
    }
    

   

    
    
    /***DEFAULT NOT FOUND PAGE*****/
    function four_zero_four()
    {
        $id = $this->session->userdata("idoa");            
        $current_question = $this->Crud_model->oa_get_field_by_id($id,'current_question')->current_question;
        $page_data['current_question'] = $current_question;     
        $this->load->view('four_zero_four',$page_data);
    }

    /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() , 'refresh');
    }
    
}
