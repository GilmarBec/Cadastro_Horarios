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
		if(count($row) == 8 && $row[7] != "-") { // Variante 1 dos valores buscados do arquivo CSV
			$values[$cont][0] = $row[6]; // Código da Turma
			$cont--;
		} else if(count($row) == 16 && $row[9] != "-") { // Variante 2 dos valores buscados do arquivo CSV
			$values[$cont][1] = $row[2]; // Turno
		} else if(count($row) == 23 && $row[3] != "-") { // Variante 3 dos valores buscados do arquivo CSV
			$values[$cont][0] = $row[6]; // Código da Turma
			$values[$cont][1] = $row[5]; // Turno
		} else $cont--;
		$cont ++;
	}

	$turmas = [];
	foreach ($values as $i => $linha) {
		$turmas[$i]['turma'] = $linha[0]; // Código da turma
		$turmas[$i]['turno'] = $linha[1]; // Turno
	}
	
	$horarioDao->clear();
	$registroDao->clear();
	
	try {
	  $stmt = $conexao->getCon()->prepare('DROP TABLE turma');
	  $stmt->execute();

	  $sql = "
	    CREATE TABLE IF NOT EXISTS `turma` (
			  `id` int(11) AUTO_INCREMENT,
			  `nome` varchar(255) NOT NULL,
			  `turno` varchar(15) NOT NULL,
			  PRIMARY KEY (`id`)
			);
		";
	  $stmt = $conexao->getCon()->prepare($sql);
	  $stmt->execute();
	} catch(PDOException $e) {
	  echo 'ERRO: ' . $e->getMessage();
	}

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