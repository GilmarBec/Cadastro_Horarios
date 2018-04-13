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
          <div class="col-sm-10">
            <h3 class="box-title"><span class="label label-info label-sm">Importações</span></h3>
          </div>
          <div class="col-sm-2">
            <h3 class="box-title"><a class="btn btn-primary btn-xs" target="_blank" href="https://convertio.co/pt/">Conversor de XLS para CSV</a></h3>
          </div>
        </div>
        <div class="box-body">
          <form id="formHorarios" class="form-group" action="controller/horariosControl.php" method="POST" enctype="multipart/form-data">
            <label for="labelInputHorarios" class="col-sm-2 control-label">Importar Horarios</label>

            <div class="col-sm-10 input-group">
            	<label id="labelInputHorarios" class="form-control labelInputFile" for="horarios">Escolher Arquivo</label>
              <input id="horarios" type="file" name="file" accept=".csv">
              <span class="input-group-btn">
              	<button type="button" class="btn btn-success" onclick='validar("horarios", "formForarios")'>Importar</button>
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
	$('#horarios').on('change', function(){
		$('#labelInputhorarios').text("Escolher Arquivo - " + $('#horarios').val().split('\\')[2]);
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
		} else if($("#"+id).val() == "") {
    } else alert("Formato não suportado!");
	}
</script>