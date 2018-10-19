<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>15° Congresso de Associação Paulista de Saúde Pública.</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('dist/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

      <ul class="nav nav-tabs">
          <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url('index.php/CHome/index'); ?>">15° Congresso de Associação Paulista de Saúde Pública</a>
        </div>
      </ul>
      <div class="container">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
                  
                <div class="page-header">
                  <h2>Área de Cadastro (exclusivo para curadores ou organizadores)</h2>
                </div>
                  
                <?php if(isset($alerta)){ ?>
                    <div class="alert alert-<?php echo $alerta['class']; ?>">
                        <?php echo $alerta['mensagem']; ?>
                    </div>
                <?php }?>

                <?php if(isset($mensagens)) echo $mensagens; ?>   
                <form action="<?php echo base_url('index.php/CHome/cadastrar_usuario3'); ?>" method="post">
                  <input type="hidden" name="captcha">
                  

                  <div class="form-group">
                    <label for="usuario">Digite seu nome completo:</label>
                    <!--<input name="nome" class="form-control" id="nome_usuario" placeholder="Nome completo" 
                    required > -->
                    <?php
                    $atributo = array('placeholder' => 'Digite aqui seu nome...');                
                    ?>
                    <br><?php echo form_input('nome', set_value('nome'), $atributo)?> 
                  </div>
                  <div class="form-group">
                    <label for="usuario">Digite seu CPF:</label>
                    <!-- <input name="cpf" class="form-control" id="cpf_usuario" placeholder="CPF (apenas os números, sem os pontos e sem o traço)"
                    required> -->
                    <?php
                    $atributo = array('placeholder' => 'Digite aqui seu CPF...');                
                    ?>
                    <br><?php echo form_input('cpf', set_value('cpf'), $atributo)?> 
                  </div>
                  <div class="form-group">
                    <label for="usuario">Digite seu e-mail:</label>
                    <!-- <input name="email" class="form-control" id="email_usuario" placeholder="E-mail"
                    required> -->
                    <?php
                    $atributo = array('placeholder' => 'Digite aqui seu e-mail...');                
                    ?>
                    <br><?php echo form_input('email', set_value('email'), $atributo)?> 
                  </div>
                  <div class="form-group">
                    <label for="usuario">Digite sua senha:</label>
                    <!-- <input type="password" name="senha" class="form-control" id="senha_usuario" placeholder="senha"
                    required> -->
                    <?php
                    $atributo = array('placeholder' => 'Digite aqui sua senha...');                
                    ?>
                    <br><?php echo form_password('senha', set_value('senha'), $atributo)?> 
                  </div>
                  <div class="form-group">
                    <label for="usuario">Selecione uma das opções abaixo. Você é:</label>
                    <?php
                      $configuracaoRadioButtonCur = array(
                          'name'          => 'tipo_usuario',
                          'id'            => 'eh_curador',
                          'value'         => 'curador',
                          'checked'       => FALSE
                      );
                      $configuracaoRadioButtonOrg = array(
                          'name'          => 'tipo_usuario',
                          'id'            => 'eh_curador',
                          'value'         => 'organizador',
                          'checked'       => FALSE
                      );
                    ?>

                    <br><?php echo form_radio($configuracaoRadioButtonCur)?> Curador.
                    <br><?php echo form_radio($configuracaoRadioButtonOrg)?> Organizador (Cúpula Científica).
                  </div>

                  <div class="form-group">
                    <label for="usuario">Selecione o eixo no qual você pertence:</label>
                    
                    <select name="eixo" class="form-group" id="eixo"> 
                      <option>--Selecione o seu eixo--</option> 
                      <option value="1">Eixo 1: Saúde Mental e cultura.</option> 
                      <option value="2">Eixo 2: Participação Social em uma conjuntura antidemocrática.</option> 
                      <option value="3">Eixo 3: Gestão e redes de Atenção à Saúde.</option> 
                      <option value="4">Eixo 4: Território e sustentabilidade.</option> 
                      <option value="5">Eixo 5: Educação.</option> 
                      <option value="6">Eixo 6: Saúde e Gênero.</option> 
                    </select> 
                    
                  </div>

                  <button type="submit" name="cadastrar" value="entrar" class="btn btn-danger pull-right">Cadastre-se</button>
                
                </form>

                <div class="form-group">
                      <a href="<?php echo base_url('index.php/CHome/index'); ?>">
                      <button type="submit" name="recuperar" class="btn btn-danger pull-left" id="_recuperar" placeholder="recuperar">Voltar</button></a>
                </div>

                <br><br><br>

              </div>
            </div>
      </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('dist/js/bootstrap.min.js') ?>"></script>
  </body>
</html>