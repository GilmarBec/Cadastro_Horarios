<?php
	include_once('../../lib/conexao.php');

	$conexao = new Conexao();

	$senha = md5($_POST['senha']);

	try {
    $stmt = $conexao->getCon()->prepare('SELECT senha FROM usuario WHERE login="admin"');
    $stmt->execute();
    
    foreach ($stmt as $row) {
    	$senhaAdmin = $row['senha'];
    }

    $verify = false;
    if($senhaAdmin == $senha) $verify = true;
  } catch(PDOException $e) {
    $verify = false;
  }

  if($verify) {
		try {
			//Drop Table Registro
			$stmt = $conexao->getCon()->prepare('DROP TABLE registro');
	    $stmt->execute();

	    //Drop Table Horario
	    $stmt = $conexao->getCon()->prepare('DROP TABLE horario');
	    $stmt->execute();
	    
	    //Create Table Horario And Yours Foreign Key's
	    $sql = "
		    CREATE TABLE `horario` (
				  `id` int(11) AUTO_INCREMENT,
				  `idTurma` int(11) NOT NULL,
				  `idProfessor` int(11) NOT NULL,
				  `idSala` int(11) NOT NULL,
				  `idTipo` int(11) NOT NULL,
				  `turno` varchar(40) NOT NULL,
				  PRIMARY KEY (`id`)
				);
				ALTER TABLE `horario`
				  ADD KEY `FK_turmaHorario` (`idTurma`),
				  ADD KEY `FK_professorHorario` (`idProfessor`),
				  ADD KEY `FK_salaHorario` (`idSala`),
				  ADD KEY `FK_tipoHorario` (`idTipo`);
			";
	    $stmt = $conexao->getCon()->prepare($sql);
	    $stmt->execute();

	    //Create Table Registro And Yours Foreign Key's
	    $sql = "
	    	CREATE TABLE `registro` (
				  `id` bigint(20) AUTO_INCREMENT,
				  `idHorario` int(11) NOT NULL,
				  `data` date NOT NULL,
				  PRIMARY KEY (`id`)
				);
				ALTER TABLE `registro`
				  ADD KEY `FK_horarioRegistro` (`idHorario`), AUTO_INCREMENT=1;
	    ";
	    $stmt = $conexao->getCon()->prepare($sql);
	    $stmt->execute();
	    //Fim do SQL//

	    Header('Location: ../selectUsers.php');
	  } catch(PDOException $e) {
	    echo 'ERRO: ' . $e->getMessage() . '<br><a href="../selectUsers.php">Voltar</a>';
	  }
	} else {
		Header('Location: ../clearHorarios.php?r=1');
	}
?>