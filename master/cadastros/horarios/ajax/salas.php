<?php
	include_once('../../../lib/conexao.php');
	include_once('../../../dao/salaDao.php');

	$conexao = new Conexao();
	$salaDao = new salaDao($conexao);

	$result = $salaDao->select();

	if($result != null){
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