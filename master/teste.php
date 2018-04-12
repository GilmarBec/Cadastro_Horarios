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
		$endLine = 0;
		foreach ($array as $row) {
			if(count($row) == 8) {
				$values[$cont-$endLine][0] = $row[3];
				$values[$cont-$endLine][1] = $row[6];
				$endLine++;
			} else if(count($row) == 16) {
				$values[$cont-$endLine][2] = $row[2];
				$values[$cont-$endLine][3] = $row[4];
				$values[$cont-$endLine][4] = $row[9];
				$values[$cont-$endLine][5] = $row[10];
			} else if(count($row) == 1) $endLine++;
			// else echo count($row) . "<br>";
			$cont ++;
		}
		foreach ($values as $linha) {
			foreach ($linha as $coluna) {
				echo $coluna . " -- ";
			}
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