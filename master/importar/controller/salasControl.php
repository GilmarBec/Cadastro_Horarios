<?php
	include_once('../../lib/conexao.php');
	include_once('../../dao/alterarDao.php');
	include_once('../../dao/horarioDao.php');
	include_once('../../dao/registroDao.php');
	include_once('../../dao/salaDao.php');
	include_once('../../domain/sala.php');

	$conexao = new Conexao();
	$alterarDao = new AlterarDao($conexao);
	$horarioDao = new HorarioDao($conexao);
	$registroDao = new RegistroDao($conexao);
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
			$cont--;
		} else if(count($row) == 16 && $row[9] != "-") {
			if(substr($row[10], -3) == "CIG") $values[$cont][5] = "-----";
			else if(substr($row[10], -3) == "RIO") $values[$cont][5] = substr($row[10], -10);
			else if(substr($row[10], -3) == "EP)") $values[$cont][5] = substr($row[10], -9, -6);
			else $values[$cont][5] = substr($row[10], -3);
		} else if(count($row) == 23 && $row[3] != "-") {
			if(substr($row[17], -3) == "CIG") $values[$cont][5] = "-----";
			else if(substr($row[17], -3) == "RIO") $values[$cont][5] = substr($row[17], -10);
			else if(substr($row[17], -3) == "EP)") $values[$cont][5] = substr($row[17], -9, -6);
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
	
	$horarioDao->clear(); 	//Limpa a tabela horarios
	$registroDao->clear(); 	//Limpa a tabela Registro
	$salaDao->clear(); 		//Limpa a tabela Sala

	foreach ($salas as $result) {
		$sala = new Sala();
		$sala->setNome($result);
		$salaDao->insert($sala);
	}

	$alterarDao->update();

	fclose($f);
	Header('location: ../');
?>