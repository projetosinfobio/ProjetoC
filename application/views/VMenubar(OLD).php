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