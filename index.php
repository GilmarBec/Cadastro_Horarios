<?php
	$con = mysql_connect("localhost", "root", "");

	$db = mysql_select_db("spd");

	if(!$db) {
		if(mysql_errno () == 1049) Header('Location: view/acesso.html');
	}

	function limpar($string){
    return strtr(utf8_decode($string),utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ '),'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy_');
	}

	session_start();
	if(ISSET($_SESSION['unidade'])) Header('Location: master/');

	if(ISSET($_POST['unidade'])) {
		$_SESSION['unidade'] = 'spd_' . limpar($_POST['unidade']);

		Header('Location: master/');
	} else {
?>

<!DOCTYPE html>
<html>
<head>
	<title>Seleção de Unidade</title>

	<!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- jQuery -->
	<script type="text/javascript" src="dist/jquery/jquery-3.3.1.min.js"></script>

	<!-- AngularJS -->
	<script type="text/javascript" src="dist/angularjs/angular.min.js"></script>
	<script type="text/javascript" src="dist/angularjs/angular-route.min.js"></script>

	<!-- Bootstrap -->
	<script type="text/javascript" src="dist/bootstrap/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">

	<!-- Scripts Angular -->
	<script type="text/javascript" src="dist/controller.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="dist/root.css">

</head>
<body ng-app="spd">
	<div class="container" ng-controller="IndexCtrl">
		<div class="row">
			<div class="card col-sm-8 offset-sm-2 col-12 p-5 t-10 bg-dark text-light">
				<div class="card-head">
					<h1 class="text-center">Selecione a Unidade</h1>
				</div>

				<div class="card-body py-5">
					<form method="post" action="">
						<select class="form-control" type="text" name="unidade">
							<option ng-repeat="unidade in unidades">{{unidade}}</option>
						</select>

						<div class="row">
							<div class="col-6">
								<a class="btn btn-primary btn-block" href="controller/insertUnidades.php">Criar nova</a>
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
</body>
</html>

<?php
	}
?>
