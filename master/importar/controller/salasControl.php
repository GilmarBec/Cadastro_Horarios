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
		$salas = [];
		foreach ($values as $linha) {
			array_push($salas, $linha[5]);
		}
		$salas = array_unique($salas);
		asort($salas);
		echo '<br><b>Salas</b><br>';
		foreach ($salas as $sala) {
			echo $sala . '<br>';
		}
		fclose($f);
	}
?>