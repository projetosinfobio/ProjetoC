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

    <?php if(isset($alerta)){ ?>
      <div class="alert alert-<?php echo $alerta['class']; ?>">
          <?php echo $alerta['mensagem']; ?>
      </div>
    <?php }?>
    <?php if(isset($mensagens)) echo $mensagens; ?>

    
      <h5><font size="5"><b>Editar o seu texto: </b>
      </font></h5>
 
    <ol type="I"><font size="3">
      <li>Clique duas vezes no seu texto para mostrar o seu conteúdo nas caixas de texto debaixo da tabela.</li>
      <br><li>Caso deseja alterar alguma parte da seu texto, mude o conteúdo da caixa de texto e clique no botão abaixo daquela caixa de texto</li>
      <br><li>Inserção dos autores: Coloque os autores abaixo do título com uma linha separando o título e os autores</li>
      <br><li>Cada alteração no seu texto será confirmada por e-mail.</li>
      </ol></font>

    <center>
      <br>
      <div class="row" style="= overflow-x:auto; width:100%">
        <table class="table" id = "table">
          <!--<thead>
            <th colspan="4" ><center><font size="5">Número de pareceres recebidos = <?php echo $this->MUsuario->consultaNumeroTextosSubmetidos($this->session->userdata('id')); ?></font></center></th>
          </thead> -->
          <thead>
            <th><font size="5"><b>Título &amp Autores</b></font></th>
            <th><font size="5"><b>Tipo de texto</b></font></th>
          </thead>
          <tbody>
            <?php foreach($records as $record){    
                switch ($record->tipo_texto) {
                    case 'P':
                        $tipo_texto = 'Relatório de Pesquisa';
                        break;
                    case 'E':
                        $tipo_texto = 'Relatório de Experiência';
                        break;
                }

                echo '<tr ondblclick="highlight(this,\'highli\');">';
                        echo '<td>'.$record->titulo.'</td>';//0
                        echo '<td style = "display: none">'.$record->mensagem.'</td>';//1
                        echo '<td style = "display: none">'.$record->id_texto.'</td>';//2
                        echo '<td style = "display: none">'.$record->fk_id_curador.'</td>';//3
                        echo '<td>'.$tipo_texto.'</td>';//4

                echo '</tr>';
            } ?>
          </tbody>
        </table>
      </div><!-- End-row -->
    </center>

    <form action="<?php echo base_url('index.php/CSubmissor/editar_titulo'); ?>" method="post">
      <hr><!--linha horizontal-->

      <!-- <label for="inputUser" class="col-sm-3 control-label"><font size = "4">id do texto:</font></label>  -->
      <input type="text" name="nome_id_do_texto" class="form-control" id="id_do_texto" style = "display:none">

      <label for="inputUser" class="col-sm-3 control-label"><font size = "4">Título &amp os Autores do texto:</font></label> 
      <textarea rows="6" name="nome_titulo" class="form-control" 
          id="id_titulo" maxlength="1000"></textarea>

      <center>
            <a href="<?php echo base_url('index.php/CSubmissor/editar_titulo'); ?>">
            <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalAlterarTitulo"><b>Alterar o títilo</b></button></a><br>
      </center>
    </form>

    <form action="<?php echo base_url('index.php/CSubmissor/editar_texto'); ?>" method="post">
      <hr><!--linha horizontal-->
      <!-- <label for="inputUser" class="col-sm-3 control-label"><font size = "4">id do texto:</font></label>  -->
      <input type="text" name="nome_id_do_texto2" class="form-control" id="id_do_texto2" style ="display:none">
      <label for="inputUser" class="col-sm-3 control-label"><font size = "4">Texto:</font></label> 
      <textarea rows="15" name="nome_mensagem" class="form-control" id="id_mensagem" maxlength="4000">
      </textarea>

      <center>
            <a href="<?php echo base_url('index.php/CSubmissor/editar_texto'); ?>">
            <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalAlterarTexto"><b>Alterar o texto</b></button></a><br>
      </center>
    </form>

    <form action="<?php echo base_url('index.php/CSubmissor/editar_tipo_texto'); ?>" method="post">
      <hr><!--linha horizontal-->
      <!-- <label for="inputUser" class="col-sm-3 control-label"><font size = "4">id do texto:</font></label> --> 
      <input type="text" name="nome_id_do_texto3" class="form-control" id="id_do_texto3" style = "display:none">
      <label for="inputUser" class="col-sm-3 control-label"><font size = "4">Tipo de texto:</font></label> 
      <input type="text" name="nome_tipo_texto" class="form-control" id="id_tipo_texto">

      <div class="col-sm-12 form-group"> 
          <label for="inputUser" class="col-sm-6 control-label"><font size = "4">Selecione se o seu texto é um relato de pesquisa ou um relato de experiência:</font></label> 
          <div class="col-sm-6"> 
            <select name="nome_tipo" class=" col-sm-6 form-control" id="id_tipo"> 
              <option>--Selecione o tipo de texto--</option> 
              <option value="P">Relato de Pesquisa</option> 
              <option value="E">Relato de Experiência</option> 
            </select> 
          </div> 
      </div> 

      <center>
            <a href="<?php echo base_url('index.php/CSubmissor/editar_tipo_texto'); ?>">
            <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalAlterarTipoTexto"><b>Alterar o tipo de texto</b></button></a><br>
      </center>
    </form>
    
    
    <form action="<?php echo base_url('index.php/CSubmissor/reenviarcomprovante'); ?>" method="post" enctype="multipart/form-data">
        <hr><!--linha horizontal-->
        <label for="inputUser" class="col-sm-8 control-label"><font size = "4">Reenviar o comprovante de pagamento:</font></label>
        <input type="file" name="comprovante" class="form-control" id="id_comprovante" placeholder=""> 
        <center>
              <a href="<?php echo base_url('index.php/CSubmissor/reenviarcomprovante'); ?>">
              <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalAlterarComprovante"><b>Reenviar o comprovante</b></button></a><br>
        </center>
    </form>

    <script> 
            // get selected row
            // display selected row data in text input
            var table = document.getElementById("table"),rIndex;
            
            for(var i = 0; i < table.rows.length; i++)
            {
                table.rows[i].onclick = function()
                {
                    rIndex = this.rowIndex;
                    //console.log(rIndex);
                    //this cells é a ordem dos input da tabela, no tag <tr>

                    document.getElementById("id_titulo").value = this.cells[0].innerHTML;
 
                    document.getElementById("id_mensagem").value = this.cells[1].innerHTML;

                    document.getElementById("id_do_texto").value = this.cells[2].innerHTML;
                    document.getElementById("id_do_texto2").value = this.cells[2].innerHTML;
                    document.getElementById("id_do_texto3").value = this.cells[2].innerHTML;

                    document.getElementById("id_tipo_texto").value = this.cells[4].innerHTML;

                };
            }          
    </script>


    <!--**************************** TODAS as telas POPUP ****************************  -->

    <!-- POPUP mudar titulo--> 
    <div class="modal fade" id="ModalAlterarTitulo" role="dialog"><!--comeco POPUP-->
      <div class="modal-dialog"><!-- Modal dialog-->

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Titulo alterado</h3>
          </div>
          <div class="modal-body">
            <p>O titulo do seu texto foi alterado com sucesso e um e-mail será enviado para você</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!--fim Modal content-->
            
      </div><!-- fim Modal dialog-->
    </div><!--fim POPUP-->

    <!-- POPUP mudar titulo-->
    <div class="modal fade" id="ModalAlterarTexto" role="dialog"><!--comeco POPUP-->
      <div class="modal-dialog"><!-- Modal dialog-->

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Texto alterado</h3>
          </div>
          <div class="modal-body">
            <p>O texto foi alterado com sucesso e um e-mail será enviado para você</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!--fim Modal content-->
            
      </div><!-- fim Modal dialog-->
    </div><!--fim POPUP-->

    <!-- POPUP mudar tipo de texto-->
    <div class="modal fade" id="ModalAlterarTipoTexto" role="dialog"><!--comeco POPUP-->
      <div class="modal-dialog"><!-- Modal dialog-->

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Texto alterado</h3>
          </div>
          <div class="modal-body">
            <p>O tipo de texto foi alterado com sucesso e um e-mail será enviado para você</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!--fim Modal content-->
            
      </div><!-- fim Modal dialog-->
    </div><!--fim POPUP-->

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

