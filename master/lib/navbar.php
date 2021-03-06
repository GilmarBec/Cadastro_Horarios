<?php
  function navbar($pageAtual,$logado){
?>
    <nav class="row navbar navbar-dark">
      <div class="container-fluid">
        <div class="navbar-header text-light">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/master/">Horários Senai</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
          <ul class="nav navbar-nav">
            <li>
              <a href="/horarios/">Horários</a>
            </li>

            <li class="dropdown<?php if($pageAtual == "cadastros") echo ' active'; ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
              <ul class="dropdown-menu" id="dropdown">
                <li>
                  <a href="/master/cadastroHorarios.php">Cadastro de Horários</a>
                </li>

                <li role="separator" class="divider"></li>

                <li>
                  <a href="/master/cadastroProfessores.php">Cadastro de Professores</a>
                </li>

                <li role="separator" class="divider"></li>

                <li>
                  <a href="/master/cadastroSalas.php">Cadastro de Salas</a>
                </li>

                <li role="separator" class="divider"></li>

                <li<?php if($_SESSION['login'] != "admin") echo ' style=" display: none;"'; ?>>
                  <a href="/master/cadastroTipos.php">Cadastro de Tipos</a>
                </li>

                <li<?php if($_SESSION['login'] != "admin") echo ' style=" display: none;"'; ?> role="separator" class="divider"></li>

                <li>
                  <a href="/master/cadastroTurmas.php">Cadastro de Turmas</a>
                </li>
              </ul>
            </li>

            <li<?php if($pageAtual == "importar") echo ' class="active"'; ?>>
              <a href="/master/importar.php">Importações</a>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tema <span class="caret"></span></a>

              <ul class="dropdown-menu" id="dropdown">
                <li>
                  <a href="/master/settings/controller/tema.php?tema=1">Tema Dark</a>
                </li>

                <li role="separator" class="divider"></li>

                <li>
                  <a href="/master/settings/controller/tema.php?tema=2">Tema Light</a>
                </li>
              </ul>
            </li>

            <li<?php if($pageAtual == "settings") echo ' class="active"'; if($_SESSION['login'] != "admin") echo ' style=" display: none;"';?>>
              <a href="/master/settings/">Settings</a>
            </li>

            <li<?php if(!$logado) echo ' style=" display: none;"';?>>
              <a href="/master/sse/sseUpdate.php">Update</a>
            </li>

            <li<?php if(!$logado) echo ' style=" display: none;"';?>>
              <a href="/master/php/logoutControl.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<?php
  }
?>