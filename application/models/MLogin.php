<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MLogin extends CI_Model {

    public function check_login(){
        
        //armazena os dados do formulario em variáveis
        $email = $this->input->post('usuario');
        $senha = $this->input->post('senha');
        
        //definindo o parametro from
        $this->db->from('usuario');
       
        //definindo os parametros where (especificando o usuário)
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
        
        //executando a query e armazenando o resultado nessa variável
        $result = $this->db->get();
        $row = $result->row();
        
        if($result->num_rows() === 1){
            //usuario existe
            $session_data = array(
                'id' => $row->id_usuario,
                'email' => $row->email,
                'nome' => $row->nome,
                'tipo' => $row->tipo_usuario,
                'cpf' => $row->cpf
            );
            $this->set_session($session_data);
            return $row->tipo_usuario;
        }else{
            return 'incorrect credentials';
        }
        
    }
    
    public function set_session($session_data){
        $sess_data = array(
            'id' => $session_data['id'],
            'email' => $session_data['email'],
            'nome' => $session_data['nome'],
            'tipo' => $session_data['tipo'],
            'cpf' => $session_data['cpf'],
            'logged_in' => 1
        );
        
        $this->session->set_userdata($sess_data);
    }

}