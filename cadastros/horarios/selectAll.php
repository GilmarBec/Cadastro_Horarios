<?php
  if($_POST) if($_POST['data'] != "") $data = $_POST['data'];

  include_once('../../lib/head.php');

  include_once('../../lib/conexao.php');

  include_once('../../dao/registroDao.php');
  include_once('../../dao/horarioDao.php');
  include_once('../../dao/turmaDao.php');
  include_once('../../dao/professorDao.php');
  include_once('../../dao/salaDao.php');
  include_once('../../dao/tipoDao.php');
  
  $conexao = new Conexao();

  $registroDao = new RegistroDao($conexao);
  $horarioDao = new HorarioDao($conexao);
  $turmaDao = new TurmaDao($conexao);
  $professorDao = new ProfessorDao($conexao);
  $salaDao = new SalaDao($conexao);
  $tipoDao = new TipoDao($conexao);
  
  if(isset($_GET['erro'])) {
    echo '<script>alert("Erro: "'.$_GET['erro'].');</script>';
  }

  $result = null;
  if(ISSET($data)) {
    $ano= substr($data, 6);
    $mes= substr($data, 3,-5);
    $dia= substr($data, 0,-8);
    $data = $ano."-".$mes."-".$dia;
    $registros = $registroDao->search($data);
    if($registros != false) {
      $i = 0;
      $horarios = null;
      foreach ($registros as $registro) {
        $horarios[$i] = $horarioDao->searchById($registro['idHorario']);
        $i++;
      }
      $result = $horarios;
    }
  } else $result = $horarioDao->select();

  if(!is_array($result)) {
    if($result != false) {
      $erro = true;
    }
  } else {
    $erro = false;
  }
?>

<!DOCTYPE html>

<head>
  <?php ativarHead(); ?>
  <script src="../../js/jquery.mask.min.js"></script>
</head>

<body>
  <div class="container_fluid container-iframe">
    <div class="row">
      <div class="box box-info box-iframe">
        <div class="box-header with-border">
          <form class="form-horizontal" action="/master/cadastros/horarios/selectAll.php" method="POST">
            <div class="col-md-2 col-xs-3">
              <h3 class="box-title">
                <button type="button" onclick="window.location='/master/cadastros/horarios/insert.php';" class="btn btn-info">
                  Cadastrar Horário
                </button>
              </h3>
            </div>
            <div class="col-md-7 col-xs-4">
              <h3 class="box-title">
                <button type="button" onclick="window.location='/master/cadastros/horarios/select.php';" class="btn btn-warning">
                  Cadastros de Hoje
                </button>
              </h3>
            </div>
            <div class="col-md-3 col-xs-5 input-group">
              <input id="data" class="form-control" maxlength="10" name="data" type="text" placeholder="Data">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-success">Buscar</button>
              </span>
            </div>
          </form>
        </div>
        <div class="box-body">
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12"  style="height: 75vh; overflow-y: scroll;">
                <table class="table table-bordered table-hover dataTable" role="grid">
                  <thead>
                    <tr role="row">
                      <th class="col-md-3 col-xs-3">Turma</th>
                      <th class="col-md-2 col-xs-2">Professor</th>
                      <th class="col-md-2 col-xs-2">Sala</th>
                      <th class="col-md-2 col-xs-2">Tipo</th>
                      <th class="col-md-2 col-xs-2">Turno</th>
                      <th class="col-md-1 col-xs-1"></th>
                      <th class="col-md-1 col-xs-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if($result != false && $erro == false) {
                        foreach($result as $row) {
                          $turma = $turmaDao->searchById($row['idTurma'])['nome'];
                          $prof = $professorDao->searchById($row['idProfessor'])['nome'];
                          $sala = $salaDao->searchById($row['idSala'])['nome'];
                          $tipo = $tipoDao->searchById($row['idTipo'])['nome'];
                          $turno = $row['turno'];
                          echo '<tr role="row">';
                          echo '  <td>'.$turma.'</td>';
                          echo '  <td>'.$prof.'</td>';
                          echo '  <td>'.$sala.'</td>';
                          echo '  <td>'.$tipo.'</td>';
                          echo '  <td>'.$turno.'</td>';
                          echo '  <td><center><a href="/master/cadastros/horarios/update.php?id='.$row['id'].'" class="btn btn-warning">Editar</a></center></td>';
                          echo '  <td><center><a href="/master/cadastros/horarios/php/deleteControl.php?id='.$row['id'].'" class="btn btn-danger">Apagar</a></center></td>';
                          echo '</tr>';
                        }
                      } else if($result != false) {
                        echo '<script>alert("Erro: "'.$result.')</script>';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<script>
  $('#data').mask('00/00/0000');
  $("#data").datepicker({
    dateFormat: "dd/mm/yy",
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
  });

</script>