<!DOCTYPE html>
<style>
table, th, td {
    border: 2px solid dimgrey;
}
th {
    height: 50px;
    background-color: #CD5C5C;
}
tr:hover{
    background-color: #C0C0C0;
}
.highli {
    background-color: #C0C0C0;
}
</style>

<script type="text/javascript">
function highlight(el, className) {
    if (el.className.indexOf(className) >= 0) {
        el.className = el.className.replace(className,"");
    }
    else {
        var x = document.getElementById("table"); 
        for (var i = x.rows.length - 1; i >= 0; i--) {
            if (x.rows[i].className.indexOf(className) >= 0) {
                x.rows[i].className = x.rows[i].className.replace(className,"");
            }
        }
        el.className  += className;
    }
}

function highlight2(el, className) {
    if (el.className.indexOf(className) >= 0) {
        el.className = el.className.replace(className,"");
    }
    else {
        var x = document.getElementById("table2"); 
        for (var i = x.rows.length - 1; i >= 0; i--) {
            if (x.rows[i].className.indexOf(className) >= 0) {
                x.rows[i].className = x.rows[i].className.replace(className,"");
            }
        }
        el.className  += className;
    }
}

</script>

<div class="panel-body">
  <div class="container" >
    <div class="panel-heading">
      <h3>
        <center>
         <i class="fa fa-user"></i> BEM-VINDO <?php echo $this->session->userdata('nome') ?>
        </center>
      </h3>
    </div>

    <?php echo validation_errors();?>

    <?php if(isset($alerta)){ ?>
    <div class="alert">
    <center>
    <font size = 4><i class="fa fa-exclamation-triangle" style="color:red"></i>
        <?php echo $alerta['mensagem']; ?></font>
        </center>
     </div>
    <?php }?>


    <form action="<?php echo base_url('index.php/CSubmissor/reenviarcomprovante'); ?>" method="post" enctype="multipart/form-data">
        <hr><!--linha horizontal-->
        <label for="inputUser" class="col-sm-8 control-label"><font size = "4">Anexa o comprovante de pagamento: <br>O arquivo anexado tem que ser no formato pdf:</font></label>
        <input type="file" name="comprovante" class="form-control" id="id_comprovante" placeholder=""> 
        <center>
              <a href="<?php echo base_url('index.php/CSubmissor/reenviarcomprovante'); ?>">
              <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalAlterarComprovante"><b>Reenviar o comprovante</b></button></a>
        </center>
        <hr><!--linha horizontal-->
    </form>

    <!--**************************** TODAS as telas POPUP ****************************  -->



    <!-- POPUP mudar comprovante-->
    <div class="modal fade" id="ModalAlterarComprovante" role="dialog"><!--comeco POPUP-->
      <div class="modal-dialog"><!-- Modal dialog-->

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Texto alterado</h3>
          </div>
          <div class="modal-body">
            <p>O coprovante de pagamento foi alterado com sucesso e um e-mail será enviado para você</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!--fim Modal content-->
            
      </div><!-- fim Modal dialog-->
    </div><!--fim POPUP-->

    
    </div><!-- End-container -->

  </div><!-- End-panel-body -->

</html><!-- End-html -->