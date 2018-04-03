<?php
	include_once('../../../lib/conexao.php');
	include_once('../../../dao/tipoDao.php');

	$conexao = new Conexao();
	$tipoDao = new TipoDao($conexao);

	$result = $tipoDao->select();
	
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