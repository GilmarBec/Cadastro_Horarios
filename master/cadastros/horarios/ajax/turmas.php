<?php
	$turno = null;
  if($_GET) $turno = $_GET['turno'];
  
  
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/turmaDao.php');
  
  $conexao = new Conexao();
  $turmaDao = new TurmaDao($conexao);
  
  $result = $turmaDao->selectByTurno($turno);

  if($result != null){
    $i = false;
    echo "[";
    foreach($result as $row) {
      if($i) {
        echo ",";
      }
      echo "{";
      echo '"id":' . $row['id'] . ",";
      echo '"nome":"' . $row['nome'] . '",';
      echo '"turno":"' . $row['turno'] . '"';
      echo "}";
      $i = true;
    }
    echo "]";
  }
?>