<?php
  function navbar($pageAtual,$logado){
    ?>
    <nav class="row navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Horários Senai</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="nav navbar-nav">
            <li <?php if($pageAtual == "home") echo ' class="active"';?>><a href="/master/">Home</a></li>
            <li><a href="/horarios/">Horários</a></li>
            <li class="dropdown<?php if($pageAtual == "cadastros") echo ' active'; ?>"<?php if(!$logado) echo ' style="display: none;"';?>>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
              <ul class="dropdown-menu" id="dropdown">
                <li<?php if($_SESSION['login'] != "admin") echo 'style=" display: none;"'; ?>><a href="/master/cadastroHorarios.php">Cadastro de Horários</a></li>
                <li<?php if($_SESSION['login'] != "admin") echo 'style=" display: none;"'; ?> role="separator" class="divider"></li>
                <li><a href="/master/cadastroProfessores.php">Cadastro de Professores</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/master/cadastroSalas.php">Cadastro de Salas</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/master/cadastroTipos.php">Cadastro de Tipos</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/master/cadastroTurmas.php">Cadastro de Turmas</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li<?php if($pageAtual == "settings") echo ' class="active"'; if(!$logado && $_SESSION['login'] != "admin") echo ' style=" display: none;"';?>><a href="/master/settings/">Settings</a></li>
            <li<?php if(!$logado) echo ' style=" display: none;"';?>><a href="/master/sse/sseUpdate.php">Update</a></li>
            <li<?php if(!$logado) echo ' style=" display: none;"';?>><a href="/master/php/logoutControl.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
<?php
  }
?>