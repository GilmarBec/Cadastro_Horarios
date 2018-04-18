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