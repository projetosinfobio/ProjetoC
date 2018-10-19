<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class MCurador extends CI_Model {
    
      //-------------------- Construtor do Model---------------------- 
      function __construct() { 
         parent::__construct(); 
      } 
        
      public function get_nome_titulo_status(){        
        $this->db->where('tipo_usuario', 'submissor');
        $dados = $this->db->get('usuario')->result();
        return $dados;
      }

      //Aqui não se usa os acessors(get e set) porque o php teria que ficar instanciando toda hora a classe e isso deixaria o sistema mais lento.
      
      
      //-------------------- Funções para o banco ----------------------
     

      //Consulta os textos encaminhados para o curador
      public function consultaTextoCurador($id_do_curador){
        $this->db->select('u.id_usuario, u.nome, u.cpf, u.email, titulo, mensagem, status, tipo_texto, fk_id_eixo, fk_id_curador, id_texto');
  	    $this->db->from('texto t');
  	    $this->db->join('submissor s','t.fk_id_submissor = s.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
  	    $this->db->join('usuario u','s.fk_id_usuario = u.id_usuario', 'inner');
  	    $this->db->where('fk_id_curador', $id_do_curador); 

  	    $query = $this->db->get(); //Realiza a consulta inteira.
  	    
  	    return $query->result(); //Retorna o que foi obtido da consulta.
      }

      public function editarUmTitulo($id_submissor, $id_texto, $novo_titulo){
        $this->db->where('id_texto', $id_texto);
        $this->db->set('titulo', $novo_titulo); 
        $this->db->update('texto');
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco"; 
      }

      public function editarUmTexto($id_submissor, $id_texto, $novotexto){
        $this->db->where('id_texto', $id_texto);
        $this->db->set('mensagem', $novotexto); 
        $this->db->update('texto');
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco"; 
      }

      //aceitar um texto
      public function aceitarUmTexto($id_submissor, $id_texto){
        $this->db->where('fk_id_submissor', $id_submissor); 
        $this->db->where('id_texto', $id_texto); 
        $this->db->set('status', 2); 
        $this->db->update('texto');
        //e chama um controller ou na sequencia alterar o status para tttr sei la
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco";
      }

      //rejeitar um texto
      public function rejeitarUmTexto($id_submissor, $id_texto){
        $this->db->where('fk_id_submissor', $id_submissor); 
        $this->db->where('id_texto', $id_texto); 
        $this->db->set('status', 3); 
        $this->db->update('texto');
        //e chama um controller ou na sequencia alterar o status para tttr sei la
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco";
      }

      public function consultaPareceres_e_Respostas($id_do_texto){
        /*$this->db->select('t.id_texto, p.seq, p.comentario, p.resposta');
        $this->db->from('texto t');
        $this->db->join('parecer p','t.id_texto = p.fk_id_texto', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
*/

        $this->db->select('p.seq, p.comentario, p.resposta');
        $this->db->from('parecer p');
        $this->db->where('fk_id_texto', $id_do_texto); 

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.


      }

      public function consultaNumeroSeq($id_do_texto){
        $this->db->select('seq');
        $this->db->from('parecer');
        $this->db->where('fk_id_texto', $id_do_texto); 

        $query = $this->db->get(); //Realiza a consulta inteira.

        return $query->num_rows(); //Retorna o que foi obtido da consulta.
      }
      
      /*Esta função ativa a autorização de mandar nova versão*/
      public function ativarEnvioNovaVersao($id_do_texto){
        $this->db->where('id_texto', $id_do_texto);
        $this->db->set('autorizar_update', '1'); 
        $this->db->update('texto');
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco"; 
      }


      
   } //Fim classe
?> 


