<!DOCTYPE html>
<?php
		$this->load->view('includes/VHeader');
        $this->load->view('VMenuBar');
?>
<div class="content-wrapper">

      <div class="panel-body">

        <div class="container" style="background-color: #F5F5F5">

			<center>
			<div class="row">
				<section>
					<div class="table">
						<h2>Envie uma mensagem: </h2>
						<?php
							//aparece as mensagens (campos invalidos ou sucesso ao enviar email)
							if ($formerror){
								echo '<p>'.$formerror.'<p>';
							};
							//abertura do form
							echo form_open(base_url('index.php/CHome/contato'));
							//campo nome
							echo form_label('Seu nome:', 'nome');
							echo '</br>';
							echo form_input('nome', set_value('nome'));
							echo '</br></br>';
							//campo email
							echo form_label('Seu email:', 'email');
							echo '</br>';
							echo form_input('email', set_value('email'));
							echo '</br></br>';
							//campo assunto
							echo form_label('Assunto:', 'assunto');
							echo '</br>';
							echo form_input('assunto', set_value('assunto'));
							echo '</br></br>';
							//campo mensagem
							echo form_label('Sua Mensagem:', 'mensagem');
							echo '</br>';
							echo form_textarea('mensagem', set_value('mensagem'));
							echo '</br></br>';
							//botao e fechamento do form
							echo form_submit('Enviar', 'Enviar Mensagem >>');
							echo '</br></br></br></br>';
							echo form_close();
						?>
					</div>	 
				</section>
			</div>
			</center>

		</div><!-- End-container -->

      </div><!--end-panel -->

</div><!--end-wrapper -->

</html>

<?php
        $this->load->view('includes/VFooter');
?>