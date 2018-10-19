<!DOCTYPE html>
<br>
<?php if(isset($alerta)){ ?>
	<div class="alert">
		<center>
		<i class="fa fa-exclamation-triangle" style="color:red"></i>
        <?php echo $alerta['mensagem']; ?>
        </center>
     </div>
 <?php }?>


</html><!-- End-html -->