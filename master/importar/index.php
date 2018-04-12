<?php
  include_once('../lib/head.php');
  
  if(ISSET($_GET['r'])) {
    $r = $_GET['r'];
    if(ISSET($_GET['erro'])) $erro = $_GET['erro'];
    
    if($r == 1) {
      Header('location: select.php');
    } else if($r == 2) {
      echo '<script>alert("Horário já cadastrado!")</script>';
    } else if($r == 3) {
      echo '<script>alert("Erro: '.$erro.'")</script>';
    }
  }
?>

<!DOCTYPE html>

<head>
  <?php ativarHead(); ?>
  <style>
  	input[type='file'] {
		  display: none !important;
		}

		/* Aparência que terá o seletor de arquivo */
		.labelInputFile {
		  cursor: pointer;
		}

		.control-label {
			line-height: 2.5;
		}
  </style>
</head>

<body>
  <div class="container-iframe">
    <div class="row">
      <div class="box box-info box-iframe">
        <div class="box-header with-border">
          <h3 class="box-title"><span class="label label-info">Importações</span></h3>
        </div>
        <div class="box-body">
          <form id="formRegistros" class="form-group" action="controller/registrosControl.php" method="POST" enctype="multipart/form-data">
            <label for="labelInputRegistros" class="col-sm-2 control-label">Importar Registros</label>

            <div class="col-sm-10 input-group">
            	<label id="labelInputRegistros" class="form-control labelInputFile" for="registros">Escolher Arquivo</label>
              <input id="registros" type="file" name="file" accept=".csv">
              <span class="input-group-btn">
              	<button type="button" class="btn btn-success" onclick='validar("registros", "formRegistros")'>Importar</button>
              </span>
            </div>
          </form>
          <form id="formProfessores" class="form-group" action="controller/professoresControl.php" method="POST" enctype="multipart/form-data">
            <label for="labelInputProfessores" class="col-sm-2 control-label">Importar Professores</label>

            <div class="col-sm-10 input-group">
            	<label id="labelInputProfessores" class="form-control labelInputFile" for="professores">Escolher Arquivo</label>
              <input id="professores" type="file" name="file" accept=".csv">
              <span class="input-group-btn">
              	<button type="button" class="btn btn-success" onclick='validar("professores", "formProfessores")'>Importar</button>
              </span>
            </div>
          </form>
          <form id="formSalas" class="form-group" action="controller/salasControl.php" method="POST" enctype="multipart/form-data">
            <label for="labelInputSalas" class="col-sm-2 control-label">Importar Salas</label>

            <div class="col-sm-10 input-group">
            	<label id="labelInputSalas" class="form-control labelInputFile" for="salas">Escolher Arquivo</label>
              <input id="salas" type="file" name="file" accept=".csv">
              <span class="input-group-btn">
              	<button type="button" class="btn btn-success" onclick='validar("salas", "formSalas")'>Importar</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<script>
	$('#registros').on('change', function(){
		$('#labelInputRegistros').text("Escolher Arquivo - " + $('#registros').val().split('\\')[2]);
	});
	$('#professores').on('change', function(){
		$('#labelInputProfessores').text("Escolher Arquivo - " + $('#professores').val().split('\\')[2]);
	});
	$('#salas').on('change', function(){
		$('#labelInputSalas').text("Escolher Arquivo - " + $('#salas').val().split('\\')[2]);
	});
	function validar(id, idForm) {
		if($("#"+id).val().substr(-4) == ".csv") {
			$("#"+idForm).submit();
		} else {
			alert("Formato não suportado!");
		}
	}
</script>