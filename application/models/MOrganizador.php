<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class MOrganizador extends CI_Model {
    
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
      

      //Função que consulta todos os curadores e a quantidade de trabalhos que esses curadores possuem. Esses curadores estão no mesmo eixo que o organizador.


      //PRIMERIO: A LISTA DAS funções pela ordem que foram chamados no controller COrganizador

      //Consulta o eixo do organizador.
      public function consultaEixoOrganizador($id_usuario){
        $this->db->select('fk_eixo');
        $this->db->from('curador c');
        $this->db->join('usuario u','c.fk_id_usuario = u.id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->where('u.id_usuario', $id_usuario); 

        $resultado = '';

        $query = $this->db->get(); //Realiza a consulta inteira.

        foreach ($query->result() as $row)
        {
          $resultado = $row->fk_eixo;
        }
      
        return $resultado;

        //return $query->result(); //Retorna o que foi obtido da consulta.
      }

      public function consultaTodosOsTextos(){
        $this->db->select('u.id_usuario, u.nome, u.cpf, u.email, titulo, mensagem, status, tipo_texto, fk_id_eixo, fk_id_curador, id_texto');
        $this->db->from('texto t');
        $this->db->join('submissor s','t.fk_id_submissor = s.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->join('usuario u','s.fk_id_usuario = u.id_usuario', 'inner');

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
      }
      

      //Função que consulta o texto de um eixo específico.
      public function consultaTextoUsuarioEixo($id_eixo){
        $this->db->select('u.id_usuario, u.nome, u.cpf, u.email, titulo, mensagem, status, tipo_texto, fk_id_eixo, fk_id_curador, id_texto');
        $this->db->from('texto t');
        $this->db->join('submissor s','t.fk_id_submissor = s.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->join('usuario u','s.fk_id_usuario = u.id_usuario', 'inner');

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
      }

      public function consultaCuradoresEixo($eixo_do_organizador){
        $this->db->select('u.id_usuario, u.nome, count(t.fk_id_curador) as quant');
        $this->db->from('usuario u');
        $this->db->join('curador c','u.id_usuario = c.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->join('texto t','t.fk_id_curador = c.fk_id_usuario', 'inner');
        $this->db->group_by("u.nome"); //Agrupando a consulta pela coluna nome da tabela usuario.zz

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
    
      }

      /*Funcao que consulta os curadores de umm determinado eixo. 
      Tem o "2" na nome da funcao porque tem uma funcao neste mesmo arquivo com o mesmo nome e este é uma adaptação da funçao consultaCuradoresEixo*/
      public function consultaCuradoresEixo2($eixo_do_organizador){
        //echo $eixo_do_organizador;
        $this->db->select('u.id_usuario, u.nome, u.email');
        //$this->db->group_by("t.fk_id_curador"); 
        $this->db->from('usuario u');
        $this->db->join('curador c','u.id_usuario = c.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        //$this->db->join('texto t','t.fk_id_eixo = c.fk_eixo', 'inner');
        //$this->db->join('texto t','t.fk_id_curador = c.fk_id_usuario', 'inner');
        $this->db->group_by("u.nome"); //Agrupando a consulta pela coluna nome da tabela usuario.
        
        $this->db->where('c.eh_padrao', 1); 
        $this->db->where('c.fk_eixo', $eixo_do_organizador); 

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
    
      }

      //Função que altera o eixo de algum texto.
      public function alteraEixoTexto($fk_id_eixo, $id_texto) { 
        $id_curador = 0;
          switch ($fk_id_eixo) {
              case 1:
                  $id_curador = 11; 
                  break;
              case 2:
                  $id_curador = 3; 
                  break;
              case 3:
                  $id_curador = 4; 
                  break;
              case 4:
                  $id_curador = 6; 
                  break;
              case 5:
                  $id_curador = 7; 
                  break;
              case 6:
                  $id_curador = 8; 
                  break;
          }

        $this->db->where('id_texto', $id_texto);
        $this->db->set('fk_id_eixo', $fk_id_eixo); 
        $this->db->set('fk_id_curador', $id_curador);
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

      //Função que altera o curador de um texto ou encaminha um texto para um determinado curador.
      public function alteraCuradorParaUmTexto($id_texto_do_submissor, $fk_id_curador) { 
        
        $this->db->where('id_texto', $id_texto_do_submissor);
        $this->db->set('fk_id_curador', $fk_id_curador); 
        $this->db->set('status', 1); 
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

      /*Esta funcao conta o número total de trabalhos submetidos*/
      public function consultaNumeroTotalDeTrabalhos(){
        $this->db->select('*');
        $this->db->from('texto');
        $query = $this->db->get(); //Realiza a consulta inteira.
        return $query->num_rows(); //Retorna o que foi obtido da consulta.
      } 

      //AGORA: AS FUNCOES DE MODEL CHAMADAS NOS VIEW VDashboard do Organizador (e que não foram listados até agora)

      /*Esta função conta o número de trabalhos submetidos nu determinado eixo. 
      Basicamnete seleciona o id do eixo (eixo do organizador) e conta o numero de registros que pertencem ao aixo 2 na tabela "texto"*/
      public function consultaNumeroTrabalhosPorEixo($eixo_do_organizador){
        $this->db->select('fk_id_eixo');
        $this->db->from('texto');
        $this->db->where('fk_id_eixo', $eixo_do_organizador); 

        $query = $this->db->get(); //Realiza a consulta inteira.

        return $query->num_rows(); //Retorna o que foi obtido da consulta.
      }

      //Consulta o nome do curador.
      /*
      O curador é um usuario só que possui algusn dados em outra tabela (a tavela curador C).
      por isso usa o innerjoin para unificar os dados
      */
      public function consultaNomeCurador($fk_id_curador){
        $this->db->select('nome');
        $this->db->from('usuario u');
        $this->db->join('curador c','u.id_usuario = c.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->where('c.fk_id_usuario', $fk_id_curador); 

        $resultado = '';

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        foreach ($query->result() as $row)
        {
          $resultado = $row->nome;
        }
      
        return $resultado;

        //return $query->result(); //Retorna o que foi obtido da consulta.
      }

      //Consulta o email do curador.
      /*
      O curador é um usuario só que possui algusn dados em outra tabela (a tavela curador C).
      por isso usa o innerjoin para unificar os dados
      */
      public function consultaEmailCurador($fk_id_curador){
        $this->db->select('email');
        $this->db->from('usuario u');
        $this->db->join('curador c','u.id_usuario = c.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->where('c.fk_id_usuario', $fk_id_curador); 

        $resultado = '';
        
        $query = $this->db->get(); //Realiza a consulta inteira.
        
        foreach ($query->result() as $row)
        {
          $resultado = $row->email;
        }
      
        return $resultado;
      }

      
      public function consultaIdCurador($id_do_texto){
        $this->db->select('fk_id_curador');
        $this->db->from('texto t');
        $this->db->where('t.id_texto', $id_do_texto); 
        
        $resultado = '';


        $query = $this->db->get(); //Realiza a consulta inteira.
        
        foreach ($query->result() as $row)
        {
          $resultado = $row->fk_id_curador;
        }
      
        return $resultado;
      }


      public function consultaTituloTexto($id_do_texto){
        $this->db->select('titulo');
        $this->db->from('texto t');
        $this->db->where('t.id_texto', $id_do_texto); 

        $resultado = '';

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        foreach ($query->result() as $row)
        {
          $resultado = $row->titulo;
        }
      
        return $resultado;
      }
      /*Esta função procura o curador pelo seu id e conta o número de trabalhos encaminhados a ele. 
      isso coresponde ao número de textos com fk_id_curador igual ao id do curador*/
      public function consultaNumeroTrabalhosPorCurador($id_do_curador){
        $this->db->select('fk_id_curador');
        $this->db->from('texto');
        $this->db->where('fk_id_curador', $id_do_curador); 

        $query = $this->db->get(); //Realiza a consulta inteira.

        return $query->num_rows(); //Retorna o que foi obtido da consulta.
      }




      /*
      Esta finção está vinculado ao funcao do controller Corganizador->visualizar_comprovante.
      Não sei se precisa entrar no banco com o nome do arquivo e fazer uma mágica. 
      NÂO APAGUE, vai que precisa
      */

      public function consultarComprovante($nomeArquivo){
        $this->db->select('s.comp_pago');
        $this->db->from('submissor s');
        $this->db->where('s.comp_pago', $nomeArquivo); 
        $query = $this->db->get();
        return $query->num_rows();
      }

      //uma função  para calcular numero de curadores mas não sei porque acabei nao usando. NÂO APAGUE, vai que precisa
      public function consultaCuradoresQuantTrabalhos2(){
        
        $this->db->select('u.nome, count(t.fk_id_curador)');
        $this->db->from('usuario u');
        $this->db->join('curador c','u.id_usuario = c.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->join('texto t','t.fk_id_curador = c.fk_id_usuario', 'inner');
        $this->db->group_by("u.nome"); //Agrupando a consulta pela coluna nome da tabela usuario.

        $this->db->where('u.id_usuario', $id); 

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->num_rows(); //Retorna o que foi obtido da consulta.
      }

      /*Esta funçao consulta o número de textos submetidos em total*/
      public function consultaNumeroTrabalhos(){  
        //$this->db->select('u.nome, count(t.fk_id_curador)'); 
        $this->db->select('t.fk_id_eixo');
        $this->db->from('texto t');
        //$this->db->where('t.fk_id_eixo', $eixo); 
        $query = $this->db->get(); //Realiza a consulta inteira.
        return $query->num_rows();
      }

      /*Esta funçao consulta o nome do arquivo do comprovante de pagamento submetido pelo submissor*/
      public function buscarNomeComprovante($id_submissor){  
        $this->db->select('comp_pago');
        $this->db->from('submissor s');
        $this->db->where('s.fk_id_usuario', $id_submissor); 

        $resultado = '';

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        foreach ($query->result() as $row)
        {
          $resultado = $row->comp_pago;
        }
      
        return $resultado;
      }

      //----
      /*----DEMAIS FUNCÕES DO MODEL MOrganizador----------------------------------
      //--Funcoes que podem ser uteis ou inspiram as que estão em uso. Antes de acrescentar uma função, verifique se já tem aqui------------------------*/

      /* INICIO DO COMENTARIO DE N LINHAS
      //Função que consulta o comprovante de pagamento.
      public function consultaCompPagamento($id_texto){
        $this->db->select('fk_id_submissor, id_texto, comp_pago');
        $this->db->from('texto t');
        $this->db->join('submissor s','t.fk_id_submissor = s.fk_id_usuario', 'left'); //O "Left" representa que a junção (join) será do tipo LEFT JOIN.
        $this->db->where('id_texto', $id_texto); 

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
      }

      //Função que consulta o texto de um usuário específico.
      public function consultaTextoUsuarioEspecifico($id_usuario){
        $this->db->select('u.id_usuario, u.nome, u.email, titulo, mensagem, status, id_texto');
        $this->db->from('texto t');
        $this->db->join('submissor s','t.fk_id_submissor = s.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->join('usuario u','s.fk_id_usuario = u.id_usuario', 'inner');
        $this->db->where('s.fk_id_usuario', $id_usuario); 

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
      }

      //Função que consulta os textos por eixo.
      public function consultaTextoPorEixo($id_eixo){
        $this->db->select('titulo, mensagem, status_texto');
        $this->db->from('eixo e');
        $this->db->join('text t','t.fk_id_eixo = e.id_eixo', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->where('e.id_eixo', $id_eixo); 

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
      }
      
      //Função que consulta o status de um comprovante(pago_ok).
      //Se pago_ok = false ou 0 -> ainda não foi aprovado o comprovante de pagamento. 
      //E, se pago_ok = true ou 1 -> já foi aprovado o comprovante de pagamento.
      public function consultaStatusComprovante($id_texto){
        $this->db->select('u.id_usuario, u.nome, id_texto, pago_ok');
        $this->db->from('texto t');
        $this->db->join('submissor s','t.fk_id_submissor = s.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->join('usuario u','s.fk_id_usuario = u.id_usuario', 'inner');
        $this->db->where('id_texto', $id_texto); 

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
      }


      //Função que altera o status do comprovante de pagamento. (Se o comprovante foi aceito ou não.)
      public function alteraStatusComprovante($status, $fk_id_usuario) { 
        
        $this->db->where('fk_id_usuario', $fk_id_usuario);
        $this->db->set('pago_ok', $status); //O status é uma variável booleana. Se = true comprovante aceito e se = false comprovante recusado.
        $this->db->update('submissor');
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco"; 
      }     

      //Função que consulta todos os curadores e a quantidade de trabalhos que esses curadores possuem.
      public function consultaCuradoresQuantTrabalhos(){
        
        $this->db->select('u.nome, count(t.fk_id_curador)');
        $this->db->from('usuario u');
        $this->db->join('curador c','u.id_usuario = c.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->join('texto t','t.fk_id_curador = c.fk_id_usuario', 'inner');
        $this->db->group_by("u.nome"); //Agrupando a consulta pela coluna nome da tabela usuario.

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
      }

   /* ---------------- FUNÇÕES BASES PARA O BANCO ---------------------------
      // Nomenclatura dos arquivos:
      // models: Usuario_Model
      // controllers: Usuario_Controller
      // views: Usuario_View
      
      //Função base para um insert.
      public function base_insert($campo1, $campo2) { 
        
         //As duas funções funcionam.
         $this->db->insert("usuario", $campo1, $campo2);
         // $this->db->insert("usuario", $array); 
         
         $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Inserido";
        else
          return "Erro no banco"; 
      } 

      //Função base para um update.
      public function base_update($campo1_id, $camposParaAtualizar) { 
        //$camposParaAtualizar é um array com os valores do campo para serem atualizados. (O nome dos campos do array precisam ter o mesmo nome que os campos da tabela)
        $this->db->where('nome_campo', $campo1_id);
        $this->db->set('campo1_que_sera_atualizado, campo2_que_sera_atualizado', $camposParaAtualizar);
        $this->db->update('nome_tabela');
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco"; 
      } 

      //Função base para uma consulta.
      public function base_consulta($id_campo){
        $this->db->select('campo1_da_tabela, campo2_da_tabela, campo3_da_tabela');
        $this->db->from('Nome_da_tabela1 t1');
        $this->db->join('Nome_da_tabela2 t2','t1.fk_id_campo = t2.fk_id_campo', 'left'); //O "Left" representa que a junção (join) será do tipo LEFT JOIN.
        $this->db->where('id_campo', $id_campo); 

        $query = $this->db->get(); //Realiza a consulta inteira.

        return $query->result(); //Retorna o que foi obtido da consulta.

      }
      */ //FIM DO COMENTARIO DE N LINHAS
      
   } //Fim classe
?> 