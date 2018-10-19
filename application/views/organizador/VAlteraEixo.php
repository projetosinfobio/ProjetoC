<!DOCTYPE html>
<?php
		$this->load->view('includes/VHeader');
        $this->load->view('organizador/VMenu_bar');
?>
<br><br>
	<center>
		<h4 for="inputUser" class="col-sm-12">Selecione o novo eixo</h4>
		<form action="<?php echo base_url('index.php/COrganizador/atualizar_eixo'); ?>" method="post"> 


		<label for="inputUser" class="col-sm-6 control-label">Selecione o eixo no qual seu texto encaixa melhor:</label>
         
          <select name="nome_novoeixo" class=" col-sm-6  form-control" id="id_eixo"> 
            <option>--Selecione o eixo de texto--</option> 
            <option value="1">Eixo 1: Saúde Mental e cultura.</option> 
            <option value="2">Eixo 2: Participação Social em uma conjuntura antidemocrática.</option> 
            <option value="3">Eixo 3: Gestão e redes de Atenção à Saúde.</option> 
            <option value="4">Eixo 4: Território e sustentabilidade.</option> 
            <option value="5">Eixo 5: Educação.</option> 
            <option value="6">Eixo 6: Saúde e Gênero.</option> 
          </select> 
       
        
		<a href="<?php echo base_url('index.php/COrganizador/atualizar_eixo'); ?>">
		<button type="submit" class="col-sm-4 btn btn-danger btn-sm" ><font size="3">Altera Eixo</font></button></a>
        </div><!--fim fiv class-->

		</form>
	</center>
<br><br>

<?php
        $this->load->view('includes/VFooter');
?>

</html>