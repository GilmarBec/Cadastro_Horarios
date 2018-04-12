<!DOCTYPE html>
<html>
<head>
	<title>Teste XLS</title>
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<input id="file" type="file" name="file"><br>
		<input type="submit" value="Enviar">
	</form>
</body>
</html>

<?php
	function csvConvert($array) {
		return str_getcsv($array, ",");
	}
	

	if(isset($_FILES['file'])) {
		$file = $_FILES['file'];
		$f = fopen($file['tmp_name'], "r");
		$csv = array_map('csvConvert', file($file['tmp_name']));
		$array = [];
		for ($i = 1; $i < count($csv); $i++) {
			for ($j = 0; $j < 23; $j++) { 
				$array[$i-1] = $csv[$i];
			}
			$j = 1;
			// foreach ($col as $value) {
				// switch($j) {
				// 	case 2:
				// 	case 3:
				// 	case 6:
				// 	case 9:
				// 	case 11:
				// 	case 16:
				// 	case 17:
				// 		break;
				// 	default: break;
				// }
				// echo $value;
				// $j++;
			// }
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
				$values[$cont][5] = $row[10];
			} else if(count($row) == 23 && $row[3] != "-") {
				$values[$cont][0] = $row[3];
				$values[$cont][1] = $row[6];
				$values[$cont][2] = $row[9];
				$values[$cont][3] = $row[11];
				$values[$cont][4] = $row[16];
				$values[$cont][5] = $row[17];
			} else $cont--;
			$cont ++;
		}
		foreach ($values as $i => $linha) {
			echo '<b>Registro ' . ($i+1) . '</b><br>';
			echo '<b>Tipo</b> ' . $linha[0] . "<br>";
			echo '<b>Curso</b> ' . $linha[1] . "<br>";
			echo '<b>Turno</b> ' . $linha[2] . "<br>";
			echo '<b>Data</b> ' . $linha[3] . "<br>";
			echo '<b>Professor</b> ' . $linha[4] . "<br>";
			echo '<b>Sala</b> ' . $linha[5] . "<br>";
			echo "<br>";
		}
		// echo count($csv);
		fclose($f);
	}
?>

<!-- 2
3
6
9
11
16
17 -->