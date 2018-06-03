<?php
	include_once('../class/Unidades.php');

	$Unidades = new Unidades();

	if(ISSET($_POST['unidade']) and $_POST['unidade'] != "") {
		try{
			$Unidades->insert($_POST['unidade']);

			Header('Location: ../');
		} catch(PDOException $e) {
			echo 'Erro: ' . $e;
		}
	} else if(ISSET($_POST['unidade']) and $_POST['unidade'] == "") {
		Header('Location: ../');
	} else {
?>

<!DOCTYPE html>
<html>
<head>
	<title>Criação de Unidade</title>
  <script type="text/javascript" src="../dist/bootstrap/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../dist/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/root.css">
</head>
<body ng-app="spd">
	<div class="container" ng-controller="IndexCtrl">
		<div class="row">
			<div class="offset-sm-2 col-sm-8 col-12">
				<div class="card p-5 t-10 bg-dark text-light">
					<div class="card-head">
						<h1 class="text-center">Digite o nome da Unidade</h1>
					</div>

					<div class="card-body">
						<form method="post" action="">
							<input class="form-control" type="text" name="unidade">
							<div class="row">
								<div class="col-6">
									<a class="btn btn-danger btn-block" href="../">Cancelar</a>
								</div>
								<div class="col-6">
									<button type="submit" class="btn btn-success btn-block">Confirmar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php
	}
?>
