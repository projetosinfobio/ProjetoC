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
      <li>Clique no título do texto para visualizar o resumo;</li>
      <br><li>Clique DUAS VEZES sobre o título do texto e, para visualizar os pareceres referentes a ele, clique posteriormente no botão &quot;Ver os pareceres&quot;</li>
      <br><li>Caso seja necessário editar o texto submetido, faça as alterações e clique no botão &quot;Enviar texto editado&quot;</li>
      <br><li>O nome de autores e co-autores e sua vinculação institucional devem ser inseridos acima do resumo, na mesma caixa de texto;</li>
      <br><li>Encaminhe apenas uma resposta para cada parecer recebido;</li>
      <br><li>Aguarde nova resposta do curador para encaminhar novas alterações;</li>
      <br><li>Em caso de dúvida ou comentário, preencha o campo disponível no final do formulário.</li>
      </ol></font>

    <form action="<?php echo base_url('index.php/CSubmissor/verPareceres'); ?>" method="post">

      <!-- <label for="inputUser" class="col-sm-3 control-label">id do texto:</label>  -->
      <input type="text" name="nome_do_texto2" class="form-control" id="id_do_texto2" style="display: none" >

      <center>
        <br>
        <div class="row" style="= overflow-x:auto; width:100%">
          <table class="table" id = "table">
            <!-- <col width="75%">
            <col width="15%">
            <col width="10%"> -->
            <col width="85%">
            <col width="15%">
            <thead>
              <th>
                <div class="col-sm-10 form-group" style="text-align: left">
                  <label for="inputUser" class="col-sm-3 control-label"><font size ="4"> Título do texto:</font></label>
                  <input type="text" name="nome2" class="col-sm-4 " id="id_titulo2"   style="margin-right: 90px">
                  <a href="<?php echo base_url('index.php/CCurador/verPareceres'); ?>"><button type="submit" class="col-sm-3 btn btn-basic btn-md">Ver os pareceres</button></a>
                </div>
              </th>
              <th><font size="4"><b>Tipo de texto</b></font></th>
              <!-- <th><font size="4"><b>Pareceres</b></font></th>-->
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
                          echo '<td style = "display: none"><a href="http://localhost/congapsp/index.php/CSubmissor/verPareceres"><input type="button" class="btn btn-primary btn-sm" value="Ver os pareceres"></a></td>';

                  echo '</tr>';
              } ?>
            </tbody>
          </table>
        </div><!-- End-row -->
      </center>

      <center>
        <div class="row" style="= overflow-x:auto; width:100%">
          <table class="table" id = "table2">
            <thead>
              <th><font size="3">Pareceres</font></th>
              <th><font size="3">Comentários ou dúvidas</font></th>
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

    </form><!--fim do form ver pareceres-->

    <form action="<?php echo base_url('index.php/CSubmissor/responder'); ?>" method="post">

    <!-- <label for="inputUser" class="form-horizontal"><font size="3">id do texto:</font></label>   -->
    <input type="text" name="nome_id_do_texto" class="form-control" id="id_do_texto" style="display: none;">

    <label for="inputUser" class="form-horizontal"><font size="3">Título:</font></label> 
    <textarea rows="2" name="nome_id_titulo" class="form-control" 
        id="id_titulo" maxlength="1000"></textarea> <br>
     

    <label for="inputUser" class="form-horizontal"><font size="3">A última versão do seu texto:</font></label> 
    <textarea rows="15" name="nome_id_mensagem" class="form-control" id="id_mensagem" maxlength="4000" onkeyup="count_down(this);">
    </textarea>

    <!--
    <label for="inputUser" class="form-horizontal"><font size="3">Número de caracteres faltando (máximo de 4000): </font></label>
    <font size="5"><b><p id="numero">4000</p></b></font>--><br>

    <label for="inputUser" class="form-horizontal"><font size="3">Está com alguma dúvida ou comentário? Preenche o campo abaixo:</font></label>
    <textarea rows="4" class="form-control" name = "nome_id_resposta" id="id_resposta" maxlength="1000" style="= width:100%"></textarea>     
    <center>
          <br>
          <a href="<?php echo base_url('index.php/CSubmissor/responder'); ?>">
          <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalNovaVersao"><b>Enviar texto editado</b></button></a>
    </center>

    </form><!--Fim form Responder-->
    
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

                    
                    document.getElementById("id_mensagem").value = this.cells[1].innerHTML;
                    CKEDITOR.replace('nome_id_mensagem'); 
                    

                    document.getElementById("id_do_texto").value = this.cells[2].innerHTML;
                    document.getElementById("id_do_texto2").value = this.cells[2].innerHTML;


                    document.getElementById("id_curador").value = this.cells[3].innerHTML;

                    document.getElementById("id_tipo_texto").value = this.cells[4].innerHTML;

                };

            }

      </script>

      <script>     
        function count_down(obj) {
             
            var numero = document.getElementById('numero');
             
            numero.innerHTML = 4000 - obj.value.length;
             
             
        }
      </script>



      <!-- POPUP texto enviado-->
      <div class="modal fade" id="ModalNovaVersao" role="dialog"><!--comeco POPUP-->
        <div class="modal-dialog">

            <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title">Texto encaminhado</h3>
            </div>
            <div class="modal-body">
              <p>A nova versão do seu texto foi encaminhado para o seu curador</p>
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
            