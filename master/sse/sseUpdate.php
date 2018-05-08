<?php
include_once('../lib/conexao.php');
include_once('../dao/alterarDao.php');

$conexao = new Conexao();
$alterarDao = new AlterarDao($conexao);

$alterarDao->update();

Header('Location: ../');
?>