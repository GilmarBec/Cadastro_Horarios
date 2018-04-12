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
		foreach ($array as $row) {
			// echo $row[2] . " / ";
			// echo $row[3] . " / ";
			// echo $row[6] . " / ";
			// echo $row[9] . " / ";
			// echo $row[11] . " / ";
			// echo $row[16] . " / ";
			// echo $row[17] . " / ";
			// echo '<br><br><br><br>';
			echo count($row) . "<br>";
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