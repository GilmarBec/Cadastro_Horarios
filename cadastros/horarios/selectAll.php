<?php
  include_once('../../lib/head.php');

  include_once('../../lib/conexao.php');

  include_once('../../dao/horarioDao.php');
  include_once('../../dao/turmaDao.php');
  include_once('../../dao/professorDao.php');
  include_once('../../dao/salaDao.php');
  include_once('../../dao/tipoDao.php');
  
  $conexao = new Conexao();

  $horarioDao = new HorarioDao($conexao);
  $turmaDao = new TurmaDao($conexao);
  $professorDao = new ProfessorDao($conexao);
  $salaDao = new SalaDao($conexao);
  $tipoDao = new TipoDao($conexao);
  
  if(isset($_GET['erro'])) {
    echo '<script>alert("Erro: "'.$_GET['erro'].');</script>';
  }

  $result = $horarioDao->select();

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
</head>

<body>
  <div class="container_fluid container-iframe">
    <div class="row">
      <div class="box box-info box-iframe">
        <div class="box-header with-border">
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