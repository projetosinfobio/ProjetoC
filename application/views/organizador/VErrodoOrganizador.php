<!DOCTYPE html>
<br>
<?php echo validation_errors();?>

<?php if(isset($alerta)){ ?>
	<div class="alert">
		<center>
		<font size = 4><i class="fa fa-exclamation-triangle" style="color:red"></i>
        <?php echo $alerta['mensagem']; ?></font>
        </center>
     </div>
 <?php }?>

 <div class="form-group">
 	<center>
    	<a href="<?php echo base_url('index.php/COrganizador'); ?>">
    	<button type="submit" name="recuperar" class="btn btn-danger btn-lg" id="_recuperar" placeholder="recuperar">Clique aqui para voltar</button></a>
    </center>
</div>


</html><!-- End-html -->