<!DOCTYPE html>

<style>
table, th, td {
    border: 2px solid dimgrey;
}
th {
    height: 75px;
    background-color: #CD5C5C;
}

tr:hover{
    background-color: #C0C0C0;
}

.highli {
    background-color: #C0C0C0;
}

/*
.linhaNaoSelecionada{
    background-color: white;
}
.linhaSelecionada{
    background-color: indianred;
}*/

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
    <div class="container">
        <div class="panel-heading">
            <h3>
                <center>
                    <i class="fa fa-user"></i> BEM-VINDO <?php echo $this->session->userdata('nome') ?>
                </center>
            </h3>
        </div>
        
        <h5><font size="5"><b>Para encaminhar um texto para um curador, clique DUAS VEZES em um dos textos, clicar no curador e clicar no botão "Encaminhar"</b></font></h5>

        <center>
            <font size="4">(Em caso de dúvidas, mande um e-mail para 15congressoapsp.informatica@gmail.com)</font>
        </center>

        <center>
        <div class="row" style="= overflow-x:auto; width:100%">
            
            <table id ="table" class="table">
                <thead>
                        <th colspan="5" ><center><font size="5">Número de trabalhos inscritos no eixo <?php echo $this->MOrganizador->consultaEixoOrganizador($this->session->userdata('id'))?> = 
                        <?php echo $this->MOrganizador->consultaNumeroTrabalhosPorEixo( 
                        $this->MOrganizador->consultaEixoOrganizador($this->session->userdata('id')) ); ?></center></th>
                </thead>
                <thead>
                    <th><font size="3">Nome do Autor</font></th>
                    <th><font size="3">E-mail</font></th>
                    <th><font size="3">Título</font></th>
                    <th><font size="3">Status</font></th>
                    <th><font size="3">Tipo</font></th>
                </thead>
            <tbody>

            <?php 
            //$cont = 0;
            foreach($records as $record){ 

                //$datetime = explode(" ",$record->datetime);
                //$date = explode("-",$datetime[0]);
                
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

                switch ($record->fk_id_eixo) {
                    case 1:
                        $eixo_texto = 'Eixo 1: Saúde Mental e cultura';
                        break;
                    case 2:
                        $eixo_texto = 'Eixo 2: Participação Social em uma conjuntura antidemocrática';
                        break;
                    case 3:
                        $eixo_texto = 'Eixo 3: Gestão e redes de Atenção à Saúde';
                        break;
                    case 4:
                        $eixo_texto = 'Eixo 4: Território e sustentabilidade';
                        break;
                    case 5:
                        $eixo_texto = 'Eixo 5: Educação';
                        break;
                    case 6:
                        $eixo_texto = 'Eixo 6: Saúde e Gênero';
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
                
                //$idLinha = 'linha'.$cont;
                //echo '<tr id='.$idLinha.' class="linhaNaoSelecionada" onclick="mudacor('.$idLinha.')">';
                echo '<tr ondblclick="highlight(this,\'highli\');">';
                        echo '<td style = "display: none">'.$record->id_usuario.'</td>';//1
                        echo '<td>'.$record->nome.'</td>';//1
                        echo '<td>'.$record->email.'</td>';//2
                        echo '<td>'.$record->titulo.'</td>'; //3
                        echo '<td>'.$status_texto.'</td>';//4
                        echo '<td style = "display: none">'.$record->mensagem.'</td>';//5   
                        echo '<td style = "display: none">'.$eixo_texto.'</td>';//6  nao coloquei record->eixo para nao mostrar so o numero. o switch case acima converteu os numeros em palavras
                        echo '<td style = "display: none">'.$record->fk_id_curador.'</td>';//7 
                        echo '<td style = "display: none">'.$record->id_texto.'</td>'; //8

                        echo '<td style = "display: none">'.$record->cpf.'</td>';//9

                        echo '<td>'.$tipo_texto.'</td>';//10
                            
                echo '</tr>';
                //$cont++;
            } ?>
              

            </tbody>
            </table>

        </div><!--end div table-->
        </center>
<!--
    <script type="text/javascript">

    function mudacor(linha)
        {
            var classButton = document.getElementById(linha).className; //classButton obtém a classe que que o btn (id de algum botão) está utilizando.
            var buttonInactive = "linhaNaoSelecionada"; //Classe utilizada quando o botão NÃO ESTÁ selecionado.
            var buttonActive = "linhaSelecionada"; //Classe utilizada quando o botão ESTÁ selecionado.

            // Verifica se o botão já está selecionado, se tiver ele altera o estilo do botao que é utilizado quando o botão não está selecionado.
            if ( classButton.localeCompare(buttonActive) == 0 ){ //Compara duas strings.
                document.getElementById(linha).className = "linhaNaoSelecionada";
            }
            else{ //Dá certeza de que apenas um estado do botão será exibido.
                // Verifica se o botão não está selecionado, se não tiver ele altera o estilo do botao que é utilizado quando o botão está selecionado.
                if (classButton.localeCompare(buttonInactive) == 0 ){ //Compara duas strings.
                    document.getElementById(linha).className = "linhaSelecionada";
                }
            }
    
</script> -->


        <div class="col-sm-12 form-group"> 

        <form action="<?php echo base_url('index.php/COrganizador/alterar_eixo'); ?>" method="post">

        <label for="inputUser" class="col-sm-3 control-label">Nome:</label> 
        <input type="text" name="name_submissor" class="form-control" id="id_nome"><br> 

        <label for="inputUser" class="col-sm-3 control-label">E-mail:</label> 
        <input type="text" name="lname" class="form-control" id="id_email"><br>

        <label for="inputUser" class="col-sm-3 control-label">Tipo de texto:</label> 
        <input type="text" name="name_tipo_texto" class="form-control" id="id_tipo_texto"><br>

        <label for="inputUser" class="col-sm-3 control-label">Título:</label> 
        <input type="text" name="name_id_titulo" class="form-control" id="id_titulo"><br>

        <label for="inputUser" class="form-horizontal"><font size="3">Texto:</font></label> 
        <textarea rows="15" name="texto" class="form-control" id="id_o_texto" maxlength="4000">
        </textarea> 


        <label for="inputUser" class="col-sm-3 control-label">Status:</label> 
        <input type="text" name="fname" class="form-control" id="id_status"><br> 

        <label for="inputUser" class="col-sm-3 control-label">Eixo:</label> 
        <input type="text" name="fname" class="form-control" id="id_eixo">

        <!-- <label for="inputUser" class="col-sm-3 control-label">ID do usuario:</label>   -->
        <input type="text" name="name_id_submissor" class="form-control" id="id_submissor" style = "display: none" >

        <!-- <label for="inputUser" class="col-sm-3 control-label">iD do texto:</label> -->
        <input type="text" name="name_id_do_texto" class="form-control" id="id_do_texto" style = "display: none">
        
            <br><font size="4"><h4><b> <i class="fa fa-exclamation-triangle" style="color:red"></i> Caso achar necessário mudar o eixo do texto, selecione um texto, escolhe o novo eixo e clique no botão "Alterar o eixo"</b></h4></font>

            <select name="name_novoeixo" class=" col-sm-6  form-control" id="id_eixo"> 
            <option value=" ">--Escolhe o eixo novo--</option> 
            <option value="1">Eixo 1: Saúde Mental e cultura.</option> 
            <option value="2">Eixo 2: Participação Social em uma conjuntura antidemocrática.</option> 
            <option value="3">Eixo 3: Gestão e redes de Atenção à Saúde.</option> 
            <option value="4">Eixo 4: Território e sustentabilidade.</option> 
            <option value="5">Eixo 5: Educação.</option> 
            <option value="6">Eixo 6: Saúde e Gênero.</option> 
            </select>        

            <br>
            <a href="<?php echo base_url('index.php/COrganizador/alterar_eixo'); ?>">
            <button type="submit" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#myModal"><font size="3"><b>Alterar o eixo</b></font></button></a>

            <!-- Modal para alterar eixo-->
            <div class="modal fade" id="myModal" role="dialog"><!--comeco POPUP-->
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h3 class="modal-title">Mudança de eixo</h3>
                    </div>
                    <div class="modal-body">
                      <p>O eixo do texto foi alterado.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  
                </div>
            </div><!--fim POPUP-->
        </form> <!--end form-->

        <form action="<?php echo base_url('index.php/COrganizador/visualizar_comprovante'); ?>" method="post">

            <br><font size="4"><h4><b><i class="fa fa-exclamation-triangle" style="color:red"></i> Caso achar necessário visualizar o comprovante de pagamento, selecione um texto e clique no botão "Visualizar o comprovante de pagamento"</b></h4></font>

            <!-- <label for="inputUser" class="col-sm-3 control-label">cpf:</label>   -->
            <input type="text" name="name_id_cpf" class="form-control" id="id_cpf" style = "display: none"> 

            <!-- <label for="inputUser" class="col-sm-3 control-label">Título:</label>  -->
            <input type="text" name="name_id_titulo" class="form-control" id="id_titulo2" style = "display: none">

            <!-- <label for="inputUser" class="col-sm-3 control-label">id_submissor:</label>    -->
            <input type="text" name="name_id_submissor2" class="form-control" id="id_submissor2" style = "display: none"> 

            <a href="<?php echo base_url('index.php/COrganizador/visualizar_comprovante'); ?>">
            <button type="submit" class="btn btn-primary btn-sm btn-block"><font size="3"><b>Visualizar o comprovante de pagamento</b></font></button></a><br><br>

        </form> <!--end form-->
        
      
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
                    document.getElementById("id_submissor").value = this.cells[0].innerHTML;
                    document.getElementById("id_submissor2").value = this.cells[0].innerHTML;
                    document.getElementById("id_nome").value = this.cells[1].innerHTML;
                    document.getElementById("id_email").value = this.cells[2].innerHTML;
                    document.getElementById("id_titulo").value = this.cells[3].innerHTML;
                    document.getElementById("id_status").value = this.cells[4].innerHTML;
                    document.getElementById("id_o_texto").value = this.cells[5].innerHTML;
                    CKEDITOR.replace('texto');
                    document.getElementById("id_eixo").value = this.cells[6].innerHTML;
                    document.getElementById("id_do_texto").value = this.cells[8].innerHTML;
                    document.getElementById("id_do_texto2").value = this.cells[8].innerHTML;
                    document.getElementById("id_cpf").value = this.cells[9].innerHTML;
                    document.getElementById("id_titulo2").value = this.cells[3].innerHTML;

                    document.getElementById("id_tipo_texto").value = this.cells[10].innerHTML;
                };
            }          
        </script>  
          

        <h5><font size="5"><b>Após Selecionar um dos textos, clique DUAS VEZES para selecionar um curador e clique no botão "Encaminhar" para encaminhar o texto para o curador específico</b></font></h5>

        <center>
        <div class="row" style="= overflow-x:auto; width:100%">
                
            <table class="table" id="table2">
                    <thead>
                            <th><font size="3">Nome do Curador</font></th>
                            <th><font size="3">Número de textos encaminhados para o curador</font></th>
                    </thead>
                    <tbody>
                    <!--O if bizarro a seguir é para não mostrar os curadores inexistentes (isolei os iDs)-->
                        <?php foreach($records2 as $record){ 
                            if($record->id_usuario == 3 || 
                                $record->id_usuario == 4 || 
                                $record->id_usuario == 6 || 
                                $record->id_usuario == 7 || 
                                $record->id_usuario == 8 || 
                                $record->id_usuario == 11 ||
                                $record->id_usuario == 1){
                                continue;
                            }

                            //$datetime = explode(" ",$record->datetime);
                            //$date = explode("-",$datetime[0]);
                            echo '<tr ondblclick="highlight2(this,\'highli\');">';
                                    echo '<td style = "display: none">'.$record->id_usuario.'</td>';
                                    echo '<td>'.$record->nome.'</td>';
                                    echo '<td>'.$this->MOrganizador->consultaNumeroTrabalhosPorCurador($record->id_usuario).'</td>';
                                    echo '<td style = "display: none">'.$record->email.'</td>';
                            echo '</tr>';
                        } ?>
                    </tbody>
            </table>

        </div><!-- End-row -->
        </center>

            <form action="<?php echo base_url('index.php/COrganizador/encaminhar_curador'); ?>" method="post">
                <div class="col-sm-12 form-group"> 
                    <!-- <label for="inputUser" class="col-sm-3 control-label">ID do texto</label> -->
                    <input type="text" name="name_id_do_texto" class="form-control" id="id_do_texto2" style = "display: none" >

                    <!-- <label for="inputUser" class="col-sm-3 control-label">ID do novo Curador:</label> -->
                    <input type="text" name="name_id_do_novo_curador" class="form-control" id="id_novo_curador" style = "display: none" >

                    <!-- <label for="inputUser" class="col-sm-3 control-label">Nome:</label>  -->
                    <input type="text" name="fname" class="form-control" id="id_nomeCurador" style = "display: none"> 
                    
                    <!--<label for="inputUser" class="col-sm-3 control-label">Quantidade de textos recebidos:</label>--> 
                    <input type="text" name="lname" class="form-control" id="id_quantCurador" style = "display: none">

                    <!--<label for="inputUser" class="col-sm-3 control-label">email curador:</label>-->
                    <input type="text" name="name_do_email_curador" class="form-control" id="id_do_email_curador" style = "display: none">
                </div> <!--fim div -->

            

                <script> 
                    // get selected row
                    // display selected row data in text input
                    
                    var table2 = document.getElementById("table2"),rIndex;
                    
                    for(var i = 1; i < table2.rows.length; i++)
                    {
                        table2.rows[i].onclick = function()
                        {
                            rIndex = this.rowIndex;
                            //console.log(rIndex);
                            document.getElementById("id_novo_curador").value = this.cells[0].innerHTML;
                            document.getElementById("id_nomeCurador").value = this.cells[1].innerHTML;
                            document.getElementById("id_quantCurador").value = this.cells[2].innerHTML;
                            document.getElementById("id_do_email_curador").value = this.cells[3].innerHTML;
                            
                        };
                    }
                    
                </script>  
                </div><!-- End-style -->

        

    
        <div class="col-sm-12">
                    <center>
                        <a href="<?php echo base_url('index.php/COrganizador/encaminhar_curador'); ?>">
                        <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#myModal2"><font size="5"><b>Encaminhar para Curador</b></font></button></a>
                    </center>   
        </div><!-- form-group -->
        <br><br><br>

        </form><!--end form-->


         <!-- Modal -->
            <div class="modal fade" id="myModal2" role="dialog"><!--comeco POPUP-->
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h3 class="modal-title">Texto encaminhado</h3>
                    </div>
                    <div class="modal-body">
                      <p>O texto foi encaminhado para o Curador.</p>
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