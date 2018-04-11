<?php
	if(isset($_POST['file'])) {
		$_FILES['file'] = $_POST['file'];
		$file = $_FILES;
		print_r($file);
		// fopen($file, "r");
		// print_r(fgetcsv($file));
		// fclose($file);
	} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Teste XLS</title>
</head>
<body>
	<form method="post" encytype = "multipart / form-data">
		<input id="file" type="file" name="file" multiple="off"><br>
		<button type="submit">Enviar</button>
	</form>
</body>
</html>
<?php
	}
?>