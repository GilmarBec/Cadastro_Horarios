<?php
  include_once('../../lib/conexao.php');
  include_once('../../dao/usuarioDao.php');
  
  $conexao = new Conexao();
  $usuarioDao = new UsuarioDao($conexao);
  
  $senha = md5($_POST['senha']);
  $confirmSenha = md5($_POST['confirmSenha']);

  if($senha === $confirmSenha) $result = $usuarioDao->updateAdminPass(md5($_POST['senha']));
  else Header('Location: ../updateAdmin.php?r=1');
  
  if($result === true) {
    Header('location: ../selectUsers.php');
  }
?>