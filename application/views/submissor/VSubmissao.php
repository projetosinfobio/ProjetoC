<br><br> 
  <!--<?php 
    if($info['mensagem'] != null){ //REVER ISSO, TALVEZ ATÉ TIRAR.
      echo $info['mensagem'];  //REVER ISSO, TALVEZ ATÉ TIRAR.
    }
  ?> -->
<br>
<div class="col-sm-12 form-group"> 

  <!-- o atributo enctype do form deve ser preenchido com o valor multipart/form-data, para que ele seja capaz de receber arquivos e repassá-los ao servidor na requisição POST. -->
  <form action="<?php echo base_url('index.php/CSubmissor/submeterTextoeComprovante'); ?>" method="post" enctype="multipart/form-data">

      <label for="inputUser" class="col-sm-3 control-label">Digite o título do seu texto:</label> 
      <div class="col-sm-9"><textarea rows="4" name="titulo" class="form-control" 
        id="id_titulo" maxlength="800"></textarea> 
      </div> 

      <br><br><br> 

      <label for="inputUser" class="col-sm-3 control-label">Digite o seu texto:</label> 
      <div class="col-sm-9"><textarea rows="16" name="texto" class="form-control" 
        id="id_texto" maxlength="4000"></textarea> 
      </div> 

      <br><br><br> 

      </div> 
      <!-- form-group --> 

      <div class="col-sm-12 form-group"> 
        <label for="inputUser" class="col-sm-6 control-label">Selecione se o seu texto é um relato de pesquisa ou um relato de experiência:</label> 
        <div class="col-sm-6"> 
          <select name="tipo" class="form-control" id="id_tipo"> 
            <option>--Selecione o tipo de texto--</option> 
            <option value="P">Relato de Pesquisa</option> 
            <option value="E">Relato de Experiência</option> 
          </select> 
        </div> 

        <br><br><br> 

        <label for="inputUser" class="col-sm-6 control-label">Selecione o eixo no qual seu texto encaixa melhor:</label> 
        <div class="col-sm-6"> 
          <select name="eixo" class="form-control" id="id_eixo"> 
            <option>--Selecione o eixo de texto--</option> 
            <option value="1">Eixo 1: Saúde Mental e cultura.</option> 
            <option value="2">Eixo 2: Participação Social em uma conjuntura antidemocrática.</option> 
            <option value="3">Eixo 3: Gestão e redes de Atenção à Saúde.</option> 
            <option value="4">Eixo 4: Território e sustentabilidade.</option> 
            <option value="5">Eixo 5: Educação.</option> 
            <option value="6">Eixo 6: Saúde e Gênero.</option> 
          </select> 
        </div> 

        <br><br><br> 

        <label for="inputUser" class="col-sm-6 control-label">Comprovante de pagamento:</label> 
        <div class="col-sm-6"> 
          <input type="file" name="comprovante" class="form-control" id="id_comprovante" placeholder=""> 
          <br>
          OBS: Se você está enviando mais que um trabalho, deve anexar sempre o mesmo comprovante de pagamento a cada submissão.
        </div> 

      </div> 
      <!-- form-group --> 

      <div class="col-sm-12 form-group"> 
        <center> 
        <button type="submit" name="submeter" class="btn btn-primary">Enviar trabalho</button> 
        </center> 
      </div> 
      <!-- form-group --> 

  </form>

</div> 