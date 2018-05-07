<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/alterarDao.php');
  include_once('../../../dao/horarioDao.php');
  include_once('../../../dao/registroDao.php');
  include_once('../../../domain/horario.php');
  
  $conexao = new Conexao();
  
  $alterarDao = new AlterarDao($conexao);
  $horarioDao = new HorarioDao($conexao);
  $registroDao = new RegistroDao($conexao);
  
  $horario = new Horario();

  if(isset($_POST['unico'])) {
    $horario->setId($_GET['id']);
    $horario->setTurno($_POST['turno']);
    $horario->setTurma($_POST['turma']);
    $horario->setProfessor($_POST['professor']);
    $horario->setSala($_POST['sala']);
    $horario->setTipo($_POST['tipo']);
    $date = explode("/", $_POST['data'])[2] . "-" . explode("/", $_POST['data'])[1] . "-" . explode("/", $_POST['data'])[0];

    $result = $horarioDao->insert($horario);

    if($result === false) {
      $horarioAtual = $registroDao->searchById($horario->getId());
      $i = 0;
      foreach ($horarioAtual as $value) {
        $i++;
      }

      if($i == 1) {
        $horarioDao->exclude($horario->getId());
        $registroDao->excludeByDate($horario->getId(), $date);
      }

      $result = true;
    } else {
      $registroDao->excludeByDate($horario->getId(), $date);
    }

    $horarios = $horarioDao->searchByAll($horario);
    
    if(is_array($horarios)) {
      $dates[0] = $date;
      $final = $registroDao->insert($horarios['id'], $dates);
    } else if($horarios != false) {
      Header('location: ../update.php?id='.$horario->getId().'&r=3&erro=' . $horarios);
    }
  } else {
    $horario->setId($_GET['id']);
    $horario->setTurno($_POST['turno']);
    $horario->setTurma($_POST['turma']);
    $horario->setProfessor($_POST['professor']);
    $horario->setSala($_POST['sala']);
    $horario->setTipo($_POST['tipo']);
    $datas = $_POST['datas'];
    
    $dates = null;
    if(strlen($datas) > 10) $dates = explode(",", $datas);
    else $dates[0] = $datas;
    
    $result = $horarioDao->update($horario);
    
    if($result === true) {
      $final = $registroDao->update($horario->getId(), $dates);
    }
  }
  
  if($result === true && $final === true) {
    $alterarDao->update();
    Header('location: ../update.php?r=1');
  } else if($result === false || $final === false) {
    Header('location: ../update.php?id='.$horario->getId().'&r=2');
  } else {
    Header('location: ../update.php?id='.$horario->getId().'&r=3&erro=' . $result . '<br>Erro 2: ' . $final);
  }
?>