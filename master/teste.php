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
	if(isset($_FILES['file'])) {
		$file = $_FILES['file'];
		$f = fopen($file['tmp_name'], "r");
		$csv = array_map('str_getcsv', file($file['tmp_name']));
		for ($i = 1; $i < count($csv) - 1; $i++) {
			$col = explode(";", $csv[$i][0]);
			$j = 1;
			foreach ($col as $value) {
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
				echo $value;
			}
			// echo $csv[$i][0];
		}
		fclose($f);
	}
?>

2
3
6
9
11
16
17
