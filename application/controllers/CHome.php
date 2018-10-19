<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CHome extends CI_Controller {

	//Construtor do controlador. (Toda vez que o controlador é chamado o construtor roda.)
    function __construct(){
        parent::__construct();
        
        date_default_timezone_set('America/Sao_Paulo');

        //Não esquecer de colocar.
        $this->load->helper('url', 'form'); 

    }

	public function index()
	{
		//echo 'funcionou.';
		$this->load->view('VHomepage');
		
	}

	public function resultados()
	{
		$this->load->view('includes/VHeader');
        $this->load->view('VMenuBar');
        $this->load->view('VResultados');
        $this->load->view('includes/VFooter');	
	}

	public function normas()
	{
		//echo 'funcionou.';
		$this->load->view('VHome');
	}

	public function cronograma_congresso()
	{
		//echo 'funcionou.';
		$this->load->view('includes/VHeader');
        $this->load->view('VMenuBar');
        $this->load->view('informacoes/VCronogramaCongresso');
        $this->load->view('includes/VFooter');
	}

	public function cronograma_trabalhos()
	{
		//echo 'funcionou.';
		$this->load->view('includes/VHeader');
        $this->load->view('VMenuBar');
        $this->load->view('informacoes/VCronogramaTrabalhos');
        $this->load->view('includes/VFooter');
	}

	public function informacoes_apsp()
	{
		//echo 'funcionou.';
		$this->load->view('includes/VHeader');
        $this->load->view('VMenuBar');
        $this->load->view('informacoes/VSobreAPSP');
        $this->load->view('includes/VFooter');
	}

	public function informacoes_congressoapsp()
	{
		//echo 'funcionou.';
		$this->load->view('includes/VHeader');
        $this->load->view('VMenuBar');
        $this->load->view('informacoes/VSobreCongressoAPSP');
        $this->load->view('includes/VFooter');
	}

	public function comissao_organizadora()
	{
		//echo 'funcionou.';
		$this->load->view('includes/VHeader');
        $this->load->view('VMenuBar');
        $this->load->view('informacoes/VComissaoOrganizadora');
        $this->load->view('includes/VFooter');
	}

	public function palestrantes()
	{
		//echo 'funcionou.';
		$this->load->view('includes/VHeader');
        $this->load->view('VMenuBar');
        $this->load->view('informacoes/VPalestrantes');
        $this->load->view('includes/VFooter');
	}


	public function missao_objetivos()
	{
		//echo 'funcionou.';
		$this->load->view('includes/VHeader');
        $this->load->view('VMenuBar');
        $this->load->view('informacoes/VHistorico');
        $this->load->view('includes/VFooter');
	}
	


	public function contato()
	{
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

        // adicionar isso ------------------------------------------------------------
        $this->load->helper('form');
        //realiza a validacao do form na view VContato
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('assunto', 'Assunto', 'trim|required');
        $this->form_validation->set_rules('mensagem', 'Mensagem', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
        	$dados['formerror'] = validation_errors();
        } else {
        	//enviando email com verificacao de envio
        	$this->load->library('email', $config);
        	
        	$dados_form = $this->input->post();

        	$this->email->from($dados_form['email'], $dados_form['nome']);
			$this->email->to('15congressoapsp.informatica@gmail.com'); //email do congresso         
        	$this->email->subject($dados_form['assunto']);
        	$this->email->message($dados_form['mensagem']);
        	
        	if($this->email->send()){
        		$dados['formerror'] = 'Mensagem enviada com sucesso!'; 
        	}else{
        		$dados['formerror'] = 'Falha ao enviar a mensagem, por favor tente novamente!';
        	}       
        }

        $this->load->view('informacoes/VContato', $dados);
	}

	public function carrega_vlogin()
	{
		$this->load->view('login/VLogin');
	}

	public function carrega_vcadastrar()
	{
		//Ao chamar a view é enviada uma variável chamada $dados para ela que pode-se utilizá-la em qualquer lugar da view.
		//$this->load->view('VCadastrar');
		$this->load->view('VCadastroUsuario');
	}

	public function cadastroespecial()
	{
		//Ao chamar a view é enviada uma variável chamada $dados para ela que pode-se utilizá-la em qualquer lugar da view.
		//$this->load->view('VCadastrar');
		$this->load->view('VCadastroCuradorOrganizador');
	}

	public function cadastro()
	{
		//$id_usuario = $this->input->post('idusuario');
		$nome = $this->input->post('nome');
		$cpf = $this->input->post('CPF');
		$email = $this->input->post('email');
        $senha = $this->input->post('senha');
        $curador = $this->input->post('curador'); 
        $submissor = $this->input->post('submissor');
        
        $this->load->model('MUsuario');
        $msg = $this->MUsuario->cadastrar($nome, $cpf, $email, $senha, $curador, $submissor);

        //Atribuindo um valor para uma variável.
        $dados = array(
        	'nome' => $nome,
            'cpf' => $cpf,
            'email' => $email,
            'senha' => $senha,
            'mensagem' => $msg
        );
         

        //Ao chamar a view é enviada uma variável chamada $dados para ela que pode-se utilizá-la em qualquer lugar da view.
		$this->load->view('VCadastroUsuarioResultado', $dados);
	}


	public function cadastrar_usuario2(){
		//esta funcao cadatra usuarios normais na tabela ususario

		$this->load->library('form_validation');
		$this->load->helper('security');
		//Validação do formulário
        $this->form_validation->set_rules('nome','NOME COMPLETO','required');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|numeric'); 
        $this->form_validation->set_rules('email', 'E-MAIL', 'required|valid_email'); 
        $this->form_validation->set_rules('senha','SENHA','required|min_length[3]|max_length[45]');

        if ($this->form_validation->run() == FALSE) {
           $erros = array('mensagens' => validation_errors());
           $this->load->view('VCadastroUsuario', $erros);
        }

        else {//se a validação estiver correta, ele pega os dados, cadastra no banco e volta para o view de login

        	//pegar os valores com POST
            	//$id_usuario = $this->input->post('idusuario');//de um jeito ai, busca e por +1 ok?;

        		//Pegando os dados para passar para o banco.
				$nome = $this->input->post('nome');
				$cpf = $this->input->post('cpf');
				$email = $this->input->post('email');
		        $senha = $this->input->post('senha');

		        //Verificando qual radiobutton foi selecionado.
		        if ( $this->input->post('tipo_usuario') == 'submissor'){
		        	$submissor = TRUE; 
		        	$curador = FALSE; 
		        	$tipo_usuario = 'submissor';
		        }
		        else{
		        	if ( $this->input->post('tipo_usuario') == 'curador'){
			        	$curador = TRUE; 
			        	$submissor = FALSE;
			        	$tipo_usuario = 'curador';
		        	}
		        	else{
		        		if ( $this->input->post('tipo_usuario') == 'organizador'){
				        	$curador = TRUE; 
				        	$submissor = FALSE;
				        	$tipo_usuario = 'organizador';
		        		}
		        	}
		        }
		        
		        

		        //carrega o model MUsuario e submeter os dados no msg
		        $this->load->model('MUsuario');
        		$msg = $this->MUsuario->cadastrar($nome, $cpf, $email, $senha, $curador, $submissor, $tipo_usuario);

           echo "Formulário enviado com sucesso. Clique para voltar para a área de login";
         	$this->load->view('login/VLogin', "Formulário enviado com sucesso. Agora você pode fazer o login ou voltar para a página inicial");  
        }
	}

	public function cadastrar_usuario3(){
		//esta funcao cadatra curadores ou organizadores nas tabelas usuario e curador

		$this->load->library('form_validation');
		$this->load->helper('security');
		//Validação do formulário
        $this->form_validation->set_rules('nome','NOME COMPELTO','required');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|numeric'); 
        $this->form_validation->set_rules('email', 'E-MAIL', 'required|valid_email'); 
        $this->form_validation->set_rules('senha','SENHA','required|min_length[3]|max_length[45]');

        if ($this->form_validation->run() == FALSE) {
           $erros = array('mensagens' => validation_errors());
           $this->load->view('VCadastroCuradorOrganizador', $erros);
        }

        else {//se a validação estiver correta, ele pega os dados, cadastra no banco e volta para o view de login

        	//pegar os valores com POST
            	//$id_usuario = $this->input->post('idusuario');//de um jeito ai, busca e por +1 ok?;

        		//Pegando os dados para passar para o banco.
				$nome = $this->input->post('nome');
				$cpf = $this->input->post('cpf');
				$email = $this->input->post('email');
		        $senha = $this->input->post('senha');
		        $eixo = $this->input->post('eixo');


		        //Verificando qual radiobutton foi selecionado.
	        	if ( $this->input->post('tipo_usuario') == 'curador'){
		        	$curador = TRUE; 
		        	$organizador = FALSE; 
		        	$tipo_usuario = 'curador';
	        	}
	        	else{
	        		if ( $this->input->post('tipo_usuario') == 'organizador'){
			        	$curador = FALSE;
			        	$organizador = TRUE; 
			        	$tipo_usuario = 'organizador';
	        		}
	        	}

		        //carrega o model MUsuario e submeter os dados no msg
		        $this->load->model('MUsuario');
        		$msg = $this->MUsuario->cadastrarEx($nome, $cpf, $email, $senha, $curador, $organizador, $eixo, $tipo_usuario);

           echo "Formulário enviado com sucesso. Clique para voltar para a área de login";
         	$this->load->view('login/VLogin', "Formulário enviado com sucesso. Agora você pode fazer o login ou voltar para a página inicial");  
        }
	}

	
	public function carregaPaginaRecuperarSenha()
	{
		$this->load->view('VRecuperarSenha');
	}

	public function relembrarSenha()
	{
		//Configurando especificações da biblioteca.
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = '15congressoapsp.informatica@gmail.com'; //Email do 
		$config['smtp_pass'] = '15congresso';
		$config['protocol']  = 'smtp';
		$config['validate']  = TRUE;
		$config['mailtype']  = 'html';
		$config['charset']   = 'utf-8';
		$config['newline']   = "\r\n";


		$this->load->library('email', $config); //Importando a biblioteca de email do codeigniter com as configuracoes. 
		$this->load->model('MUsuario'); //Carrega as funções do model.

		$emailRemet = $this->input->post('email');
		$nomeRemet = $this->MUsuario->consultaNomeUsuario($emailRemet);
		$senhaRemet = $this->MUsuario->consultaSenhaUsuario($emailRemet);

		$this->email->from("15congressoapsp.informatica@gmail.com", "Congresso APSP"); //Email de quem está enviando.
		$this->email->to($emailRemet); //Para quem será enviado o email.

		$this->email->subject('Relembrando a senha de acesso ao Congresso.'); //Assunto do email.

		$msg = "Olá, ".$nomeRemet.". Sua senha é: ".$senhaRemet."!"; //Conteúdo do corpo do email
		$this->email->message($msg); //Corpo do email.

		//Verificando se existe alguem no banco com o email.
		if($nomeRemet == "default" || $senhaRemet == "default"){
			$status = "Dados referente ao email informado não encontrado.";
		}
		else{ //O email foi encontrado.
			//Verifica se o email foi enviado.
			if($this->email->send()) {
	            $status = 'Email enviado com sucesso!';
	        }
	        else{
	        	$erro = $this->email->print_debugger();
	            $status = $erro;
	        }
		}

		
		$info = array(
			'status' => $status, 
			'emailRementente' => $emailRemet
		);
		
		$this->load->view('VRecuperarSenhaResultado', $info);
	}

}
