<?php
  include_once('../../lib/head.php');
  include_once('../../lib/conexao.php');
  include_once('../../dao/horarioDao.php');
  include_once('../../dao/registroDao.php');
  
  $conexao = new Conexao();
  
  $horarioDao = new HorarioDao($conexao);
  $registroDao = new RegistroDao($conexao);
  
  $id = $_GET['id'];
  
  $horario = $horarioDao->searchById($id);
  
  echo '<script>';
  echo '  var turno = "'.$horario['turno'].'";';
  echo '  var turma = '.$horario['idTurma'].';';
  echo '  var professor = '.$horario['idProfessor'].';';
  echo '  var sala = '.$horario['idSala'].';';
  echo '  var tipo = '.$horario['idTipo'].';';
  echo '</script>';
  
  $registros = $registroDao->searchById($id);
  
  $dates = null;
  $i = 0;

  foreach ($registros as $registro) {
    $dates[$i] = $registro['data'];
    $i++;
  }

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
  <script type="text/javascript" src="../../js/jquery.mask.min.js"></script>
</head>

<body>
  <div class="container_fluid container-iframe">
    <div class="row">
      <div class="box box-info box-iframe">
        <form class="form-horizontal" action="/master/cadastros/horarios/php/updateControl.php?id=<?php echo $id; ?>" method="POST">
          <div class="box-header with-border">
            <h3 class="col-sm-11 box-title">
              <span class="label label-info">Cadastro de Horários</span>
            </h3>
            <h3 class="col-sm-1 box-title">
              <label for="unico" style="margin: 0" id="btnUnico" class="btn btn-xs btn-success">Único</label><input id="unico" type="checkbox" name="unico" style="display: none;" value="true">
            </h3>
          </div>
          <div class="box-body" style="height: 74.5vh; overflow-y: scroll; overflow-x: hidden;">
            <div class="form-group">
              <label for="turno" class="col-sm-2 control-label">Turno</label>

              <div class="col-sm-10">
                <select class="form-control" id="turno" name="turno">
                  <option>Matutino</option>
                  <option>Vespertino</option>
                  <option>Noturno</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="turma" class="col-sm-2 control-label">Turma</label>

              <div class="col-sm-10">
                <select class="form-control" id="turma" name="turma">
                  
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="professor" class="col-sm-2 control-label">Professor</label>

              <div class="col-sm-10">
                <select class="form-control" id="professor" name="professor">
                  
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="sala" class="col-sm-2 control-label">Sala</label>

              <div class="col-sm-10">
                <select class="form-control" id="sala" name="sala">
                  
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="tipo" class="col-sm-2 control-label">Tipo</label>

              <div class="col-sm-10">
                <select class="form-control" id="tipo" name="tipo">
                  
                </select>
              </div>
            </div>
            
            <div class="form-group form-group-dates">
              <label for="datepicker" class="col-sm-2 control-label">Datas</label>

              <div class="col-sm-10">
                <input id="datas" type="hidden" name="datas" value="">
                <div id="datepicker" style="background-color: #eceadf; border-radius: 5px; border: 1px solid #cbc7bd;"></div>
              </div>
            </div>
            
            <div class="form-group form-group-date hidden">
              <label for="datepicker" class="col-sm-2 control-label">Data</label>

              <div class="col-sm-10">
                <input id="data" type="text" name="data" class="form-control">
              </div>
            </div>
          </div>
          
          <div class="box-footer with-border">
            <button type="button" onclick="window.location='/master/cadastros/horarios/select.php';" class="btn btn-danger">Cancel</button>
            <button type="button" class="btn btn-info pull-right" onclick="prepareForm()">Enviar</button>
          </div>
      </form>
    </div>
  </div>
</body>

</html>

<script>
  atualizarProfessores();
  atualizarSalas();
  atualizarTipos();
  $('#turno').on('change', function(){atualizarTurmas();});
  
  $('#datepicker').multiDatesPicker({
    dateFormat: "yy-mm-dd",
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior',
    numberOfMonths: 3
  });
  
  $(".ui-datepicker-multi-3").css('margin', 'auto');
  
  function prepareForm() {
    var dates = $('#datepicker').multiDatesPicker('getDates');
    $("#datas").val(dates);
    $(".form-horizontal").submit();
  }
  
  $("#turno").val(turno);
  atualizarTurmas();
  setTimeout(function(){
    setTimeout(function(){$("#turma").val(turma);}, 50);
    $("#professor").val(professor);
    $("#sala").val(sala);
    $("#tipo").val(tipo);
  }, 50);

  $('#data').datepicker({
    dateFormat: "dd/mm/yy",
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
  });

  $('#data').mask('00/00/0000');
  $('#unico').on('change', function() {
    if($('#unico').prop('checked')) {
      $('#btnUnico').removeClass('btn-success');
      $('#btnUnico').addClass('btn-danger');

      $('.form-group-dates').addClass('hidden');
      $('.form-group-date').removeClass('hidden');
    } else {
      $('#btnUnico').removeClass('btn-danger');
      $('#btnUnico').addClass('btn-success');

      $('.form-group-dates').removeClass('hidden');
      $('.form-group-date').addClass('hidden');
    }
  })
</script>

<?php
  echo '<script>';
  
  echo '  var dates = [];';
  $i = 0;
  foreach($dates as $date) {
    echo '  dates['.$i.'] = "'.$date.'";';
    $i++;
  }
    echo '  $("#datepicker").multiDatesPicker("addDates", dates);';
  echo '</script>';
?>
