<?php
  include_once('../lib/head.php');
  
  if(ISSET($_GET['r'])) {
    $r = $_GET['r'];

    if($r == 1) {
      echo '<script>alert("Senhas devem ser iguais!");</script>';
    }
  }
?>

<!DOCTYPE html>

<head>
  <?php ativarHead(); ?>
</head>

<body>
  <div class="container_fluid container-iframe">
    <div class="row">
      <div class="box box-info box-iframe">
        <div class="box-header with-border">
          <h3 class="box-title"><span class="label label-info">Trocar senha de Administrador</span></h3>
        </div>
        <form class="form-horizontal" autocomplete="disabled" action="/master/settings/controller/updateAdminController.php" method="POST">
          <div class="box-body">
            <div class="form-group">
              <label for="inputSenha" class="col-sm-2 control-label">Senha</label>

              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputSenha" name="senha" placeholder="Senha">
              </div>
            </div>
            <div class="form-group">
              <label for="inputConfirmSenha" class="col-sm-2 control-label">Confirmar Senha</label>

              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputConfirmSenha" name="confirmSenha" placeholder="Confirmar Senha">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="button" onclick="window.location='/master/settings/selectUsers.php';" class="btn btn-danger">Cancel</button>
            <button type="submit" class="btn btn-info pull-right">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>document.getElementById('inputSenha').focus();</script>
</body>

</html>