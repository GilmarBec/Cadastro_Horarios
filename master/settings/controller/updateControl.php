<?php
  include_once('../../lib/conexao.php');
  include_once('../../dao/usuarioDao.php');
  include_once('../../domain/usuario.php');
  
  $conexao = new Conexao();
  $usuarioDao = new UsuarioDao($conexao);
  $usuario = new Usuario();
  
  $usuario->setId($_GET['id']);
  $usuario->setNome($_POST['nome']);
  $usuario->setLogin($_POST['login']);
  $usuario->setSenha(md5($_POST['senha']));
  
  
  $result = $usuarioDao->update($usuario);
  echo $result;
  if($result === true) {
    Header('location: ../selectUsers.php');
  } else if($result === false) {
    Header('location: ../updateUsers.php?r=1&id=' . $usuario->getId() . '&nome=' . $usuario->getNome() . '&login=' . $usuario->getLogin());
  }
?>