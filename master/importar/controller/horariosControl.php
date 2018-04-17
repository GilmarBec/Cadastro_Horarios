<?php
	include_once('../../lib/conexao.php');
	include_once('../../dao/alterarDao.php');
	include_once('../../dao/horarioDao.php');
	include_once('../../dao/professorDao.php');
	include_once('../../dao/registroDao.php');
	include_once('../../dao/salaDao.php');
	include_once('../../dao/tipoDao.php');
	include_once('../../dao/turmaDao.php');

	include_once('../../domain/horario.php');

	$conexao = new Conexao();
	$alterarDao = new AlterarDao($conexao);
	$horarioDao = new HorarioDao($conexao);
	$professorDao = new ProfessorDao($conexao);
	$registroDao = new RegistroDao($conexao);
	$salaDao = new SalaDao($conexao);
	$tipoDao = new TipoDao($conexao);
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
			else if(substr($row[17], -3) == "RIO") $values[$cont][5] = substr($row[17], -10);
			else if(substr($row[17], -3) == "EP)") $values[$cont][5] = substr($row[17], -9, -6);
			else $values[$cont][5] = substr($row[17], -3);
		} else $cont--;
		$cont++;
	}

	// 0 = Tipo
	// 1 = Curso
	// 2 = Professor
	// 3 = Turno
	// 4 = Data
	// 5 = Sala

	foreach ($values as $value) {
		
		
		$horario = new Horario();
	}

	fclose($f);
?>