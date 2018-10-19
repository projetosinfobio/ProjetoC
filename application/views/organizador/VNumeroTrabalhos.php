
<style>
table, th, td {
    border: 2px solid dimgrey;
}
th {
    height: 50px;
    background-color: #CD5C5C;
}

</style>


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
                <table class="table">
                    <thead>
                        <th colspan="2" ><center><font size = "5">Número de trabalhos</th>
                    </thead>
                    <thead>
                        <th><font size ="4">Eixo Temático</font></th>
                        <th><font size ="4">Número de trabalhos submetidos</font></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><font size ="3">Eixo 1 - Saúde Mental e Cultura:</font></td>
                            <td><center><font size ="3"><?php echo $i = $this->MOrganizador->consultaNumeroTrabalhosPorEixo(1)?></font></center></td>
                        </tr>
                        <tr>
                            <td><font size ="3">Eixo 2 - Participação Social em uma conjuntura antidemocrática:</td>
                            <td><center><font size ="3"><?php echo $ii = $this->MOrganizador->consultaNumeroTrabalhosPorEixo(2)?></font></center></td>
                        </tr>
                        <tr>
                            <td><font size ="3">Eixo 3: Gestão e redes de Atenção à Saúde:</td>
                            <td><center><font size ="3"><?php echo $iii = $this->MOrganizador->consultaNumeroTrabalhosPorEixo(3)?></font></center></td>
                        </tr>
                        <tr>
                            <td><font size ="3">Eixo 4: Território e sustentabilidade:</td>
                            <td><center><font size ="3"><?php echo $iv = $this->MOrganizador->consultaNumeroTrabalhosPorEixo(4)?></font></center></td>
                        </tr>
                        <tr>
                            <td><font size ="3">Eixo 5: Educação:</td>
                            <td><center><font size ="3"><?php echo $v = $this->MOrganizador->consultaNumeroTrabalhosPorEixo(5)?></font></center></td>
                        </tr>
                        <tr>
                            <td><font size ="3">Eixo 6: Saúde e Gênero:</font></td>
                            <td><center><font size ="3"><?php echo $vi = $this->MOrganizador->consultaNumeroTrabalhosPorEixo(6)?></font></center></td>
                        </tr>
                        <tr>
                            <td><center><b><font size ="4">TOTAL</font></b></center></td>
                            <td><center><?php echo $i+$ii+$iii+$iv+$v+$vi?></center></td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- End-class-row -->
        </center>

        </div><!-- End-container -->

      </div><!--end-panel -->

</html><!-- End-html -->