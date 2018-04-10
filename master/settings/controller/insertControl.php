<?php
  include_once('../../lib/conexao.php');
  include_once('../../dao/usuarioDao.php');
  include_once('../../domain/usuario.php');
  
  $conexao = new Conexao();
  $usuarioDao = new UsuarioDao($conexao);
  $usuario = new Usuario();
  
  $usuario->setNome($_POST['nome']);
  $usuario->setLogin($_POST['login']);
  $usuario->setSenha(md5($_POST['senha']));
  
  
  $result = $usuarioDao->insert($usuario);
  
  if($result === true) {
    Header('location: ../insertUsers.php?r=1');
  } else if($result === false) {
    Header('location: ../insertUsers.php?r=2');
  }
?>