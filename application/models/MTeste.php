<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MTeste extends CI_Model {
    
    public function get_users_list(){        
        //$adm_email = $this->session->userdata('email');
        $this->db->where('tipo_usuario', 'submissor');
        //$this->db->where('idmanager', $adm_email);
        $dados = $this->db->get('usuario')->result();
        return $dados;
    }
    
    /*public function get_media_records($iduser){
        $this->db->where('iduser', $iduser);
        $this->db->order_by('datetime', 'desc');
        $dados = $this->db->get('media_records')->result();
        return $dados;
    }

    public function validate($idmedia){
        //name é o id do usuário e idmedia é o id do media record
        $this->db->where('id', $idmedia);
        $validated['validated'] = 'true';
        if($this->db->update('media_records',$validated)){
            return TRUE;
        }else{
            return FALSE;
        }
    }*/
}