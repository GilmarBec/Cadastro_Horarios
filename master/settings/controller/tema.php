<?php
	include_once('../../lib/conexao.php');
  include_once('../../dao/alterarDao.php');

  $tema = $_GET['tema'];

  $conexao = new Conexao();
  $alterarDao = new AlterarDao($conexao);

  $alterarDao->setTema($tema);
  $alterarDao->update();

  Header('location: ../../');
?>