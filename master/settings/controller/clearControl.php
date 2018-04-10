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
			$stmt = $conexao->getCon()->prepare('TRUNCATE TABLE registro');
	    $stmt->execute();

	    $stmt = $conexao->getCon()->prepare('TRUNCATE TABLE horario');
	    $stmt->execute();
	    
	    Header('Location: ../selectUsers.php');
	  } catch(PDOException $e) {
	    echo 'ERRO: ' . $e->getMessage() . '<br><a href="../selectUsers.php">Voltar</a>';
	  }
	} else {
		Header('Location: ../clearHorarios.php?r=1');
	}
?>