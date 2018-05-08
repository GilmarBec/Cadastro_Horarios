<?php
  include_once('../../lib/conexao.php');
  include_once('../../dao/usuarioDao.php');
  
  $conexao = new Conexao();
  $usuarioDao = new UsuarioDao($conexao);
  
  $id = $_GET['id'];
  
  $result = $usuarioDao->exclude($id);
  
  if($result === true) {
    Header('location: ../selectUsers.php');
  } else {
    Header('location: ../selectUsers.php?erro=' . $result);
  }
?>