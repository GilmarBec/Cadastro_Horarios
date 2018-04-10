<?php
  include_once("../lib/conexao.php");
  include_once("../dao/usuarioDao.php");
  include_once("../domain/usuario.php");
  
  $conexao = new Conexao();
  $usuarioDao = new UsuarioDao($conexao);
  $usuario = new Usuario();
   
  $usuario->setLogin($_POST["login"]);
  $usuario->setSenha(md5($_POST["senha"]));
  
  

  if($usuarioDao->login($usuario)) {
    $linha = $usuarioDao->search($usuario->getLogin());
    
    session_start();
    $_SESSION['id'] = $linha['id'];
    $_SESSION['nome'] = $linha['nome'];
    $_SESSION['login'] = $linha['login'];
    
    Header("Location: ../");
  } else {
    Header("Location: ../login.php?erro=1");
  }
?>