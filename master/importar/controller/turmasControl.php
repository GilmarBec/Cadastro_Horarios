<?php
	include_once('../../lib/conexao.php');
	include_once('../../dao/alterarDao.php');
	include_once('../../dao/horarioDao.php');
	include_once('../../dao/registroDao.php');
	include_once('../../dao/turmaDao.php');
	include_once('../../domain/turma.php');

	$conexao = new Conexao();
	$alterarDao = new AlterarDao($conexao);
	$horarioDao = new HorarioDao($conexao);
	$registroDao = new RegistroDao($conexao);
	$turmaDao = new TurmaDao($conexao);

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
			$values[$cont][0] = $row[6];
			$cont--;
		} else if(count($row) == 16 && $row[9] != "-") {
			$values[$cont][1] = $row[2];
		} else if(count($row) == 23 && $row[3] != "-") {
			$values[$cont][0] = $row[6];
			$values[$cont][1] = $row[9];
		} else $cont--;
		$cont ++;
	}

	$turmas = [];
	foreach ($values as $i => $linha) {
		$turmas[$i]['turma'] = $linha[0];
		$turmas[$i]['turno'] = $linha[1];
	}
	
	$horarioDao->clear();	//Limpa a tabela 'horarios'
	$registroDao->clear();	//Limpa a tabela 'registro'
	$turmaDao->clear();		//Limpa a tabela 'turma'

	foreach ($turmas as $result) {
		$turma = new Turma();
		$turma->setNome($result['turma']);
		$turma->setTurno($result['turno']);
		$turmaDao->insert($turma);
	}

	$alterarDao->update();

	fclose($f);
	Header('location: ../');
?>