<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav"><!-- MENU ESQUERDO SUPERIOR -->
        <!-- MENU ESQUERDO SUPERIOR USUARIO-->
        <li>
            <a href="<?= $this->config->base_url('index.php/CSubmissor') ?>">
                <i class="fa fa-home"></i>  Home (Submissor)
            </a>
        </li>

        <li>
            <a href="<?= $this->config->base_url('index.php/CSubmissor/primeirasubmissao')?>">
                <i class="fa fa-file-text"></i>  Submissão</a>
        </li>
        
        <li>
            <a href="<?= $this->config->base_url('index.php/CSubmissor/pareceres')?>">
                <i class="fa fa-list-alt"></i>  Pareceres</a>
        </li>
        
        <li>
            <a href="<?= $this->config->base_url('index.php/CSubmissor/resultados')?>">
                <i class="fa fa-file-pdf-o"></i>  Resultados</a>
        </li>

        <li>
            <a href="<?= $this->config->base_url('index.php/COrganizador') ?>">
                <i class="fa fa-home"></i>  Home (Organizador)
            </a>
        </li>

        <li>
            <a href="<?= $this->config->base_url('index.php/CCurador') ?>">
                <i class="fa fa-home"></i>  Home (Curador)
            </a>
        </li>

        <li>
            <a href="<?= $this->config->base_url('index.php/CTeste')?>">
                <i class="fa fa-file-text"></i>  TESTE (pfvr nao mexe)</a>
        </li>

        <li>
          <a href="<?= $this->config->base_url('index.php/CLogin/sair') ?>"> SAIR
              <i class="fa  fa-sign-out"></i>
          </a>
        </li>

        </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"> <b>MENU</b></i>
            </button>
        </div>
</div>

</nav>
</header>