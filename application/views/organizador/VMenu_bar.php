<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav"><!-- MENU ESQUERDO SUPERIOR -->
        <!-- MENU ESQUERDO SUPERIOR USUARIO-->
        <li>
            <a href="<?= $this->config->base_url('index.php/COrganizador') ?>">
                <i class="fa fa-home"></i>  Home (Organizador)
            </a>
        </li>

        <li>
            <a href="<?= $this->config->base_url('index.php/COrganizador/numero_trabalhos') ?>">
                <i class="fa fa-list"></i>  Número de trabalhos submetidos
            </a>
        </li>

        <li>
            <a href="<?= $this->config->base_url('index.php/COrganizador/status') ?>">
                <i class="fa fa-list"></i>  Status dos textos
            </a>
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