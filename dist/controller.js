angular.module('spd', [])
.controller('IndexCtrl', function($scope) {
	$scope.unidades = [];
	$.ajax({
		url: 'controller/selectUnidades.php',
		success: function(data) {
			var dados = JSON.parse(data);
			dados.forEach(function(item, index) {
				$scope.unidades.push(item);
			});
			$scope.$apply();
		}
	});
})

.controller('selectUnidadeCtrl', function($scope) {
	$scope.unidades = [];

	$.ajax({
		url: '../controller/selectUnidades.php',
		success: function(data) {
			var dados = JSON.parse(data);
			dados.forEach(function(item, index) {
				$scope.unidades.push(item);
			});
			$scope.$apply();
		}
	});

	$(document).ready(function() {
    $(".clickable-col").click(function() {
      selecionar($(this).data("id"));
    });
	});

	function selecionar(index) {
		$.ajax({
			url: 'lib/selecao.php',
			method: 'post',
			data: {unidade: $scope.unidades[index]},
			success: function(data) {
				if(data == 0) {
					window.location.href = "/horarios/";
				}
			}
		});
	}
});
