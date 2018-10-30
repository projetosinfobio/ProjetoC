<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class COrganizador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //Carregar o model MOrganizador
        $this->load->model('MOrganizador');
         $this->load->model('MCurador');
    }

    /*a funcao index carrega 2 conjuntos de dados; a primeira vai para a lista de textos do eixo do organizador 
    e o segundo conjunto de dados traz uma lista dos curadores quepertencem ao eixo do organizador*/
    public function index()
    {
        /*
        Função que carrega a página inicial do organizador após o login
        */
        if ($this->session->userdata('logged_in') && ($this->session->userdata('tipo') === 'administrador'))
        {
        //Consulta eixo do organizador 
        $eixo_do_organizador = $this->MOrganizador->consultaEixoOrganizador($this->session->userdata('id'));
        //Consulta informações sobre os textos enviados para o eixo do organizador.
        $dados['records'] = $this->MOrganizador->consultaTextoUsuarioEixo($eixo_do_organizador);
        //Consulta os curadores do mesmo eixo que o organizador possui.
        $dados['records2'] = $this->MOrganizador->consultaCuradoresEixo2($eixo_do_organizador);

        //carrega a view
        $this->load->view('includes/VHeader');
        $this->load->view('administrador/VMenu_bar');
        $this->load->view('organizador/VDashboard',  $dados);
        $this->load->view('includes/VFooter');
        }

        if($this->session->userdata('logged_in') && $this->session->userdata('tipo') === 'organizador')
        {

        //Consulta eixo do organizador 
        $eixo_do_organizador = $this->MOrganizador->consultaEixoOrganizador($this->session->userdata('id'));

        //Consulta informações sobre os textos enviados para o eixo do organizador.
        $dados['records'] = $this->MOrganizador->consultaTextoUsuarioEixo($eixo_do_organizador);//precisa tocar o 2 pelo eixo que o organizador é

        //Consulta os curadores do mesmo eixo que o organizador possui.
        $dados['records2'] = $this->MOrganizador->consultaCuradoresEixo2($eixo_do_organizador);


        //carrega a view
        $this->load->view('includes/VHeader');
        $this->load->view('organizador/VMenu_bar');
        $this->load->view('organizador/VDashboard', $dados);
        $this->load->view('includes/VFooter');
        }

        else
        {
            $this->load->view('login/VLogin');
        }

    }

    public function status()
    {
        //Consulta informações sobre os textos enviados para o eixo do organizador.
        $dados['records'] = $this->MOrganizador->consultaTodosOsTextos();
        //carrega a view
        $this->load->view('includes/VHeader');
        $this->load->view('organizador/VMenu_bar');
        $this->load->view('organizador/VStatus', $dados);
        $this->load->view('includes/VFooter');

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
        /*Função que baixa o comprovante de pagamento enviado ao sistema pelo submissor depois de clicar em 
        "visualizar o comprovante de pagamento"*/         
        $this->load->helper('download');

        $id_submissor = $this->input->post('name_id_submissor2');

        $nomeArq = $this->MOrganizador->buscarNomeComprovante($id_submissor);

        //echo $nomeArq;
        
        $data = file_get_contents('arquivos/'.$nomeArq);
        force_download($nomeArq, $data);
    }

    /*Esta é a função que altera o eixo de um texto. Seleciona o id do texto e o novo eixo pelo POST e chama 
    um model MOrganizador->alteraEixoTexto que vai busar o texto pelo id do texto e fazer a troca de eixo*/
    public function alterar_eixo(){
        /*
        Função que altera eixo depois de selecionar um texto e clicar no botão "alterar eixo"
        */
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
                $erro = array("alerta" => $alerta);
                $this->load->view('includes/VHeader');
                $this->load->view('organizador/VMenu_bar');
                $this->load->view('organizador/VErroAlterarEixo', $erro);
                $this->load->view('includes/VFooter');
        }

        //echo 'O texto do '.$autor.' foi mudado para eixo '.$id_novo_eixo.'com sucesso.';
        
    }

    /*este controller pega o id do texto e o nome do novo curador e chama o model 
    MOrganizador->alteraCuradorParaUmTexto que vai buscar o texto pelo seu id na tabela texto e torcar o atributo do curadpr*/
    public function encaminhar_curador(){  
        /*
        Função que encaminha o texto para o curador depois de selcionar um texto, selecionar um curador e clicar em "encaminhar para curador"
        */
        //$this->load->view('VPopup');/* COM Mensagem!!!!
        $id_texto = $this->input->post('name_id_do_texto');
        $id_curador = $this->input->post('name_id_do_novo_curador');   
        $email = $this->input->post('name_do_email_curador');  
        $titulo = $this->MOrganizador->consultaTituloTexto($id_texto);

        //echo 'funcionou! Id do texto = '.$id_texto .' O curador = '.$id_curador.' O email = '.$email.' O titulo = '.$titulo; 
        
        $this->MOrganizador->alteraCuradorParaUmTexto($id_texto, $id_curador);
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

        $this->email->subject('Texto encaminhado [Não responda]');
        $this->email->message('Aviso: Você recebeu um novo texto para efetuar o processo de curadoria<br><br>
            * Título do texto: '.$titulo.'<br><br>
            Lembrando que precisa entrar no sistema com o email '.$email.' para realizar o processo de curadoria<br>');

        $this->email->send();


        redirect('index.php/COrganizador');
        
    }

    /*este controller pega o id do submissor e edita o texto*/ 
      public function editar_titulo_e_texto(){  
        //$this->load->view('VPopup');/* COM Mensagem!!!!
        $id_submissor = $this->input->post('nome_do_submissor'); 
        $id_texto = $this->input->post('nome_id_do_texto'); 
        $novo_titulo = $this->input->post('nome_id_titulo'); 
        $novotexto = $this->input->post('nome_mensagem');

        //echo 'id submissor = '.$id_submissor."<br>".'id do texto = '.$id_texto."<br>".'O texto = '.$novotexto;

        

        $this->load->helper('form');
        //realiza a validacao do form na view VContato
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome_mensagem','O campo "Texto":','required');
        $this->form_validation->set_rules('nome_id_titulo','O campo "Título":','required');
        
        if($this->form_validation->run() === TRUE){
            $this->MCurador->editarUmTexto($id_submissor, $id_texto, $novotexto);
            $this->MCurador->editarUmTitulo($id_submissor, $id_texto, $novo_titulo);
            sleep(1);
            redirect('index.php/COrganizador/status');
        }      

        else{   
            $alerta = array(
                "class" => "danger",
                "mensagem" => ""
                //.validation_errors()
            );
            $erro = array("alerta" => $alerta);
            $this->load->view('includes/VHeader');
            $this->load->view('organizador/VMenu_bar');
            $this->load->view('organizador/VErrodoOrganizador', $erro);
            $this->load->view('includes/VFooter');
        }
      }

}//fim controller COrganizador
