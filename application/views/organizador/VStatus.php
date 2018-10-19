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



</script>


      <div class="panel-body">

        <div class="container" style="background-color: #F5F5F5">

        <div class="panel-heading">
            <!--
            <h3>
                <center>
                    <b>Número de Trabalhos</b>
                </center>
            </h3>
            -->
        </div>
        <center>
            <div class="row" style="overflow-x:auto; width:100%">
                <table class="table" id = "table">
                    <thead>
                        <th colspan="6" ><center><font size = "5">Status dos trabalhos
                        <br>Número total de trabalhos = <?php echo $this->MOrganizador->consultaNumeroTotalDeTrabalhos()?></th>
                    </thead>
                    <thead>
                        <th><font size ="4">Nome do usuário</font></th>
                        <th><font size ="4">E-mail</font></th>
                        <th><font size ="4">Título</font></th>
                        <th><font size ="4">Tipo</font></th>
                        <th><font size ="4">Eixo</font></th>
                        <th><font size ="4">Status</font></th>
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
                    echo '<td style = "display: none">'.$record->id_usuario.'</td>';//0
                    echo '<td>'.$record->nome.'</td>';//1
                    echo '<td>'.$record->email.'</td>';//2
                    echo '<td>'.$record->titulo.'</td>'; //3
                    echo '<td style = "display: none">'.$record->mensagem.'</td>';//4
                    echo '<td style = "display: none">'.$record->id_texto.'</td>';//5
                    echo '<td>'.$tipo_texto.'</td>';//6
                    echo '<td>'.$eixo_texto.'</td>';//7  nao coloquei record->eixo para nao mostrar so o numero. o switch case acima converteu os numeros em palavras
                    echo '<td>'.$status_texto.'</td>';//8
                    //echo '<td style = "display: none">'.$record->cpf.'</td>';//9
                echo '</tr>';
                //$cont++;
            } ?>
                        
                    </tbody>
                </table>
            </div><!-- End-class-row -->
        </center>

        <form action="<?php echo base_url('index.php/COrganizador/editar_titulo_e_texto'); ?>" method="post">

            <!-- <label for="inputUser" class="form-horizontal"><font size="3">id do texto:</font></label>  -->
            <input type="text" name="nome_id_do_texto" class="form-control" id="id_do_texto" style="display: none;"> 

            <!-- <label for="inputUser" class="form-horizontal"><font size="3">id submissor:</font></label>  -->
            <input type="text" name="nome_do_submissor" class="form-control" id="id_do_submissor" style="display: none;">

            <label for="inputUser" class="form-horizontal"><font size="3">Nome:</font></label> 
            <input type="text" name="nome" class="form-control" id="id_nome">

            <label for="inputUser" class="form-horizontal"><font size="3">E-mail:</font></label> 
            <input type="text" name="nome_do_email" class="form-control" id="id_do_email"><br><br>

            <label for="inputUser" class="form-horizontal"><font size="3">Título:</font></label> 
            <input type="text" name="nome_id_titulo" class="form-control" id="id_titulo"><br>

            <label for="inputUser" class="form-horizontal"><font size="3">Texto:</font></label> 
            <textarea rows="15" name="nome_mensagem" class="form-control" id="id_mensagem" maxlength="4000">
            </textarea>

            <center>
              <a href="<?php echo base_url('index.php/COrganizador/editar_titulo_e_texto'); ?>">
              <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#ModalEditar"><b>Editar o título e o texto</b></button></a>
            </center><br>

        </form><!--end form editar texto-->

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

                    document.getElementById("id_do_submissor").value = this.cells[0].innerHTML;

                    document.getElementById("id_nome").value = this.cells[1].innerHTML;

                    document.getElementById("id_do_email").value = this.cells[2].innerHTML;

                    document.getElementById("id_titulo").value = this.cells[3].innerHTML;
 
                    document.getElementById("id_mensagem").value = this.cells[4].innerHTML;
                    CKEDITOR.replace('nome_mensagem'); 

                    document.getElementById("id_do_texto").value = this.cells[5].innerHTML;                   
                };
            }          
        </script>

        </div><!-- End-container -->

      </div><!--end-panel -->

</html><!-- End-html -->