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

    
      <h5><font size="5"><b>Orientações:</b>
      </font></h5>
    

    <ol type="I"><font size="3">
      <br><li>Clique um dos textos para visualizar o seu texto.</li>
      <br><li>Para visualizar os pareceres referentes ao seu texto, clique DUAS VEZES em um dos textos e clique no botão "Ver os pareceres e as respostas"</li>
      <br><li>Caso deseja mandar algum comentário, dúvida, mensagem a respeito de algum parecer, preenche o caixa de texto e clique no botão "responder ao parecer".</li>
      <br><li>Caso deseja enviar uma nova versão do seu texto, clique duas vezes no texto para selecionar o texto e coloque a nova versão do seu texto na caixa de texto que está no fim desta página .</li>
      </ol></font>

    <center>
      <br>
      <div class="row" style="= overflow-x:auto; width:100%">
        <table class="table" id = "table">
          <!--<thead>
            <th colspan="4" ><center><font size="5">Número de pareceres recebidos = <?php echo $this->MUsuario->consultaNumeroTextosSubmetidos($this->session->userdata('id')); ?></font></center></th>
          </thead> -->
          <thead>
            <th><font size="5"><b>Título do texto</b></font></th>
            <th><font size="5"><b>A última versão do seu texto</b></font></th>
          </thead>
          <tbody>
            <?php foreach($records as $record){     
                echo '<tr ondblclick="highlight(this,\'highli\');">';
                        echo '<td>'.$record->titulo.'</td>';//0
                        echo '<td>'.$record->mensagem.'</td>';//1
                        echo '<td style = "display: none">'.$record->id_texto.'</td>';//2
                        echo '<td style = "display: none">'.$record->fk_id_curador.'</td>';//3

                echo '</tr>';
            } ?>
          </tbody>
        </table>
      </div><!-- End-row -->
    </center>

    <label for="inputUser" class="col-sm-3 control-label">Título:</label> 
    <input type="text" name="nome_id_titulo" class="form-control" id="id_titulo"><br>

    <label for="inputUser" class="col-sm-3 control-label">Texto:</label> 
    <textarea rows="15" name="texto" class="form-control" id="id_mensagem" maxlength="4000">
    </textarea>
    
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
                    document.getElementById("id_titulo2").value = this.cells[0].innerHTML;
                    document.getElementById("id_titulo3").value = this.cells[0].innerHTML;

 
                    document.getElementById("id_mensagem").value = this.cells[1].innerHTML;

                    document.getElementById("id_do_texto").value = this.cells[2].innerHTML;
                    document.getElementById("id_do_texto2").value = this.cells[2].innerHTML;


                    document.getElementById("id_curador").value = this.cells[3].innerHTML;

                };
            }          
    </script>


    <hr><!--linha horizontal-->
        <h5><font size="4"><b>Respostas aos pareceres dados</b></font></h5>
        <font size="3"><h4><i class="fa fa-exclamation-triangle" style="color:red"></i> OBS: Se quiser consultar as informações dos pareceres dados para um determinado texto, clique no botão.<br>
        Ao fazer isso, a página vai recarregar, e o sistema vai consultar o banco de dados para ver se tem pareceres para o texto selecionado.<br> 
        Caso houver pareceres, a nova página vai ter os pareceres acrescentados na tabela debaixo do botão. Caso contrario, não haverá nada debaixo da tabela</h4></font>


    <form action="<?php echo base_url('index.php/CSubmissor/verPareceresRespostasSubmissor'); ?>" method="post">
    <!-- <label for="inputUser" class="col-sm-3 control-label">id do texto:</label>  -->
    <input type="text" name="nome_do_texto2" class="form-control" id="id_do_texto" style = "display: none">

    <center>
      <div class="row" style="= overflow-x:auto; width:100%">
        <table class="table" id = "table2">
          <thead>
            <th colspan="2">
              <div class="col-sm-12 form-group" style="text-align: center">
                <label for="inputUser" class="col-sm-4 control-label"><font size ="4"> Título do texto:</font></label>
                <input type="text" name="nome2" class="col-sm-4 " id="id_titulo2"   style="margin-right: 90px">
                <a href="<?php echo base_url('index.php/CSubmissor/verPareceresRespostasSubmissor'); ?>"><button type="submit" class="col-sm-3 btn btn-basic btn-md">Ver os pareceres e as respostas</button></a>
    
              </div>
            </th>
          </thead>
          <thead>
            <th><font size="3">Parecer</font></th>
            <th><font size="3">Comentário ao Parecer</font></th>
          </thead>

          <tbody>
            <?php 
            if($records2 != NULL) {
              foreach($records2 as $record){             
                echo '<tr ondblclick="highlight2(this,\'highli\');">';
                        echo '<td>'.$record->comentario.'</td>';//0
                        echo '<td>'.$record->resposta.'</td>';//1
                        echo '<td style = "display: none">'.$record->seq.'</td>';//2
                        echo '<td style = "display: none">'.$record->fk_id_texto.'</td>';//3
                echo '</tr>';
              } 
            }?>
          </tbody>

        </table>
      </div><!-- End-row -->
    </center>

    </form><!--fim do form para pegar o id do texto para consultar parecer/respostas-->

    <label for="inputUser" class="col-sm-3 control-label">Parecer:</label> 
    <input type="text" name="name_parecer_dado" class="form-control" id="id_parecer_dado"><br>

    <!-- <label for="inputUser" class="col-sm-3 control-label">Comentário ao Parecer:</label>  -->
    <input type="text" name="name_resposta" class="form-control" id="id_resposta"
    style="display: none"><br>

    <script> 
            // get selected row
            // display selected row data in text input
            var table = document.getElementById("table2"),rIndex;
            
            for(var i = 0; i < table.rows.length; i++)
            {
                table.rows[i].onclick = function()
                {
                    rIndex = this.rowIndex;
                    //console.log(rIndex);
                    //this cells é a ordem dos input da tabela, no tag <tr>
                    document.getElementById("id_parecer_dado").value = this.cells[0].innerHTML;

                    document.getElementById("id_resposta").value = this.cells[1].innerHTML;

                    document.getElementById("id_seq").value = this.cells[2].innerHTML;

                    document.getElementById("id_texto_parecer").value = this.cells[3].innerHTML;
 
                };
            }          
    </script>

      <form action="<?php echo base_url('index.php/CSubmissor/responder_parecer'); ?>" method="post">

      <!-- <label for="inputUser" class="col-sm-12 control-label">id do texto:</label>  -->
      <input type="text" name="nome_do_texto" class="form-control" id="id_texto_parecer" style = "display: none">

      <!-- <label for="inputUser" class="col-sm-12 control-label">id do seq:</label>  -->
      <input type="text" name="nome_seq" class="form-control" id="id_seq" style = "display: none">

      <hr><!--linha horizontal-->
      <label for="inputUser" class="form-horizontal"><font size="3">Coloque suas dúvidas ou comentários a respeito ao parecer selecionado:</font></label>
      <textarea rows="8" class="form-control" name = "nome_id_resposta" id="id_resposta" maxlength="1000" style="= width:100%"></textarea>     
      <br>
    
      <a href="<?php echo base_url('index.php/CSubmissor/responder_parecer'); ?>">
      <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalComentario"><b>Responder ao parecer</b></button></a>
     
      </form>

      <!-- POPUP Parecer ao texto-->
      <div class="modal fade" id="ModalComentario" role="dialog"><!--comeco POPUP-->
        <div class="modal-dialog">

            <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title">Resposta encaminhado</h3>
            </div>
            <div class="modal-body">
              <p>A sua resposta ao parecer já foi encaminhado para o seu curador</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
              
          </div>
      </div><!--fim POPUP-->




      <form action="<?php echo base_url('index.php/CSubmissor/enviar_nova_versao'); ?>" method="post">

      <!-- <label for="inputUser" class="col-sm-12 control-label">id do texto:</label>  -->
      <input type="text" name="nome_id_do_texto" class="form-control" id="id_do_texto2" style = "display: none">

      <!-- <label for="inputUser" class="col-sm-3 control-label">Título:</label>  -->
      <input type="text" name="nome_id_titulo" class="form-control" id="id_titulo3" style = "display: none"><br>

      <hr><!--linha horizontal-->


      <label for="inputUser" class="col-sm-12 control-label"><font size="3">Clique DUAS VEZES na primeira tabela dos textos para selecionar seu texto. <br>
      Ao selecionar o texto, pode digitar a nova versão do seu texto:</font></label>
      <textarea rows="15" class="form-control" name="nome_id_novo_texto" id="id_novo_texto" maxlength="4000"></textarea>

      <center>
          <br>
          <a href="<?php echo base_url('index.php/CSubmissor/enviar_nova_versao'); ?>">
          <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalNovaVersao"><b>Enviar uma nova versão do seu texto</b></button></a>
      </center>

      </form>

    <!-- POPUP Parecer ao texto-->
    <div class="modal fade" id="ModalNovaVersao" role="dialog"><!--comeco POPUP-->
      <div class="modal-dialog">

          <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Texto encaminhado</h3>
          </div>
          <div class="modal-body">
            <p>A nova versão do seu texto já foi encaminhado para o seu curador</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
            
        </div>
    </div><!--fim POPUP-->


    
    </div><!-- End-container -->

  </div><!-- End-panel-body -->

</html><!-- End-html -->
            