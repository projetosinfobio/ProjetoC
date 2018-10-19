<?php 
   class MUsuario extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 

         $this->load->database();
      } 
    
      
      //-------------------- Funções para o banco ----------------------
      
      //Essa função auxilia a cadastrarCuradorOuSubmissor, encontrando qual o id_usuario do usuário que acabou de ser inserido através do cpf.
      public function consultaUsuarioCadastrado($cpf) { 
        $this->db->select('id_usuario');
        $this->db->from('usuario');
        $this->db->where('cpf', $cpf);

        $resultado = '';

        $query = $this->db->get(); //Realiza a consulta inteira.

        foreach ($query->result() as $row)
        {
          $resultado = $row->id_usuario;
        }
      
        return $resultado; //Retorna o que foi obtido da consulta. (id_usuario que acabou de ser cadastrado.)
      }

      //Essa função recebe o id_usuario do usuário e retorna o cpf.
      public function consultaCpfUsuario($id_usuario) { 
        $this->db->select('cpf');
        $this->db->from('usuario');
        $this->db->where('id_usuario', $id_usuario);

        $resultado = '';

        $query = $this->db->get(); //Realiza a consulta inteira.

        foreach ($query->result() as $row)
        {
          $resultado = $row->cpf;
        }
      
        return $resultado; //Retorna o que foi obtido da consulta. (cpf de um determinado usuario)
      }

      //Essa função recebe o email do usuário e retorna o nome.
      public function consultaNomeUsuario($email) { 
        $this->db->select('nome');
        $this->db->from('usuario');
        $this->db->where('email', $email);

        $resultado = '';

        $query = $this->db->get(); //Realiza a consulta inteira.

        $resultado = "default";
        foreach ($query->result() as $row)
        {
          $resultado = $row->nome;
        }
        return $resultado; //Retorna o que foi obtido da consulta. (nome de um determinado usuario)
      }

      //Essa função recebe o email do usuário e retorna sua senha.
      public function consultaSenhaUsuario($email) { 
        $this->db->select('senha');
        $this->db->from('usuario');
        $this->db->where('email', $email);

        $resultado = '';

        $query = $this->db->get(); //Realiza a consulta inteira.

        $resultado = "default";
        foreach ($query->result() as $row)
        {
          $resultado = $row->senha;
        }
      
        return $resultado; //Retorna o que foi obtido da consulta. (senha de um determinado usuario)
      }

      //Essa função faz a inserção do usuário que acabou de ser cadastrado em alguma das tabelas: submissor ou curador.
      public function cadastrarCuradorOuSubmissor($cpf, $tipo_usuario) { 
        //Para cadastrar um organizador ou curador é preciso saber qual o seu eixo. (Fazer)

        $dados = array(
            'fk_id_usuario' => $this->consultaUsuarioCadastrado($cpf)
        );

        //Passando os dados recebidos para um array, pois serão inseridos no banco.
        if($tipo_usuario == 'organizador' || $tipo_usuario == 'curador'){
          $this->db->insert('curador', $dados);
        }
        else{
          if($tipo_usuario == 'submissor'){
            $this->db->insert('submissor', $dados);
          }//Fim if
        }//Fim else

        $rows = $this->db->affected_rows();

        if($rows > 0)
          return 2; //Se deu certo.
        else
          return 1; //Se deu errado.
      }//Fim função

      //Essa função faz a inserção do usuário que acabou de ser cadastrado através do cadastro especial na tabela de curadores
      public function cadastrarCuradorOuOrganizador($cpf, $tipo_usuario, $curador, $organizador, $eixo) { 
        //Para cadastrar um organizador ou curador é preciso saber qual o seu eixo. (Fazer)

        $dados = array(
            'fk_id_usuario' => $this->consultaUsuarioCadastrado($cpf),
            'eh_padrao' => $curador ,
            'eh_organizador' => $organizador,
            'fk_eixo' => $eixo,
        );

        //Passando os dados recebidos para um array, pois serão inseridos no banco.
        if($tipo_usuario == 'organizador' || $tipo_usuario == 'curador'){
          $this->db->insert('curador', $dados);
        }
        else{
          if($tipo_usuario == 'submissor'){
            $this->db->insert('submissor', $dados);
          }//Fim if
        }//Fim else

        $rows = $this->db->affected_rows();

        if($rows > 0)
          return 2; //Se deu certo.
        else
          return 1; //Se deu errado.
      }//Fim função

      //O id_usuario é auto increment
      public function cadastrar($nome, $cpf, $email, $senha, $curador, $submissor, $tipo_usuario) {   //Além de fazer o cadastro na tabela usuario é necessário fazer o cadastro na tabela curador ou na submissor.       
            
        //--------- Fazendo o cadastro na tabela usuario. ---------------
        //Passando os dados recebidos para um array, pois serão inseridos no banco.
        $dados1 = array(
            //o id_usuario auto incrementa entao não é necessario incluir
            'nome' => $nome,
            'cpf' => $cpf,
            'email' => $email,
            'senha' => $senha,
            'eh_curador' => $curador,
            'eh_submissor' => $submissor,
            'tipo_usuario' => $tipo_usuario
        );

        $this->db->insert('usuario', $dados1);

        //--------- Fazendo o cadastro na tabela submissor ou curador. ---------------
        $segundoCadastro = $this->cadastrarCuradorOuSubmissor($cpf, $tipo_usuario); //Faz a inserção do usuário dependendo de qual tipo ele é.

        $rows = $this->db->affected_rows();
        
        if($rows > 0 && $segundoCadastro == 2)
          return "Cadastrado nas duas tabelas.";
        else
          return "Erro no banco. Algo deu errado."; 
      }    

      public function cadastrarEx($nome, $cpf, $email, $senha, $curador, $organizador, $eixo, $tipo_usuario) {   //Além de fazer o cadastro na tabela usuario é necessário fazer o cadastro na tabela curador ou na submissor.       
            
        //--------- Fazendo o cadastro na tabela usuario. ---------------
        //Passando os dados recebidos para um array, pois serão inseridos no banco.
        $dados1 = array(
            //o id_usuario auto incrementa entao não é necessario incluir
            'nome' => $nome,
            'cpf' => $cpf,
            'email' => $email,
            'senha' => $senha,
            'eh_curador' => TRUE,
            'eh_submissor' => FALSE,
            'tipo_usuario' => $tipo_usuario
        );

        $this->db->insert('usuario', $dados1);

        //--------- Fazendo o cadastro na tabela submissor ou curador. ---------------
        $segundoCadastro = $this->cadastrarCuradorOuOrganizador($cpf, $tipo_usuario, $curador, $organizador, $eixo) ; //Faz a inserção do usuário dependendo de qual tipo ele é.

        $rows = $this->db->affected_rows();
        
        if($rows > 0 && $segundoCadastro == 2)
          return "Cadastrado nas duas tabelas.";
        else
          return "Erro no banco. Algo deu errado."; 
      }

      //Essa função é utilizada para atualizar o campo do comprovante de pagamento da tabela submissor. Ela é chamada após a inserção do texto do usuário.
      public function atualizarCompPag($compPag) {  

        $id_submissor = $this->session->userdata('id'); //Pega o id do usuário que está logado.

        $this->db->where('fk_id_usuario', $id_submissor);
        $this->db->set('comp_pago', $compPag);
        $this->db->update('submissor');
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco"; 
      } 

      public function cadastrar_texto($titulo, $texto, $tipo, $eixo, $comprovante){ //Além de cadastrar o texto, o submissor precisa vincular o comprovante de pagamento do texto. Para isso é necessário inserir o texto e ainda inserir (atualizando) um comprovante de pagamento para esse determinado submissor.
        
        // -------------- Inserindo texto ----------------
           //definir o id_curador pelo eixo
          $eixo_especifico = $eixo;
          $id_curador = 0;
          switch ($eixo_especifico) {
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
          //Passando os dados recebidos para um array, pois serão inseridos no banco.
          $dados = array(
              //o id_texto auto incrementa entao não é necessario incluir_
              'mensagem' => $texto,
              'titulo' => $titulo,
              'status' => FALSE,
              'tipo_texto' => $tipo,
              'fk_id_eixo' => $eixo,
              'fk_id_submissor' => $this->session->userdata('id'),
              'fk_id_curador' => $id_curador);

          $this->db->insert('texto', $dados);

          $rows = $this->db->affected_rows();
        
          if($rows > 0){ //Se o texto for inserido.
            //----------- Inserindo (ou atualizando) comprovante de pagamento ------------
            if ($this->atualizarCompPag($comprovante) == 'Alterado'){
              return "O seu texto e comprovante de pagamento foram enviados com sucesso.";
            }
            else{
              return "O seu texto e comprovante de pagamento foram enviados com sucesso.";
            }
          }
          else
              return "Erro no banco."; 
      }

      public function consultaNumeroTextosSubmetidos($id_submissor){
        $this->db->select('fk_id_submissor');
        $this->db->from('texto');
        $this->db->where('fk_id_submissor', $id_submissor); 

        $query = $this->db->get(); //Realiza a consulta inteira.

        return $query->num_rows(); //Retorna o que foi obtido da consulta.
      }

      //Consulta os textos submetidos pelo submissor
      public function consultaTextoSubmissor($id_do_submissor){
        $this->db->select('u.id_usuario, u.nome, u.cpf, u.email, titulo, mensagem, status, tipo_texto, fk_id_eixo, fk_id_curador, id_texto');
        $this->db->from('texto t');
        $this->db->join('submissor s','t.fk_id_submissor = s.fk_id_usuario', 'inner'); //O "inner" representa que a junção (join) será do tipo INNER JOIN.
        $this->db->join('usuario u','s.fk_id_usuario = u.id_usuario', 'inner');
        $this->db->where('u.id_usuario', $id_do_submissor); 

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
      }

      public function consultaPareceres_e_Respostas_submissor($id_do_texto){

        $this->db->select('p.fk_id_texto, p.seq, p.comentario, p.resposta');
        $this->db->from('parecer p');
        $this->db->where('fk_id_texto', $id_do_texto); 

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        return $query->result(); //Retorna o que foi obtido da consulta.
      }
	  
    //Consulta o email do curador.
      /*
      O curador é um usuario só que possui algusn dados em outra tabela (a tavela curador C).
      por isso usa o innerjoin para unificar os dados
      */
      public function consultaEmailSubmissor($id_submissor){
        $this->db->select('email');
        $this->db->from('usuario u');
        $this->db->where('id_usuario', $id_submissor); 

        $resultado = '';

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        foreach ($query->result() as $row)
        {
          $resultado = $row->email;
        }
      
        return $resultado;
      }

      /*Esta função muda o tipo de texto*/
      public function alteraTipoTexto($novotipo, $id_do_texto){
        $this->db->where('id_texto', $id_do_texto);
        $this->db->set('tipo_texto', $novotipo); 
        $this->db->update('texto');
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco"; 
      }

      /*Esta função muda o texto*/
      public function alteraCorpoTexto($id_do_texto, $novotexto){
        $this->db->where('id_texto', $id_do_texto);
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

      /*Esta função muda o titulo do texto*/
      public function alteraTituloTexto($id_do_texto, $novotitulo){
        $this->db->where('id_texto', $id_do_texto);
        $this->db->set('titulo', $novotitulo); 
        $this->db->update('texto');
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco"; 
      }

      /*Esta função desativa a autorização de mandar nova versão*/
      public function desativarEnvioNovaVersao($id_do_texto){
        $this->db->where('id_texto', $id_do_texto);
        $this->db->set('autorizar_update', '0'); 
        $this->db->update('texto');
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco"; 
      }

      public function consultarAutorizacao($id_do_texto){
        $this->db->select('autorizar_update');
        $this->db->from('texto t');
        $this->db->where('t.id_texto', $id_do_texto); 

        $resultado = '';

        $query = $this->db->get(); //Realiza a consulta inteira.
        
        foreach ($query->result() as $row)
        {
          $resultado = $row->autorizar_update;
        }
      
        return $resultado;
      }

      /*Esta acrescenta um comentário na tabela dos pareceres*/
      public function acrescentarComentario($id_do_texto, $comentario){
          $dados = array(
          'fk_id_texto' => $id_do_texto,
          'seq' => ($this->MCurador->consultaNumeroSeq($id_do_texto)) + 1 ,
          'comentario' => '',
          'resposta' => $comentario,
          );
          $this->db->insert('parecer', $dados);//inserir o arrray no banco
        
        $rows = $this->db->affected_rows();
        
        if($rows > 0)
          return "Alterado";
        else if($rows == 0)
          return "Update falhou."; //Provavelmente não tinha nenhum registro com o WHERE específicado.
        else
          return "Erro no banco"; 
      }

      /*Esta envia e-mail*/
      public function enviar_email($email, $mensagem){
        //Configurando especificações da biblioteca de email.
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = '15congressoapsp.informatica@gmail.com'; //Email do 
        $config['smtp_pass'] = '15congresso';
        $config['protocol']  = 'smtp';
        $config['validate']  = TRUE;
        $config['mailtype']  = 'html';
        $config['charset']   = 'utf-8';
        $config['newline']   = "\r\n";

        $this->load->library('email', $config);
        $this->email->from('15congressoapsp.informatica@gmail.com', 'Congresso APSP');
        $this->email->to($email);        
        $this->email->subject('Nova versão de um texto [Não responda]');
        $this->email->message($mensagem);
        $this->email->send(); 
      }


   }//fim MUsuario 
?> 