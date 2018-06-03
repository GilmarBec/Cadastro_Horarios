<?php
include_once('../class/Unidades.php');

$Unidades = new Unidades();

$host = $_POST['host'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$unidade = $_POST['unidade'];

$Unidades->acesso($host, $username, $pass, $unidade);

Header('Location: ../');
