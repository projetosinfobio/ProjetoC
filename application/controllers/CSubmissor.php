<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CSubmissor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //Carregar os models MCurador e MOrganizador
        $this->load->model('MCurador');
        $this->load->model('MUsuario');
        $this->load->model('MOrganizador');
    }

    public function index()
    {
    	if ($this->session->userdata('logged_in') && ($this->session->userdata('tipo') === 'administrador'
                || $this->session->userdata('tipo') === 'submissor'
                ) ) {

        //carrega a view
        $this->load->view('includes/VHeader');
        $this->load->view('submissor/VMenu_bar');
        $this->load->view('submissor/VDashboard');
        $this->load->view('includes/VFooter');
        }else{
            $this->load->view('login/Vlogin');
        }

    }

    public function submeterTextoeComprovante(){            

        $this->load->model('MUsuario'); //Importando as funções do model.

        // --------------- Submetendo texto ---------------------
            //$id_usuario = $this->input->post('idusuario');
            $titulo = $this->input->post('titulo');
            $texto = $this->input->post('texto');
            $tipo = $this->input->post('tipo'); //Recebe E para relato de experiência e recebe P para de Pesquisa.
            $eixo = $this->input->post('eixo');

            // ----------- Submetendo comprovante (salvando comprovante) -----------------
            //Pegando o arquivo submetido.
            //Obtendo o nome do arquivo que será salvo.
            $id_usuario = $this->session->userdata('id');
            $nomeArq = $id_usuario;
            $nomeArq .= '_'; //Concatenando valores.
            $nomeArq .= $this->MUsuario->consultaCpfUsuario($id_usuario);
            $nomeArq .= '_comprovante'; //Concatenando valores.
            $nomeArq .= '.pdf'; //Concatenando valores. (Com extensão incluída)
            //$nomeArq = $this->session->userdata('id').'_'.$titulo; //Talvez funcione concatenar assim também.
            //Por exemplo: nomeArq = '15_tituloTrabalho'.

            //Configurações do arquivo que será adicionado.
            $configuracaoArq = array(
                'upload_path'   => './arquivos/', // Passa o nome da pasta onde o arquivo será salvo. (Essa pasta está localizada na raiz do projeto.)
                'allowed_types' => 'pdf', // Tipos permitidos.
                'file_name'     => $nomeArq, //Configura o nome do arquivo que será adicionado.
                'max_size'      => '4000' // O tamanho é em KB.
            );  

            $this->load->library('upload', $configuracaoArq); //Carrega a biblioteca de arquivo do codeigniter com as configurações pré-definidas.

            $confirmaCompPag = 0;
            if ( ! $this->upload->do_upload('comprovante')){ //Se deu erro.
                echo $this->upload->display_errors(); //Mostra a mensagem de erro na página.
            }
            else{
                echo 'Arquivo salvo com sucesso.'; //Mostra a mensagem que deu certo na página.
                $confirmaCompPag = 1; //Comprovante de pagamento salvo com sucesso.
            }

            // ------------------------------------------------------------------------------


            //Salvando o texto e inserindo(atualizando) o comprovante.
            if($confirmaCompPag == 1){ //Só insere o texto se o comprovante já estiver salvo.
                $msg = $this->MUsuario->cadastrar_texto($titulo, $texto, $tipo, $eixo, $nomeArq);

                $emailSubmissor = $this->session->userdata('email');

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
                $this->email->to($emailSubmissor);
            
                $this->email->subject('Primeira Submissão realizado [Não responda]');
                $this->email->message('Olá! Através deste e-mail, confirmamos que a sua primeira submissão foi encaminhado com sucesso<br><br>
                    Obrigado!');
            

                $this->email->send();

            }

            else{
                $msg = "Comprovante não foi salvo, então não é possível fazer a submissão do trabalho.";
            }

            //Atribuindo um valor para uma variável.
            $info = array(
                'titulo' => $titulo,
                'texto' => $texto,
                'tipo' => $tipo,
                'eixo' => $eixo,
                'comprovante' => $nomeArq,
                'mensagem' => $msg
            );            

            //Ao chamar a view é enviada uma variável chamada $dados para ela que pode-se utilizá-la em qualquer lugar da view.
            $this->load->view('submissor/VSubmissaoResultado', $info);

    }//fim submeterTextoeComprovante    

    public function primeirasubmissao()
    {
        $this->load->view('includes/VHeader');
        $this->load->view('submissor/VMenu_bar');
        $this->load->view('submissor/VSubmissao');
        $this->load->view('includes/VFooter');
    }

    public function pareceres()
    {   
        //Consulta o id do submissor
        $id_do_submissor = $this->session->userdata('id');

        //Consulta informações sobre os textos submetidos
        $dados['records'] = $this->MUsuario->consultaTextoSubmissor($id_do_submissor);
        $dados['records2'] = NULL;

        $this->load->view('includes/VHeader');
        $this->load->view('submissor/VMenu_bar');
        $this->load->view('submissor/VPareceres', $dados);
        $this->load->view('includes/VFooter');
    }

   

    public function verPareceres()
    {
        //Consulta o id do submissor
        $id_do_submissor = $this->session->userdata('id');
        $id_do_texto = $this->input->post('nome_do_texto2'); 

        //echo $id_do_submissor.'_____'.$id_do_texto;

        

        //Consulta informações sobre os textos enviados para o curador.
        $dados['records'] = $this->MUsuario->consultaTextoSubmissor($id_do_submissor);

        $dados['records2'] = $this->MUsuario->consultaPareceres_e_Respostas_submissor($id_do_texto);

        //carrega a view
        
        $this->load->view('includes/VHeader');
        $this->load->view('submissor/VMenu_bar');
        $this->load->view('submissor/VPareceres', $dados);
        $this->load->view('includes/VFooter');

    }

    public function responder(){
  
        $id_do_texto = $this->input->post('nome_id_do_texto'); 
        $novotitulo = $this->input->post('nome_id_titulo');;
        $novotexto = $this->input->post('nome_id_mensagem');;
        $comentario = $this->input->post('nome_id_resposta');;
        
        //echo $id_do_texto.'_____'.$novotitulo.'_____'.$novotexto.'_____'.$comentario;
                
        $id_curador = $this->MOrganizador->consultaIdCurador($id_do_texto);
        $emailCurador = $this->MOrganizador->consultaEmailCurador($id_curador);

        $id_submissor = $this->session->userdata('id');
        $nome = $this->session->userdata('nome');
        $emailSubmissor = $this->session->userdata('email');

        $seqParecer = ($this->MCurador->consultaNumeroSeq($id_do_texto)) + 1;

        $msgCurador= 'Aviso: '.$nome.' enviou uma nova versão do seu texto<br><br>  
            Título: '.$novotitulo.'<br>'; 
        $msgSubmissor = 'Aviso: A nova versão do seu texto foi encaminhada com sucesso. <br><br>
            Título: '.$novotitulo;

        $this->load->helper('form');
        //realiza a validacao do form na view VContato
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome_id_titulo','Título','required');

        $this->form_validation->set_rules('nome_id_mensagem','A última versão do seu texto:','required');
        
        if($this->form_validation->run() === TRUE){
    
            if($this->MUsuario->consultarAutorizacao($id_do_texto)){
                //altera o título
                $this->MUsuario->alteraTituloTexto($id_do_texto, $novotitulo);
                //altera o texto
                $this->MUsuario->alteraCorpoTexto($id_do_texto, $novotexto);

                if($comentario != ''){
                    $msgCurador = 'Aviso: '.$nome.' enviou uma nova versão do seu texto<br><br>  
                    Título: '.$novotitulo.'<br><br>
                    * '.$nome.' enviou um comentário (ou dúvida): '.$comentario;
                    $msgSubmissor = 'Aviso: A nova versão do seu texto e o seu comentário (ou dúvida) foram encaminhadas com sucesso. <br><br>
                    * Título: '.$novotitulo.'<br>
                    * Comentário (ou dúvida) = '.$comentario;
            

                    //inserir comentario ou duvida na tabela dos pareceres
                    $this->MUsuario->acrescentarComentario($id_do_texto, $comentario);

                }

                //enviar emails
                /*
                $this->MUsuario->enviar_email($emailSubmissor, $msgSubmissor);
                $this->MUsuario->enviar_email($emailCurador, $msgCurador);
                */

                //desativar o envio de uma nova versão
                $this->MUsuario->desativarEnvioNovaVersao($id_do_texto);

                //Consulta informações sobre os textos submetidos
                $dados['records'] = $this->MUsuario->consultaTextoSubmissor($id_submissor);
                $dados['records2'] = NULL;

                $this->load->view('includes/VHeader');
                $this->load->view('submissor/VMenu_bar');
                $this->load->view('submissor/VPareceres', $dados);
                $this->load->view('includes/VFooter');

            }

            else{   
                    $alerta = array(
                        "class" => "danger",
                        "mensagem" => "Aguarde nova resposta do curador para encaminhar novas versões do seu texto. Para cada parecer dado ao seu texto, você tem direito a alterar o seu texto apenas uma vez;"
                        //.validation_errors()
                    );
                    $erro = array("alerta" => $alerta);
                    $this->load->view('includes/VHeader');
                    $this->load->view('submissor/VMenu_bar');
                    $this->load->view('submissor/VErroNovaVersao', $erro);
                    $this->load->view('includes/VFooter');
            }
        }

        else{
            $alerta = array(
                "class" => "danger",
                "mensagem" => ""
                //.validation_errors()
            );
            $erro = array("alerta" => $alerta);
            $this->load->view('includes/VHeader');
            $this->load->view('submissor/VMenu_bar');
            $this->load->view('submissor/VErroNovaVersao', $erro);
            $this->load->view('includes/VFooter');
        }

    }

    public function responder_parecer(){
        $id_do_texto = $this->input->post('nome_do_texto'); 
        $parecer = $this->input->post('nome_id_resposta');
        $seq = $this->input->post('nome_seq');

        $id_curador = $this->MOrganizador->consultaIdCurador($id_do_texto);

        $email = $this->MOrganizador->consultaEmailCurador($id_curador);

        $titulo = $this->MOrganizador->consultaTituloTexto($id_do_texto);

        //echo $parecer.'_____'.$id_do_texto.'_____'.$seq.'_____'.$email.'_____'.$titulo;

        $this->db->where('fk_id_texto', $id_do_texto); 
        $this->db->where('seq', $seq); 
        $this->db->set('resposta', $parecer); 
        $this->db->update('parecer');
        //e chama um controller ou na sequencia alterar o status para tttr sei la
        
        $rows = $this->db->affected_rows();

        if($rows > 0){
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
        
          $this->email->subject('Resposta enviado [Não responda]');
          $this->email->message('Olá! Entre no sistema com o seu login de curador. <br>
            Você recebeu uma resposta ao parecer que deu em um dos textos.<br>
            Procure pelas respostas aos pareceres do texto com o título abaixo. <br><br>
            Título: '.$titulo.'<br><br><br>
            Obrigado!');
        
          $this->email->send();

          redirect('index.php/CSubmissor/pareceres');
          return 2; //Se deu certo.
        }
        else{
          return 1; //Se deu errado.
          echo 'Erro ao inserir os dados no banco, volte para a página anterior';
        }


    }

    public function enviar_nova_versao(){
        $id_do_texto = $this->input->post('nome_id_do_texto'); 
        $novotexto = $this->input->post('nome_id_novo_texto');
        $id_curador = $this->MOrganizador->consultaIdCurador($id_do_texto);

        $emailCurador = $this->MOrganizador->consultaEmailCurador($id_curador);
        $titulo = $this->input->post('nome_id_titulo');

        $id_submissor = $this->session->userdata('id');
        $emailSubmissor = $this->MUsuario->consultaEmailSubmissor($id_submissor);


        //echo $id_do_texto.'_____'.$novotexto.'_____'.$titulo.'_____'.$emailSubmissor;
        

        $this->db->where('id_texto', $id_do_texto); 
        $this->db->set('mensagem', $novotexto); 
        $this->db->update('texto');
        //e chama um controller ou na sequencia alterar o status para tttr sei la
        
        $rows = $this->db->affected_rows();

        if($rows > 0){
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
          $this->email->to($emailCurador);
        
          $this->email->subject('Nova versão de um texto [Não responda]');
          $this->email->message('Olá! Entre no sistema com o seu login de curador. <br>
            Você recebeu uma nova versão de um dos textos.<br>
            Procure a nova versão pelo título do texto. <br><br>
            Título: '.$titulo.'<br><br><br>
            Obrigado!');
        
          $this->email->send();

          $this->email->from('15congressoapsp.informatica@gmail.com', 'Congresso APSP');
          $this->email->to($emailSubmissor);
        
          $this->email->subject('Nova versão de um texto [Não responda]');
          $this->email->message('Olá! A nova versão do seu texto foi submetida com sucesso. <br><br>
            Título: '.$titulo.'<br><br><br>
            Obrigado!');
        
          $this->email->send();

          //Consulta o id do submissor
          $id_do_submissor = $this->session->userdata('id');

          //Consulta informações sobre os textos submetidos
          $dados['records'] = $this->MUsuario->consultaTextoSubmissor($id_do_submissor);
          $dados['records2'] = NULL;

          $this->load->view('includes/VHeader');
          $this->load->view('submissor/VMenu_bar');
          $this->load->view('submissor/VPareceres', $dados);
          $this->load->view('includes/VFooter');

          return 2; //Se deu certo.
        }
        else{
          return 1; //Se deu errado.
          echo 'Erro ao inserir os dados no banco, volte para a página anterior';
        }


    }

    public function editarsubmissao(){
        //Consulta o id do submissor
        $id_do_submissor = $this->session->userdata('id');

        //Consulta informações sobre os textos submetidos
        $dados['records'] = $this->MUsuario->consultaTextoSubmissor($id_do_submissor);

        $this->load->view('includes/VHeader');
        $this->load->view('submissor/VMenu_bar');
        $this->load->view('submissor/VEditarSubmissao', $dados);
        $this->load->view('includes/VFooter');
    }

    public function editar_titulo(){
        $id_do_texto = $this->input->post('nome_id_do_texto'); 
        $novotitulo = $this->input->post('nome_titulo');

        $id_submissor = $this->session->userdata('id');
        $emailSubmissor = $this->session->userdata('email');

        //echo $id_do_texto.'_____'.$novotitulo.'_____'.$id_submissor.'_____'.$emailSubmissor;
        
        $this->db->where('id_texto', $id_do_texto); 
        $this->db->set('titulo', $novotitulo); 
        $this->db->update('texto');
        
        $rows = $this->db->affected_rows();

        if($rows > 0){

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
            $this->email->to($emailSubmissor);
        
            $this->email->subject('Titulo alterado [Não responda]');
            $this->email->message('Olá! O título do seu texto foi alterado com sucesso. 
                <br><br>Obrigado!');
        
            $this->email->send();

            redirect('index.php/CSubmissor/editarsubmissao');
            return 2; //Se deu certo.
        }
        else{
            return 1; //Se deu errado.
            echo 'Erro ao inserir os dados no banco, volte para a página anterior';
        }
        
    }

    public function editar_texto(){
        $id_do_texto = $this->input->post('nome_id_do_texto2'); 
        $novotexto = $this->input->post('nome_mensagem');

        $id_submissor = $this->session->userdata('id');
        $emailSubmissor = $this->session->userdata('email');

        //echo $id_do_texto.'_____'.$novotexto.'_____'.$id_submissor.'_____'.$emailSubmissor;
        
        $this->db->where('id_texto', $id_do_texto); 
        $this->db->set('mensagem', $novotexto); 
        $this->db->update('texto');
        
        $rows = $this->db->affected_rows();

        if($rows > 0){
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
            $this->email->to($emailSubmissor);
        
            $this->email->subject('Texto alterado [Não responda]');
            $this->email->message('Olá! O seu texto foi atualizado com sucesso. 
              <br><br>Obrigado!');
        
            $this->email->send();

            redirect('index.php/CSubmissor/editarsubmissao');
            return 2; //Se deu certo.
        }
        else{
            return 1; //Se deu errado.
            echo 'Erro ao inserir os dados no banco, volte para a página anterior';
        }
    }

    public function editar_tipo_texto(){
        $id_do_texto = $this->input->post('nome_id_do_texto3'); 
        $novotipo = $this->input->post('nome_tipo');

        $id_submissor = $this->session->userdata('id');
        $emailSubmissor = $this->session->userdata('email');

        echo $id_do_texto.'_____'.$novotipo.'_____'.$id_submissor.'_____'.$emailSubmissor;

        $this->form_validation->set_rules('nome_tipo','NOVO EIXO','required');
        if($this->form_validation->run() === TRUE){

            $msg=$this->MUsuario->alteraTipoTexto($novotipo, $id_do_texto);

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
            $this->email->to($emailSubmissor);
        
            $this->email->subject('Tipo de texto alterado [Não responda]');
            $this->email->message('Olá! O tipo do seu texto foi alterado com sucesso. 
              <br><br>Obrigado!');
        
            $this->email->send();
    
            redirect('index.php/CSubmissor/editarsubmissao');
        }

        else{   
            $alerta = array(
                "class" => "danger",
                "mensagem" => "Entrada inválida, volte para a página anterior ou clique no Editar Submissão que está no menu.<br />\n OBS: Se quiser alterar o tipo de texto, clique DUAS VEZES no texto, escolhe o novo tipo de texto e clique no botão Alterar o tipo de texto."
                    //.validation_errors()
                );
            $dados = array("alerta" => $alerta);
            $this->load->view('includes/VHeader');
            $this->load->view('submissor/VMenu_bar');
            $this->load->view('submissor/VEditarSubmissao',  $dados);
            $this->load->view('includes/VFooter');
        }
        
    }

    public function reenviarcomprovante(){
        // ----------- Submetendo comprovante (salvando comprovante) -----------------
        //Pegando o arquivo submetido.
        //Obtendo o nome do arquivo que será salvo.
        $id_usuario = $this->session->userdata('id');
        $emailSubmissor = $this->session->userdata('email');
        $nomeArq = $id_usuario;
        $nomeArq .= '_'; //Concatenando valores.
        $nomeArq .= $this->MUsuario->consultaCpfUsuario($id_usuario);
        $nomeArq .= '_comprovante'; //Concatenando valores.
        $nomeArq .= '.pdf'; //Concatenando valores. (Com extensão incluída)
        //$nomeArq = $this->session->userdata('id').'_'.$titulo; //Talvez funcione concatenar assim também.
        //Por exemplo: nomeArq = '15_tituloTrabalho'.

        //Configurações do arquivo que será adicionado.
        $configuracaoArq = array(
            'upload_path'   => './arquivos/', // Passa o nome da pasta onde o arquivo será salvo. (Essa pasta está localizada na raiz do projeto.)
            'allowed_types' => 'pdf', // Tipos permitidos.
            'file_name'     => $nomeArq, //Configura o nome do arquivo que será adicionado.
            'max_size'      => '4000' // O tamanho é em KB.
        );  

        $this->load->library('upload', $configuracaoArq); //Carrega a biblioteca de arquivo do codeigniter com as configurações pré-definidas.

        $confirmaCompPag = 0;
        if ( ! $this->upload->do_upload('comprovante')){ //Se deu erro.
            $erros = $this->upload->display_errors(); //Mostra a mensagem de erro na página.
            $alerta = array(
                        "class" => "danger",
                        "mensagem" => $this->upload->display_errors()
                        //.validation_errors()
                    );
                    $mensagemErro = array("alerta" => $alerta);
                    $this->load->view('includes/VHeader');
                    $this->load->view('submissor/VMenu_bar');
                    $this->load->view('submissor/VEnviarComprovante', $mensagemErro);
                    $this->load->view('includes/VFooter');
        }
        else{
            echo 'Arquivo salvo com sucesso.'; //Mostra a mensagem que deu certo na página.
            $confirmaCompPag = 1; //Comprovante de pagamento salvo com sucesso.
        }

        // ------------------------------------------------------------------------------


        //Salvando o texto e inserindo(atualizando) o comprovante.
        if($confirmaCompPag == 1) {//Só insere o texto se o comprovante já estiver salvo.
            $msg = $this->MUsuario->atualizarCompPag($nomeArq);

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
            $this->email->to($emailSubmissor);
        
            $this->email->subject('Comprovante de pagamento atualizado [Não responda]');
            $this->email->message('Olá! O seu comprovante de pagamento foi atualizado com sucesso. 
              <br><br>Obrigado!');
        
            $this->email->send();
    
            redirect('index.php/CSubmissor/pareceres');
        }
    
        else{
            $msg = "Comprovante não foi salvo, então não é possível fazer a submissão do trabalho.";
        }
    }

    public function reenviar()
    {
        $this->load->view('includes/VHeader');
        $this->load->view('submissor/VMenu_bar');
        $this->load->view('submissor/VEnviarComprovante');
        $this->load->view('includes/VFooter');
    }

    public function resultados()
    {
        $this->load->view('includes/VHeader');
        $this->load->view('submissor/VMenu_bar');
        $this->load->view('submissor/VResultados');
        $this->load->view('includes/VFooter');
    }
}
