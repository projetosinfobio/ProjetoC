<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

         <link rel="stylesheet" href="<?= $this->config->base_url('assets/css/bootstrap.min.css') ?>" />
         <link rel="stylesheet" href="<?= $this->config->base_url('assets/css/AdminLTE.min.css') ?>" />
         <link rel="stylesheet" href="<?= $this->config->base_url('assets/css/skins/_all-skins.min.css') ?>" />
                 <link rel="stylesheet" href="<?= $this->config->base_url('assets/css/style.css') ?>" />
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

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
    <body class="hold-transition skin-red-light layout-top-nav">
        <!-- Site wrapper -->
        <div class="wrapper">

          <header class="main-header">

            <nav class="navbar navbar-fixed-top" role="navigation">

            

              <div class="navbar-header" class = "navbar-brand"><!-- ADICIONAR LINK DO CONGRESSO-->
                <a href="<?= $this->config->base_url('index.php/') ?>"class="navbar-brand"><b>Congresso</b> APSP</a>
              </div>  

      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav"><!-- MENU ESQUERDO SUPERIOR -->
        <!-- MENU ESQUERDO SUPERIOR USUARIO-->
        <li>
            <a href="<?= $this->config->base_url('') ?>">
                <i class="fa fa-home"></i>  Homepage
            </a>
        </li>

        <li>
            <a href="https://15congressoapsp.org.br/inscricoes/informacoes-de-inscricao/">
                <i class="fa fa-edit"></i> Inscrições</a>
        </li>

        <li>
            <a href="<?= $this->config->base_url('index.php/CHome/carrega_vlogin')?>">
                <i class="fa fa-user"></i> Login </a>
        </li>
        
        <li>
            <a href="<?= $this->config->base_url('index.php/CHome/carrega_vcadastrar')?>">
                <i class="fa fa-user-plus"></i> Cadastro </a>
        </li>

        <li>
            <a href="<?= $this->config->base_url('index.php/CHome/normas')?>">
                <i class="  fa fa-list-alt"></i> Submissão</a>
        </li>

        <li>
            <a href="<?= $this->config->base_url('index.php/CHome/cronograma_congresso')?>">
                <i class="fa fa-calendar"></i> Cronograma </a>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="fa fa-file-text"></i> Sobre<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="<?= $this->config->base_url('index.php/CHome/informacoes_apsp')?>">
                    <i class="fa fa-info-circle"></i> Sobre APSP</a>
                </li>

                <li>
                    <a href="<?= $this->config->base_url('index.php/CHome/comissao_organizadora') ?>"><i class="fa fa-users"></i> Comissão Organizadora </a>
               </li>

                <li>
                    <a href="<?= $this->config->base_url('index.php/CHome/palestrantes') ?>"><i class="fa fa-users"></i> Palestrantes </a>
                </li>

                

            </ul>
        </li><!-- fim dropdown -->

        <li>
            <a href="<?= $this->config->base_url('index.php/CHome/informacoes_congressoapsp')?>">
            <i class="fa fa-info-circle"></i>  Informações Gerais</a>
        </li>

        <!--
        <li>
            <a href="<?= $this->config->base_url('index.php/CHome/informacoes_congressoapsp')?>">
                <i class="fa fa-info-circle"></i> Sobre o Congresso </a>
        </li>
        -->
        
        
        <li>
            <a href="<?= $this->config->base_url('index.php/CHome/contato')?>">
                <i class="fa fa-envelope"></i> Contato </a>
        </li>

        </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"> <b>MENU</b></i>
            </button>
        </div>
        
</div> 




</nav>
</header>
        
</div> 




</nav>
</header>




</nav>
</header>