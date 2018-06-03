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
	$professorDao = new professorDao($conexao);

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
	
	$horarioDao->clear();
	$registroDao->clear();
	
	try {
    $stmt = $conexao->getCon()->prepare('DROP TABLE professor');
    $stmt->execute();

    $sql = "
	    CREATE TABLE IF NOT EXISTS `professor` (
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

	foreach ($professores as $result) {
		$professor = new Professor();
		$professor->setNome(explode(" ", $result)[0] . " " . explode(" ", $result)[count(explode(" ", $result))-1]);
		$professorDao->insert($professor);
	}

	$alterarDao->update();

	fclose($f);
	Header('location: ../');
?>