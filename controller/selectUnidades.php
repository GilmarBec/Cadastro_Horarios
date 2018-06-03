<?php
	$conexao = new PDO("mysql:host=localhost;dbname=spd", "root", "") or print (mysql_error());
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM db;";
	$stmt = $conexao->prepare($sql);
	$stmt->execute();

	echo '[';
	$i = 0;
	foreach ($stmt as $value) {
		if($i > 0) echo ',';
		echo '"' . utf8_encode($value['nome']) . '"';
		$i++;
	}
	echo ']';
