<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CCurador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //Carregar os models MCurador e MOrganizador
        $this->load->model('MCurador');
        $this->load->model('MOrganizador');
    }

    /*a funcao index carrega 2 conjuntos de dados; a primeira vai para a lista de textos do eixo do organizador 
    e o segundo conjunto de dados traz uma lista dos curadores quepertencem ao eixo do organizador*/
    public function index()
    {
        if ($this->session->userdata('logged_in') && ($this->session->userdata('tipo') === 'administrador'))
        {

        //Consulta o id do curador
        $id_do_curador = $this->session->userdata('id');

        //Consulta informações sobre os textos enviados para o curador.
        $dados['records'] = $this->MCurador->consultaTextoCurador($id_do_curador);

        //carrega a view
        $this->load->view('includes/VHeader');
        $this->load->view('administrador/VMenu_bar');
        $this->load->view('curador/VDashboard', $dados);
        $this->load->view('includes/VFooter');
        }

        if($this->session->userdata('logged_in') && $this->session->userdata('tipo') === 'curador')
        {

        //Consulta o id do curador
        $id_do_curador = $this->session->userdata('id');

        //Consulta informações sobre os textos enviados para o curador.
        $dados['records'] = $this->MCurador->consultaTextoCurador($id_do_curador);
        $dados['records2'] = NULL;

        //carrega a view
        
        $this->load->view('includes/VHeader');
        $this->load->view('curador/VMenu_bar');
        $this->load->view('curador/VDashboard', $dados);
        $this->load->view('includes/VFooter');

        }

        else
        {
            $this->load->view('login/VLogin');
        }
    }


    /*este controller pega o id do submissor e edita o texto*/ 
    public function editarTexto(){  
        //$this->load->view('VPopup');/* COM Mensagem!!!!
        $id_submissor = $this->input->post('nome_o_submissor3'); 
        $id_texto = $this->input->post('nome_do_texto5'); 
        $novo_titulo = $this->input->post('name_id_titulo'); 
        $novotexto = $this->input->post('texto');

        //echo 'id submissor = '.$id_submissor.'id do texto = '.$id_texto.' o texto = '.$novotexto;

        $this->load->helper('form');
        //realiza a validacao do form na view VContato
        $this->load->library('form_validation');

        $this->form_validation->set_rules('texto','O campo "Texto":','required');
        $this->form_validation->set_rules('name_id_titulo','O campo "Título":','required');
        
        if($this->form_validation->run() === TRUE){
            $this->MCurador->editarUmTexto($id_submissor, $id_texto, $novotexto);
            $this->MCurador->editarUmTitulo($id_submissor, $id_texto, $novo_titulo);
            sleep(1);
            redirect('index.php/CCurador');
        }      

        else{   
            $alerta = array(
                "class" => "danger",
                "mensagem" => ""
                //.validation_errors()
            );
            $erro = array("alerta" => $alerta);
            $this->load->view('includes/VHeader');
            $this->load->view('curador/VMenu_bar');
            $this->load->view('curador/VErrodoCurador', $erro);
            $this->load->view('includes/VFooter');
        }
    }

    /*este controller pega o id do submissor e altera o status do texto para 2, ou seja, aceitar o texto*/ 
    public function aceitarTexto(){  
        //$this->load->view('VPopup');/* COM Mensagem!!!!
        $id_submissor = $this->input->post('nome_o_submissor'); 
        $id_texto = $this->input->post('nome_do_texto'); 
        $this->MCurador->aceitarUmTexto($id_submissor, $id_texto);
        sleep(1);
        redirect('index.php/CCurador');
        
    }

    /*este controller pega o id do submissor e altera o status do texto para 3, ou seja, rejeitar o texto*/ 
    public function rejeitarTexto(){  
        //$this->load->view('VPopup');/* COM Mensagem!!!!
        $id_submissor = $this->input->post('nome_o_submissor2'); 
        $id_texto = $this->input->post('nome_do_texto2'); 
        $this->MCurador->rejeitarUmTexto($id_submissor, $id_texto);
        sleep(1);
        redirect('index.php/CCurador');
        
    }


    /*A funcao númro trabalhos carrega o view de VNumeroTrabalhos.php para os organiizadores verem quanto strabalhos foram submetidos e o número de trabalhos por cada eixo*/
    public function numero_trabalhos()
    {
        if ($this->session->userdata('logged_in') && ($this->session->userdata('tipo') === 'administrador'))
        {
        //$NUMERO TRAB= $this->MOrganizador->consultaEixoOrganizador($this->session->userdata('id'));
        //$NUEMRO POR EIXO= $this->MOrganizador->consultaTextoUsuarioEixo($eixo_do_organizador);//precisa tocar o 2 pelo eixo que o organizador é

        //carrega a view
        $this->load->view('includes/VHeader');
        $this->load->view('administrador/VMenu_bar');
        $this->load->view('organizador/VNumeroTrabalhos');//o certo $this->load->view('organizador/VNumeroTrabalhos, $dados');
        $this->load->view('includes/VFooter');
        }

        if($this->session->userdata('logged_in') && $this->session->userdata('tipo') === 'organizador')
        {

            //Consulta informações sobre texto enviados.
        //$eixo_do_organizador = $this->MOrganizador->consultaEixoOrganizador($this->session->userdata('id'));
        //$dados['records'] = $this->MOrganizador->consultaTextoUsuarioEixo($eixo_do_or
        
        //carrega a view
        $this->load->view('includes/VHeader');
        $this->load->view('organizador/VMenu_bar');
        $this->load->view('organizador/VNumeroTrabalhos');//o certo $this->load->view('organizador/VNumeroTrabalhos, $dados');
        $this->load->view('includes/VFooter');
        }

        else
        {
            $this->load->view('login/VLogin');
        }

    }

    /*Este função visualizar_comprovante é a função para fazer o doenload de arquivos
    usei post para montar o nome do arquivo e na hora de fazer o donload ele até faz o download mas
    acusa falhas ao abrir o pdf...triste */
    public function visualizar_comprovante(){            
        /*
        $nomeArquivo = '';
        $cpf = $this->input->post('name_id_cpf');
        $titulo = $this->input->post('name_id_titulo');
        $nomeArquivo = $cpf.'_'.$titulo.'.pdf';
        //echo $nomeArquivo;
        $dados['records'] = $this->MOrganizador->consultarComprovante($nomeArquivo);
        $file = 'arquivos/'.$dados[] 
        $this->load->helper('download');
        //$data = file_get_contents("'/arquivos/'.$nomeArquivo"); // Read the file's contents
        //$name = 'comprovante_'.$nome_submissor.'.jpg';
        force_download('./arquivos/'."/".$nomeArquivo, null);*/
        $this->load->helper('download');
        
        $cpf = $this->input->post('name_id_cpf');
        $titulo = $this->input->post('name_id_titulo');
        $titulo = str_replace(' ', '_', $titulo);
        $nomeArquivo = $cpf.'_'.$titulo.'.pdf';
        $data = file_get_contents('arquivos/'.$nomeArquivo);

        //force_download($nomeArquivo, $data);
        //echo $nomeArquivo;
        $path = 'arquivos/'.$nomeArquivo;
        force_download($nomeArquivo, $data);
    }

    /*Esta é a função que altera o eixo de um texto. Seleciona o id do texto e o novo eixo pelo POST e chama 
    um model MOrganizador->alteraEixoTexto que vai busar o texto pelo id do texto e fazer a troca de eixo*/
    public function alterar_eixo(){
        //$autor = $this->input->post('name_submissor');
        $id_texto = $this->input->post('name_id_do_texto');
        //echo 'funcionou! id texto ='.$id_texto;

        $id_novo_eixo = $this->input->post('name_novoeixo');
        //echo '   funcionou! id texto ='.$id_texto."id novo eixo = ".$id_novo_eixo;

        $this->form_validation->set_rules('name_novoeixo','NOVO EIXO','required');
        if($this->form_validation->run() === TRUE){
        //if(id_novo_eixo!=0){
        $msg=$this->MOrganizador->alteraEixoTexto($id_novo_eixo, $id_texto);
        
        sleep(1);
        redirect('index.php/COrganizador');

        }

        else{   
                $alerta = array(
                    "class" => "danger",
                    "mensagem" => "Entrada inválida, volte para a página anterior ou clique no Home (Organizador) que está no menu.<br />\n OBS: Se quiser alterar o eixo de um texto, clique no texto, escolhe o novo eixo e clique no botão Alterar o eixo."
                    //.validation_errors()
                );
                $dados = array("alerta" => $alerta);
                $this->load->view('includes/VHeader');
                $this->load->view('organizador/VMenu_bar');
                $this->load->view('organizador/VDashboard',  $dados);
                $this->load->view('includes/VFooter');
        }

        //echo 'O texto do '.$autor.' foi mudado para eixo '.$id_novo_eixo.'com sucesso.';
        
    }


    public function enviar_parecer(){
        $id_do_texto = $this->input->post('name_do_texto3'); 
        $parecer = $this->input->post('name_id_parecer');
        $seq = ($this->MCurador->consultaNumeroSeq($id_do_texto)) + 1;

        $email = $this->input->post('nome_do_email');

        $titulo = $this->MOrganizador->consultaTituloTexto($id_do_texto);

        //desativar o envio de uma nova versão
        $this->MCurador->ativarEnvioNovaVersao($id_do_texto);

        echo $parecer.'_____'.$id_do_texto.'_____'.$seq.'_____'.$email;

        $dados = array(
            'fk_id_texto' => $id_do_texto,
            'seq' => $seq ,
            'comentario' => $parecer,
            'resposta' => '',
        );

        $this->db->insert('parecer', $dados);//inserir o arrray no banco

        $rows = $this->db->affected_rows();//contar o numero de registros afetados no banco

        if($rows > 0){
          sleep(1);

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
        
          $this->email->subject('Parecer enviado [Não responda]');
          $this->email->message('Olá! Entre no sistema de envio de textos através do  link - http://saudepublica.fmrp.usp.br/index.php/CHome/carrega_vlogin e clique a aba "Pareceres". <br>Seu curador enviou um parecer para o seu texto.<br><br>
              * Título: '.$titulo.'<br>
              * Parecer: '.$parecer.'<br><br>
              * Lembrando que o e-mail utiizado para enviar o trabalho é '.$email.'.  
                <br>Faça o login com o email citado para visualizar o parecer ou efetuar as mudanças solicitadas');
        
          $this->email->send();


          redirect('index.php/CCurador');
          return 2; //Se deu certo.
        }
        else{
          return 1; //Se deu errado.
          echo 'Erro ao inserir os dados no banco, volte para a página anterior';
        }


    }

    public function verPareceresRespostas(){
        //Consulta o id do curador
        $id_do_curador = $this->session->userdata('id');
        $id_do_texto = $this->input->post('name_do_texto4'); 

        //echo $id_do_curador.'_____'.$id_do_texto;

        //Consulta informações sobre os textos enviados para o curador.
        $dados['records'] = $this->MCurador->consultaTextoCurador($id_do_curador);
        //$dados['records2'] = NULL;

        $dados['records2'] = $this->MCurador->consultaPareceres_e_Respostas($id_do_texto);

        //carrega a view
        
        $this->load->view('includes/VHeader');
        $this->load->view('curador/VMenu_bar');
        $this->load->view('curador/VDashboard', $dados);
        $this->load->view('includes/VFooter');

    }

    

    
}//fim controller CCurador

