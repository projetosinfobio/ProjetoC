<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CLogin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('MLogin');
    }
    
    public function index(){
        /*
        Função que carrega a pagina de login
        */
        $this->load->view('login/VLogin');
        
    }

    public function login_user(){
        /*
        Função que pega os dados de login e senha e carrega o homepage adequado para o usuário conform seu perfil
        */

        $alerta = null;

        if($this->input->post('entrar') === 'entrar'){
            //proteção contra ataque de captcha
            if($this->input->post('captcha')) redirect ('index.php/CLogin/login_user');

            //Validação do formulário
            $this->form_validation->set_rules('usuario','USUARIO','required');
            $this->form_validation->set_rules('senha','SENHA','required|min_length[3]|max_length[45]');

            //Checando se a entrada de dados inicial está ok
            if($this->form_validation->run() === TRUE){
                //carrega o model usuarios
                $this->load->model('MLogin');
           
                //checando se a credencial existe
                $result = $this->MLogin->check_login();
                
                switch ($result) {
                    case 'incorrect credentials':
                        //login inválido
                        $alerta = array(
                        "class" => "danger",
                        "mensagem" => "Dados inválidos, senha ou email incorreto."
                        );
                        break;
                    case 'administrador':
                        redirect('index.php/CAdministrador');
                        break;
                    case 'organizador':
                        redirect('index.php/COrganizador');
                        break;
                    case 'submissor':
                        redirect('index.php/CSubmissor');
                        break;                            
                    case 'curador':
                        redirect('index.php/CCurador');
                        break;                          
                    default:
                        //login inválido
                        $alerta = array(
                        "class" => "danger",
                        "mensagem" => "Dados inválidos, cheque seu cadastro."
                        );
                        break;
                }

            }else{
                $alerta = array(
                    "class" => "danger",
                    "mensagem" => "Entrada inválida, tente novamente."
                    //.validation_errors()
                );
            }

        }

        $dados = array(
            "alerta" => $alerta
        );
        $this->load->view('login/VLogin', $dados);
    }
    
    public function sair(){
        /*
        Função que encerra a sessão do usuário, carregando novamente a página de login após o encerramento da sessão
        */
        $this->session->sess_destroy();
        $this->load->view('login/VLogin');
    } 
}