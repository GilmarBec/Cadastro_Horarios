<?php
	include_once('../../lib/conexao.php');
	include_once('../../dao/salaDao.php');
	include_once('../../domain/sala.php');

	$conexao = new Conexao();
	$salaDao = new SalaDao($conexao);

	$file = $_FILES['file'];
	$f = fopen($file['tmp_name'], "r");
	$csv = array_map('str_getcsv', file($file['tmp_name']));
	$array = [];
	for ($i = 1; $i < count($csv); $i++) {
		for ($j = 0; $j < 23; $j++) { 
			$array[$i-1] = $csv[$i];
		}
	}
	$values = [];
	$cont = 0;
	foreach ($array as $row) {
		if(count($row) == 8 && $row[7] != "-") {
			$values[$cont][0] = $row[3];
			$values[$cont][1] = $row[6];
			$cont--;
		} else if(count($row) == 16 && $row[9] != "-") {
			$values[$cont][2] = $row[2];
			$values[$cont][3] = $row[4];
			$values[$cont][4] = $row[9];
			$values[$cont][5] = substr($row[10], -3);
		} else if(count($row) == 23 && $row[3] != "-") {
			$values[$cont][0] = $row[3];
			$values[$cont][1] = $row[6];
			$values[$cont][2] = $row[9];
			$values[$cont][3] = $row[11];
			$values[$cont][4] = $row[16];
			if(substr($row[17], -3) == "CIG") $values[$cont][5] = "-----";
			else $values[$cont][5] = substr($row[17], -3);
		} else $cont--;
		$cont ++;
	}
	$salas = [];
	foreach ($values as $linha) {
		array_push($salas, $linha[5]);
	}
	$salas = array_unique($salas);
	asort($salas);

	try {
	  $stmt = $conexao->getCon()->prepare('DROP TABLE sala');
	  $stmt->execute();

	  $sql = "
	    CREATE TABLE IF NOT EXISTS `sala` (
			  `id` int(11) AUTO_INCREMENT,
			  `nome` varchar(255) NOT NULL,
			  PRIMARY KEY (`id`)
			);
		";
	  $stmt = $conexao->getCon()->prepare($sql);
	  $stmt->execute();
	} catch(PDOException $e) {
	  echo 'ERRO: ' . $e->getMessage();
	}

	foreach ($salas as $result) {
		$sala = new Sala();
		$sala->setNome($result);
		$salaDao->insert($sala);
	}

	fclose($f);

	Header('location: ../');
?>