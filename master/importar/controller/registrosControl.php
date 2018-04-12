<?php
	if(isset($_FILES['file'])) {
		$file = $_FILES['file'];
		$f = fopen($file['tmp_name'], "r");
		$csv = array_map('str_getcsv', file($file['tmp_name']));
		$array = [];
		for ($i = 1; $i < count($csv); $i++) {
			for ($j = 0; $j < 23; $j++) { 
				$array[$i-1] = $csv[$i];
			}
		}
		$values = [];
		$cont = 0;
		foreach ($array as $row) {
			if(count($row) == 8 && $row[7] != "-") {
				$values[$cont][0] = $row[3];
				$values[$cont][1] = $row[6];
				$cont--;
			} else if(count($row) == 16 && $row[9] != "-") {
				$values[$cont][2] = $row[2];
				$values[$cont][3] = $row[4];
				$values[$cont][4] = $row[9];
				$values[$cont][5] = substr($row[10], -3);
			} else if(count($row) == 23 && $row[3] != "-") {
				$values[$cont][0] = $row[3];
				$values[$cont][1] = $row[6];
				$values[$cont][2] = $row[9];
				$values[$cont][3] = $row[11];
				$values[$cont][4] = $row[16];
				if(substr($row[17], -3) == "CIG") $values[$cont][5] = "-----";
				else $values[$cont][5] = substr($row[17], -3);
			} else $cont--;
			$cont ++;
		}
		$tipos = [];
		$cursos = [];
		$professores = [];
		$salas = [];
		foreach ($values as $linha) {
			array_push($tipos, $linha[0]);
			array_push($cursos, $linha[1]);
			array_push($professores, $linha[4]);
			array_push($salas, $linha[5]);
		}
		$tipos = array_unique($tipos);
		asort($tipos);
		$cursos = array_unique($cursos);
		asort($cursos);
		$professores = array_unique($professores);
		asort($professores);
		$salas = array_unique($salas);
		asort($salas);
		echo '<br><b>Tipos</b><br>';
		foreach ($tipos as $tipo) {
			echo $tipo . '<br>';
		}
		echo '<br><b>Cursos</b><br>';
		foreach ($cursos as $curso) {
			echo $curso . '<br>';
		}
		echo '<br><b>Professores</b><br>';
		foreach ($professores as $professor) {
			echo $professor . '<br>';
		}
		echo '<br><b>Salas</b><br>';
		foreach ($salas as $sala) {
			echo $sala . '<br>';
		}
		fclose($f);
	}
?>