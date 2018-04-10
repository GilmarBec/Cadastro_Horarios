<?php
  include_once('../lib/head.php');

  if(ISSET($_GET['r'])) {
    $r = $_GET['r'];
    if($r == 1) {
      echo '<script>alert("Senha de admin Incorreta!");</script>';
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
          <h3 class="box-title"><span class="label label-info">Limpar Horários</span></h3>
        </div>
        <form class="form-horizontal" autocomplete="disabled" action="/master/settings/controller/clearControl.php" method="POST">
          <div class="box-body">
          	<center><h1>Para confirmar, digite a senha de administrador:</h1></center>
            <div class="form-group">
              <label for="inputSenha" class="col-sm-1 control-label">Senha</label>

              <div class="col-sm-11">
                <input type="password" class="form-control" id="inputSenha" name="senha" placeholder="Senha">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="button" onclick="window.location='/master/settings/selectUsers.php';" class="btn btn-warning">Cancel</button>
            <button type="submit" class="btn btn-danger pull-right">Limpar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>