<!DOCTYPE html>
<style type="text/css">
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

    <center>
      <h5><font size="5">Selecione um dos textos para aceitar, rejeitar ou dar o parecer</font></h5>
    </center><br />

    <center>
      <font size="4">(Em caso de dúvidas, mande um e-mail para 15congressoapsp.informatica@gmail.com)</font>
    </center>

    <center>
      <div class="row" style="= overflow-x:auto; width:100%">
        <table class="table" id = "table">
          <thead>
            <th colspan="6" ><center><font size="5">Número de trabalhos recebidos = <?php echo $this->MOrganizador->consultaNumeroTrabalhosPorCurador($this->session->userdata('id')); ?></font></center></th>
          </thead>
          <thead>
            <th><font size="3">Nome</font></th>
            <th><font size="3">Título</font></th>
            <th><font size="3">Texto</font></th>
            <th><font size="3">Status</font></th>
            <th><font size="3">E-mail</font></th>
            <th><font size="3">Tipo</font></th>
          </thead>
          <tbody>
            <?php foreach($records as $record){             
                switch ($record->status) {
                    case 0:
                        $b = $this->MOrganizador->consultaNomeCurador($record->fk_id_curador);
                        $status_texto = 'Texto não encaminhado';
                        break;
                    case 1:
                        $a = 'Em fase de curadoria. Curador responsável: ';
                        $b = $this->MOrganizador->consultaNomeCurador($record->fk_id_curador);
                        $status_texto = $a.$b;
                        break;
                    case 2:
                        $a = $this->MOrganizador->consultaNomeCurador($record->fk_id_curador); 
                        $b = ' aceitou o trabalho';
                        $status_texto = $a.$b;
                        break;
                    case 3:
                        $a = $this->MOrganizador->consultaNomeCurador($record->fk_id_curador); 
                        $b = ' rejeitou o trabalho';
                        $status_texto = $a.$b;
                        break;
                }

                switch ($record->tipo_texto) {
                    case 'P':
                        $tipo_texto = 'Relatório de Pesquisa';
                        break;
                    case 'E':
                        $tipo_texto = 'Relatório de Experiência';
                        break;
                }

                echo '<tr ondblclick="highlight(this,\'highli\');">';
                        echo '<td>'.$record->nome.'</td>';//0
                        echo '<td>'.$record->titulo.'</td>';//1
                        echo '<td>'.$record->mensagem.'</td>';//2
                        echo '<td>'.$status_texto.'</td>';//3
                        echo '<td style = "display: none">'.$record->id_usuario.'</td>';//4
                        echo '<td style = "display: none">'.$record->id_texto.'</td>';//5
                        echo '<td>'.$record->email.'</td>';//6
                        echo '<td>'.$tipo_texto.'</td>';//7

                echo '</tr>';
            } ?>
          </tbody>
        </table>
      </div><!-- End-row -->
    </center>

    <label for="inputUser" class="form-horizontal"><font size="3">Nome:</font></label> 
    <input type="text" name="name_submissor" class="form-control" id="id_nome"><br>

    <label for="inputUser" class="form-horizontal"><font size="3">E-mail:</font></label> 
    <input type="text" name="nome_do_email2" class="form-control" id="id_do_email2">

    <!-- <label for="inputUser" class="col-sm-3 control-label">Tipo de texto:</label>  -->
    <input type="text" name="name_tipo_texto" class="form-control" id="id_tipo_texto" style="display: none"><br>

    <form action="<?php echo base_url('index.php/CCurador/editarTexto'); ?>" method="post">

    <label for="inputUser" class="form-horizontal"><font size="3">Título:</font></label> 
    <input type="text" name="name_id_titulo" class="form-control" id="id_titulo"><br>


    <!-- <label for="inputUser" class="col-sm-3 control-label">id do texto:</label>  -->
    <input type="text" name="nome_do_texto5" class="form-control" id="id_do_texto5" style = "display: none" >

    <!-- <label for="inputUser" class="col-sm-3 control-label">id submissor:</label>  -->
    <input type="text" name="nome_o_submissor3" class="form-control" id="id_o_submissor3" style = "display: none">


    <label for="inputUser" class="form-horizontal"><font size="3">Texto:</font></label> 
    <textarea rows="15" name="texto" class="form-control" id="id_mensagem" maxlength="4000">
    </textarea>

    <center>
      <a href="<?php echo base_url('index.php/CCurador/editarTexto'); ?>">
      <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalEditar"><b>Editar título e o texto</b></button></a>
    </center><br>

    </form><!--end form editar texto-->


    <form action="<?php echo base_url('index.php/CCurador/aceitarTexto'); ?>" method="post">
    <!-- <label for="inputUser" class="col-sm-3 control-label">id submissor:</label>  -->
    <input type="text" name="nome_o_submissor" class="form-control" id="id_o_submissor" style = "display: none">

    <!-- <label for="inputUser" class="col-sm-3 control-label">id do texto:</label>  -->
    <input type="text" name="nome_do_texto" class="form-control" id="id_do_texto" style = "display: none">
    

    <br>
    <div class="col-sm-12 form-group">
      <center>
        <div class="col-sm-6">
          <a href="<?php echo base_url('index.php/CCurador/aceitarTexto'); ?>">
          <button type="submit" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#ModalAceitar"><b>Aceitar o texto</b></button></a>
        </div>
    </form><!--end form aceitar texto-->

    <form action="<?php echo base_url('index.php/CCurador/rejeitarTexto'); ?>" method="post">
        <div class="col-sm-6">
          <a href="<?php echo base_url('index.php/CCurador/rejeitarTexto'); ?>">
          <button type="submit" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#ModalRejeitar"><b>Rejeitar o texto</b></button></a>
        </div>
      </center>
    </div><!-- form-group -->

    
    <!-- <label for="inputUser" class="col-sm-3 control-label">id submissor:</label>  -->
    <input type="text" name="nome_o_submissor2" class="form-control" id="id_o_submissor2" style = "display: none">

    <!-- <label for="inputUser" class="col-sm-3 control-label">id do texto:</label>  -->
    <input type="text" name="nome_do_texto2" class="form-control" id="id_do_texto2" style = "display: none">

    </form><!--end form rejeitar texto-->

    <!-- POPUP Aceitar texto-->
    <div class="modal fade" id="ModalAceitar" role="dialog"><!--comeco POPUP-->
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title">Aceitar Texto</h3>
            </div>
            <div class="modal-body">
              <p>O texto foi aceito.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
    </div><!--fim POPUP-->

    <!-- POPUP Aceitar texto-->
    <div class="modal fade" id="ModalEditar" role="dialog"><!--comeco POPUP-->
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title">Editar Texto</h3>
            </div>
            <div class="modal-body">
              <p>O texto foi editado.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
    </div><!--fim POPUP-->

    <!-- POPUP Rejeitar texto-->
    <div class="modal fade" id="ModalRejeitar" role="dialog"><!--comeco POPUP-->
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title">Rejeitar Texto</h3>
            </div>
            <div class="modal-body">
              <p>O texto foi rejeitado.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
    </div><!--fim POPUP-->

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
                    document.getElementById("id_nome").value = this.cells[0].innerHTML;
                    document.getElementById("id_nome2").value = this.cells[0].innerHTML;

                    document.getElementById("id_titulo").value = this.cells[1].innerHTML;
 
                    document.getElementById("id_mensagem").value = this.cells[2].innerHTML;
                    CKEDITOR.replace('texto'); 

                    document.getElementById("id_o_submissor").value = this.cells[4].innerHTML;
                    document.getElementById("id_o_submissor2").value = this.cells[4].innerHTML;
                    document.getElementById("id_o_submissor3").value = this.cells[4].innerHTML;
      
                    document.getElementById("id_do_texto").value = this.cells[5].innerHTML;
                    document.getElementById("id_do_texto2").value = this.cells[5].innerHTML;
                    document.getElementById("id_do_texto3").value = this.cells[5].innerHTML;
                    document.getElementById("id_do_texto4").value = this.cells[5].innerHTML;
                    document.getElementById("id_do_texto5").value = this.cells[5].innerHTML;

                    document.getElementById("id_do_email").value = this.cells[6].innerHTML;
                    document.getElementById("id_do_email2").value = this.cells[6].innerHTML;
                    
                    document.getElementById("id_tipo_texto").value = this.cells[7].innerHTML;

                };
            }          
    </script>

     <form action="<?php echo base_url('index.php/CCurador/enviar_parecer'); ?>" method="post">
     
    <div class="col-sm-12 form-group">
      <hr><!--linha horizontal-->
        <h5><font size="4"><b>Parecer ao texto: Caso deseja de mandar algum parecer para o autor, escreva o seu parecer abaixo:</b></font></h5>
      
     
        <div class="col-sm-12"><textarea rows="8" class="form-control"
                  name = "name_id_parecer" id="id_parecer" maxlength="3000" style="= width:100%"></textarea>     
        </div>  
        <br><br>

    </div><!-- form-group -->

    <a href="<?php echo base_url('index.php/CCurador/enviar_parecer'); ?>"><button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalParecer"><b>Encaminhar parecer para o texto selecionado</b></button></a>

    <!-- <label for="inputUser" class="col-sm-3 control-label">id do texto:</label> -->
    <input type="text" name="name_do_texto3" class="form-control" id="id_do_texto3" style = "display: none">

    <!-- <label for="inputUser" class="col-sm-3 control-label">email:</label> -->
    <input type="text" name="nome_do_email" class="form-control" id="id_do_email" style = "display: none">

    </form><!--Fim form enviar parecer-->

    <!-- POPUP Parecer ao texto-->
    <div class="modal fade" id="ModalParecer" role="dialog"><!--comeco POPUP-->
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title">Parecer enviado</h3>
            </div>
            <div class="modal-body">
              <p>O parecer foi encaminhado para o submissor</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
    </div><!--fim POPUP-->




    <hr><!--linha horizontal-->
        <h5><font size="4"><b>Visualizar os Pareceres</b></font></h5>
        <font size="3"><h4><i class="fa fa-exclamation-triangle" style="color:red"></i>Clique DUAS VEZES sobre o título do texto e, para visualizar os pareceres referentes a ele, clique posteriormente no botão &quot;Ver os pareceres&quot;</h4></font>


    <form action="<?php echo base_url('index.php/CCurador/verPareceresRespostas'); ?>" method="post">
    <!--<label for="inputUser" class="col-sm-3 control-label">id do texto:</label>--> 
    <input type="text" name="name_do_texto4" class="form-control" id="id_do_texto4" style = "display: none">

    <center>
      <div class="row" style="= overflow-x:auto; width:100%">
        <table class="table" id = "table2">
          <thead>
            <th colspan="2">
              <div class="col-sm-12 form-group" style="text-align: center">
                <label for="inputUser" class="col-sm-4 control-label"><font size ="4"> Nome do submissor:</font></label>
                <input type="text" name="nome2" class="col-sm-4 " id="id_nome2"   style="margin-right: 90px">
                <a href="<?php echo base_url('index.php/CCurador/verPareceresRespostas'); ?>"><button type="submit" class="col-sm-3 btn btn-basic btn-md">Ver os pareceres</button></a>
    
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
                echo '</tr>';
              } 
            }?>
          </tbody>

        </table>
      </div><!-- End-row -->
    </center>

    </form><!--fim do form para pegar o id do texto para consultar parecer/respostas-->

  </div><!-- End-container -->

</div><!-- End-panel-body -->

</html><!-- End-html -->