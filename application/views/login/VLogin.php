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
                  <h2>Área de Login</h2>
                </div>
                  
                <?php if(isset($alerta)){ ?>
                    <div class="alert alert-<?php echo $alerta['class']; ?>">
                        <?php echo $alerta['mensagem']; ?>
                    </div>
                <?php }?>
                <?php if(isset($mensagens)) echo $mensagens; ?> 
                <form action="<?php echo base_url('index.php/CLogin/login_user'); ?>" method="post">
                  <input type="hidden" name="captcha">
                  <div class="form-group">
                    <label for="usuario">E-mail</label>
                    <input name="usuario" class="form-control" id="usuario" placeholder="Digite seu e-mail aqui..." required>
                  </div>
                  <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite sua senha aqui..." required>
                  </div>
                  <button type="submit" name="entrar" value="entrar" class="btn btn-danger pull-right">Entrar</button>
                </form>
                  <div class="form-group">
                      <a href="<?php echo base_url('index.php/CHome/carrega_vcadastrar'); ?>">
                      <button type="submit" name="cadastrar" class="btn btn-danger pull-left" id="_cadastrar" placeholder="cadastrar">Cadastrar</button></a>
                  </div>
                  <div class="form-group">
                      <br><br>
                      <a href="<?php echo base_url('index.php/CHome/carregaPaginaRecuperarSenha'); ?>">
                      <button type="submit" name="recuperar" class="btn btn-danger pull-left" id="_recuperar" placeholder="recuperar">Recuperar Senha</button></a>
                      <br><br>
                      <a href="<?php echo base_url('index.php/CHome/index'); ?>">
                      <button type="submit" name="recuperar" class="btn btn-danger pull-left" id="_recuperar" placeholder="recuperar">Voltar</button></a>
                  </div>
                 

                 
              </div>
            </div>
      </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('dist/js/bootstrap.min.js') ?>"></script>
  </body>
</html>