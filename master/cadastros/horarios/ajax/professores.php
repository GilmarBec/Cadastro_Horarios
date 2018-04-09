<?php
	include_once('../../../lib/conexao.php');
	include_once('../../../dao/professorDao.php');

	$conexao = new Conexao();
	$professorDao = new ProfessorDao($conexao);

	$result = $professorDao->select();

	if($result != false){
		$i = false;
		echo "[";
		foreach($result as $row) {
			if($i) {
				echo ",";
			}
			echo "{";
			echo '"id":' . $row['id'] . ",";
			echo '"nome":"' . $row['nome'] . '"';
			echo "}";
			$i = true;
		}
		echo "]";
	}
?>