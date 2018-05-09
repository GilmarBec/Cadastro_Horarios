<?php
	include_once('../../lib/conexao.php');
	include_once('../../dao/alterarDao.php');
	include_once('../../dao/horarioDao.php');
	include_once('../../dao/registroDao.php');
	include_once('../../dao/professorDao.php');
	include_once('../../domain/professor.php');

	$conexao = new Conexao();
	$alterarDao = new AlterarDao($conexao);
	$horarioDao = new HorarioDao($conexao);
	$registroDao = new RegistroDao($conexao);
	$professorDao = new ProfessorDao($conexao);

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
			$values[$cont] = $row[9];
		} else if(count($row) == 23 && $row[3] != "-") {
			$values[$cont] = $row[16];
		} else $cont--;
		$cont ++;
	}

	$professores = [];
	foreach ($values as $linha) {
		array_push($professores, $linha);
	}

	$professores = array_unique($professores);
	asort($professores);
	
	$horarioDao->clear();	//Limpa a tabela horario 
	$registroDao->clear();	//Limpa a tabela registro
	$professorDao->clear();	//Limpa a tabela professor

	foreach ($professores as $result) {
		$professor = new Professor();
		$professor->setNome(explode(" ", $result)[0] . " " . explode(" ", $result)[count(explode(" ", $result))-1]);
		$professorDao->insert($professor);
	}

	$alterarDao->update();

	fclose($f);
	Header('location: ../');
?>