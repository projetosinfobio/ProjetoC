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
    	<a href="<?php echo base_url('index.php/CSubmissor/pareceres'); ?>">
    	<button type="submit" name="recuperar" class="btn btn-danger btn-lg" id="_recuperar" placeholder="recuperar">Voltar</button></a>
    </center>
</div>


</html><!-- End-html -->