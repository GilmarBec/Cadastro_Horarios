<?php
  include_once("../lib/session.php");
  
  include_once("../lib/head.php");
  include_once("../lib/navbar.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
	<?php ativarHead(); ?>
</head>
<body style="overflow-y: hidden;">
	<div class="container">
		<?php navbar("settings",$logado); ?>

		<div class="row">
			<div class="box box-info box-full">
				<div class="box-header with-border">
					<div class="col-md-7">
						<h3 class="box-title"><label class="btn btn-info">Settings</label></h3>
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
					<div style="margin-left: 5px; margin-right: 5px;" class="row embed-responsive embed-responsive-16by9">
			      <iframe class="embed-responsive-item" id="iframeSettings" name="iframeSettings" src="/master/settings/selectUsers.php"></iframe>
			    </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>