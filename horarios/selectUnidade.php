<!DOCTYPE html>
<html>
<head>
	<title>Selecione a Unidade</title>
	<script type="text/javascript" src="../dist/jquery/jquery-3.3.1.min.js"></script>

  <link rel="stylesheet" type="text/css" href="../dist/bootstrap/bootstrap.min.css">
	<script type="text/javascript" src="../dist/bootstrap/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../dist/root.css">

  <!-- AngularJS -->
	<script type="text/javascript" src="../dist/angularjs/angular.min.js"></script>
	<script type="text/javascript" src="../dist/angularjs/angular-route.min.js"></script>

  <!-- Scripts Angular -->
	<script type="text/javascript" src="../dist/controller.js"></script>
</head>
<body ng-app="spd">
	<div class="container">
		<div class="row">
			<div class="col-12 t-5">
				<table class="table table-stripped" ng-controller="selectUnidadeCtrl">
	      	<thead>
	      		<tr class="bg-dark">
	      			<th class="no-padding bg-dark">
		      			<button class="btn btn-table btn-dark btn-block">
									<h1 class="text-center">
										Selecione a Unidade
									</h1>
		      			</button>
	      			</th>
	      		</tr>
	      	</thead>
	      	
	        <tbody>
	          <tr class="row no-gutters" ng-repeat="unidade in unidades">
	            <td class="col text-center clickable-col" data-id='{{$index}}'>
	              {{unidade}}
	            </td>
	          </tr>
	        </tbody>
	      </table>
			</div>
		</div>
	</div>
</body>
</html>
