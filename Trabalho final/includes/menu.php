<nav class="navbar navbar-default menu">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><?php if (isset($_SESSION["nomeLogado"])) echo strtoupper($_SESSION["nomeLogado"]) ?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <?php if(isset($_SESSION["logado"]) && $_SESSION["permissao"] == 1): ?>

              <li class="cadastrarFuncionario"><a href="cadastraFuncionario">Cadastra Funcionário</a></li>
              <li class="cadastrarDepartamento"><a href="cadastrarDepartamento">Cadastra Departamento</a></li>
              <li class="visualizarFuncionario"><a href="exibeFuncionarios">Exibe Funcionário</a></li>
              <li class="visualizarDepartamento"><a href="exibeDepartamento">Exibe Departamento</a></li>
              <li class=""><a href="logout">Sair</a></li>
            <?php else: ?>
              <li class="visualizarFuncionario"><a href="exibeFuncionarios">Exibe Funcionário</a></li>
              <li class="visualizarDepartamento"><a href="exibeDepartamento">Exibe Departamento</a></li>
              <li class=""><a href="logout">Sair</a></li>
            <?php endif; ?>              
            </ul>            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>