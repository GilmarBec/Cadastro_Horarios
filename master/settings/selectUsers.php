<?php
  include_once("../lib/head.php");

	include_once("../lib/conexao.php");
  include_once("../dao/usuarioDao.php");

  $conexao = new Conexao();
  $usuarioDao = new UsuarioDao($conexao);

  if(ISSET($_GET['erro'])) {
    echo '<script>alert("Erro: '.$_GET["erro"].'");</script>';
  }

  $result = $usuarioDao->select();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
	<?php ativarHead(); ?>
</head>
<body>
	<div class="container_fluid container-iframe">
    <div class="row">
      <div class="box box-info box-iframe">
        <div class="box-header with-border">
          <div class="col-md-7">
						<h3 class="box-title"><label class="btn btn-primary">Settings</label></h3>
					</div>
					<div class="col-md-1">
						<h3 class="box-title">
							<button class="btn btn-success">Usuários</button>
						</h3>
					</div>
					<div class="col-md-2">
						<h3 class="box-title">
							<button class="btn btn-warning">Trocar Senha de Admin</button>
						</h3>
					</div>
					<div class="col-md-2">
						<h3 class="box-title">
							<button class="btn btn-danger">Limpar Horários</button>
						</h3>
					</div>
        </div>
        <div class="box-body">
        	<div class="col-md-12">
          		<button type="button" style="margin-bottom: 10px;" onclick="window.location='/master/cadastros/professores/insert.php';" class="btn btn-info">
          			Cadastrar Usuário
          		</button>
          </div>
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12"  style="height: 70vh; overflow-y: scroll;">
                <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">
                      <th class="col-md-10 col-xs-8">Nome</th>
                      <th class="col-md-10 col-xs-8">Login</th>
                      <th class="col-md-1 col-xs-2"></th>
                      <th class="col-md-1 col-xs-2"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if($result != false) {
                        foreach($result as $row) {
                          echo '<tr role="row">';
                          echo '  <td>'.$row['nome'].'</td>';
                          echo '  <td>'.$row['login'].'</td>';
                          echo '  <td><center><a href="/master/settings/users/update.php?id='.$row['id'].'" class="btn btn-warning">Editar</a></center></td>';
                          echo '  <td><center><a href="/master/settings/users/deleteControl.php?id='.$row['id'].'" class="btn btn-danger">Apagar</a></center></td>';
                          echo '</tr>';
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>