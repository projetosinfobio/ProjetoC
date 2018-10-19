<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTeste extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('MTeste');
    }
    
    public function index(){
        if ($this->session->userdata('logged_in') && ($this->session->userdata('tipo') === 'administrador'
                || $this->session->userdata('tipo') === 'submissor'
                ) ) {
            //carrega a lista de pacientes para aquele funcionário
            $dados['records'] = $this->MTeste->get_users_list();
            //$dados['number_of_pacients'] = count($dados['pacients']);
            
            //carrega a view
            $this->load->view('includes/VHeader');
            $this->load->view('administrador/VMenu_bar');
            $this->load->view('administrador/VDashboardteste', $dados);
            $this->load->view('includes/VFooter');
        }else{
            $this->load->view('login/VLogin');
        }
    }
    
    public function list_records($iduser=null){
        
        $dados['pacients'] = $this->nurse_model->get_pac_list();
        $dados['records'] = $this->nurse_model->get_media_records($iduser);
        $dados['iduser'] = $iduser;
        
        //Verifica se um iduser de paciente foi passado e se esse iduser pertence ao agente
        if(isset($dados['iduser'])){
            if(count($dados['records']) > 0){
                if ($this->session->userdata('logged_in') && ($this->session->userdata('type') === 'agente de saúde'
                        || $this->session->userdata('type') === 'enfermeiro(a)'
                        || $this->session->userdata('type') === 'médico(a)'
                        ) ) {
                    $this->load->view('includes/html_header');
                    $this->load->view('nurse/nurse_header');
                    $this->load->view('nurse/media_records', $dados);
                    $this->load->view('includes/media_player');
                    $this->load->view('nurse/pac_list');

                    //verifica se o usuario esta bloqueando o download
                    $blocked = null; 
                    $result = $dados['records'];
                    if(count($result) > 0){
                        $blocked = $result[0]->downloadblock;
                    }
                    if($blocked === 'true'){
                        $this->load->view('includes/pac_footer_downloadblock');
                    }else{
                        $this->load->view('includes/pac_footer');
                    }   
                }else{
                    $this->load->view('login/view_login');
                }
            }else{
                $this->load->view('includes/html_header');
                $this->load->view('nurse/nurse_header');
                $this->load->view('errors/records_not_found');
                $this->load->view('includes/media_player');
                $this->load->view('nurse/pac_list', $dados);
            }
        }else{
            redirect('nurse');
        }
    }
    
    
    public function pac_manager(){
        if ($this->session->userdata('logged_in') && ($this->session->userdata('type') === 'agente de saúde'
                || $this->session->userdata('type') === 'enfermeiro(a)'
                || $this->session->userdata('type') === 'médico(a)'
                ) ) {
            //carrega a lista de pacientes para aquele funcionário
            $dados['pacients'] = $this->nurse_model->get_pac_list();
            //carrega a view
            $this->load->view('includes/html_header');
            $this->load->view('nurse/nurse_header');
            $this->load->view('nurse/pac_manager', $dados);
            $this->load->view('nurse/pac_list');
        }else{
            $this->load->view('login/view_login');
        }
    }
}