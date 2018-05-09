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
	include_once('../../domain/professor.php');
	include_once('../../domain/sala.php');
	include_once('../../domain/tipo.php');
	include_once('../../domain/turma.php');

	$conexao = new Conexao();
	$alterarDao = new AlterarDao($conexao);
	$horarioDao = new HorarioDao($conexao);
	$professorDao = new ProfessorDao($conexao);
	$registroDao = new RegistroDao($conexao);
	$salaDao = new SalaDao($conexao);
	$tipoDao = new TipoDao($conexao);
	$turmaDao = new TurmaDao($conexao);

	set_time_limit(0);

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
			$values[$cont][6] = $row[5];
			$cont--;
		} else if(count($row) == 16 && $row[9] != "-") {
			$values[$cont][2] = $row[2];
			$values[$cont][3] = $row[4];
			$values[$cont][4] = explode(" ", $row[9])[0] . " " . explode(" ", $row[9])[count(explode(" ", $row[9]))-1];
			$values[$cont][5] = substr($row[10], -3);
		} else if(count($row) == 23 && $row[3] != "-") {
			$values[$cont][0] = $row[3];
			$values[$cont][1] = $row[6];
			$values[$cont][2] = $row[9];
			$values[$cont][3] = $row[11];
			$values[$cont][4] = explode(" ", $row[16])[0] . " " . explode(" ", $row[16])[count(explode(" ", $row[16]))-1];
			
			if(substr($row[17], -3) == "CIG") $values[$cont][5] = "-----";
			else if(substr($row[17], -3) == "RIO") $values[$cont][5] = substr($row[17], -10);
			else if(substr($row[17], -3) == "EP)") $values[$cont][5] = substr($row[17], -9, -6);
			else $values[$cont][5] = substr($row[17], -3);

			$values[$cont][6] = $row[5];
		} else $cont--;
		$cont++;
	}

	// 0 = Tipo
	// 1 = Código da Turma
	// 2 = Turno
	// 3 = Data
	// 4 = Professor
	// 5 = Sala
	// 6 = Nome da Turma

	$horarioDao->clear();
	$registroDao->clear();

	foreach ($values as $value) {
		$tipo = new Tipo();
		switch ($value[0]) {
			case 'Ensino Médio':
				$tipo->setNome('ENSINO MÉDIO');
				break;
			case 'Qualificação / Aperfeiçoamento':
				$tipo->setNome('CURTA DURAÇÃO / EVENTOS');
				break;
			case 'Curso Técnico':
				$tipo->setNome('TÉCNICO');
				break;
			case 'Aprendizagem Industrial':
				$tipo->setNome('APRENDIZAGEM');
				break;
			default:
				$tipo->setNome('CURTA DURAÇÃO / EVENTOS');
				break;
		}
		$tipoDao->insert($tipo);
		$tipo->setId($tipoDao->search($tipo)[0]['id']);

		$codTurma = $linha[1]; // Código da turma (Ex.: T TINF 2018/1 N1)
		$nomeTurma = $linha[6]; // Nome da turma (Ex.: Técnico em Informática)

		if(explode(" ", $nomeTurma)[0] == "Aprendizagem") { // Remove um dos tipos do prefixo de Aprendizagem Industrial
			$turmaTemp = substr($nomeTurma, 27) . " " . explode(" ", $codTurma)[2] . " - " . explode("/", explode(" ", $codTurma)[2])[1];
		} else if(explode(" ", $nomeTurma)[0] == "Técnico" && explode(" ", $nomeTurma)[1] == "em") { // Remove o prefixo dos Técnicos
			$turmaTemp = substr($nomeTurma, 11) . " " . explode(" ", $codTurma)[2] . " - " . explode("/", explode(" ", $codTurma)[2])[1];
		} else if(count(explode(" ", $nomeTurma)) >= 4 && explode(" ", $nomeTurma)[2] == "SENAI" && explode(" ", $nomeTurma)[3] == "Conecte") { // Remove o prefixo de Senai Conecte
			$turmaTemp = substr($nomeTurma, 13) . " " . explode(" ", $codTurma)[2] . " - " . explode("/", explode(" ", $codTurma)[2])[1];
		} else if(explode(" ", $nomeTurma)[0] == "Programa" && explode(" ", $nomeTurma)[2] == "Aprendizagem") { // Remove o segundo tipo de prefixo de Aprendizagem Industrial
			$turmaTemp = substr($nomeTurma, 39) . " " . explode(" ", $codTurma)[2] . " - " . explode("/", explode(" ", $codTurma)[2])[1];
		} else { // Pega todos os dados que sobraram sem filtrar
			$turmaTemp = $nomeTurma . " " . explode(" ", $codTurma)[2] . " - " . explode("/", explode(" ", $codTurma)[2])[1];
		}

		$turma = new Turma();
		$turma->setNome($turmaTemp);
		$turma->setTurno($value[2]);
		$turmaDao->insert($turma);
		$turma->setId($turmaDao->search($turma)[0]['id']);

		$professor = new Professor();
		$professor->setNome($value[4]);
		$professor->setId($professorDao->search($professor)[0]['id']);

		$sala = new Sala();
		$sala->setNome($value[5]);
		$sala->setId($salaDao->search($sala)[0]['id']);

		$horario = new Horario();
		$horario->setTurno($turma->getTurno());
		$horario->setTurma($turma->getId());
		$horario->setProfessor($professor->getId());
		$horario->setSala($sala->getId());
		$horario->setTipo($tipo->getId());

		$horarioDao->insert($horario);
		$horario->setId($horarioDao->searchByAll($horario)['id']);

		$data = explode("/", $value[3]);
		$date[0] = $data[2] . "-" . $data[1] . "-" . $data[0];
		$registroDao->insert($horario->getId(), $date);
	}

	$alterarDao->update();

	fclose($f);
	Header('Location: ../');
?>