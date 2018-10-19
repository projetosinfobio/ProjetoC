<!DOCTYPE html>
<?php
		$this->load->view('includes/VHeader');
        $this->load->view('organizador/VMenu_bar');
?>
<br><br>
	<center>
		<h4 for="inputUser" class="col-sm-12">Texto encaminhado com sucesso, clique no botão "Voltar" ou no "Home (Organizador)" do menu</h4>
		<br>
		<a href="<?php echo base_url('index.php/COrganizador'); ?>">
		<button type="submit" class="btn btn-danger btn-lg" ><font size="3">Voltar</font></button></a>
	</center>
<br><br>

<?php
        $this->load->view('includes/VFooter');
?>

</html>