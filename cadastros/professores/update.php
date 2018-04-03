<?php
  include_once('../../lib/head.php');
  include_once('../../lib/conexao.php');
  include_once('../../dao/professorDao.php');
  
  $conexao = new Conexao();
  $professorDao = new ProfessorDao($conexao);

  $id = $_GET['id'];

  $search = $professorDao->searchById($id);

  if(ISSET($_GET['r'])) {
    $r = $_GET['r'];
    if(ISSET($_GET['erro'])) $erro = $_GET['erro'];
    
    if($r == 1) {
      Header('location: select.php');
    } else if($r == 2) {
      echo '<script>alert("Professor já cadastrado!")</script>';
    } else if($r == 3) {
      echo '<script>alert("Erro: '.$erro.'")</script>';
    }
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
          <h3 class="box-title"><span class="label label-info">Editar cadastro de Professores</span></h3>
        </div>
        <form class="form-horizontal" action="/master/cadastros/professores/php/updateControl.php?id=<?php echo $id; ?>" method="POST">
          <div class="box-body">
            <div class="form-group">
              <label for="inputNome" class="col-sm-2 control-label">Nome</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNome" name="nome" placeholder="Nome">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="button" onclick="window.location='/master/cadastros/professores/select.php';" class="btn btn-danger">Cancel</button>
            <button type="submit" class="btn btn-info pull-right">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>

<script>
  document.getElementById('inputNome').focus();

  <?php
    echo 'var nome = "'.$search['nome'].'";';
  ?>
  
  $("#inputNome").val(nome);
</script>