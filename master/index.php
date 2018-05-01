<?php
  include_once("lib/session.php");
  include_once("lib/head.php");
  include_once("lib/navbar.php");
?>

<!DOCTYPE html>

<head>
  <?php ativarHead(); ?>
</head>

<body>
  <div class="container">
    <?php navbar("home",$logado); ?>
    
    <div class="row gutter">
        <div class="box box-dark">
        <div class="box-body">
          <center><h1 class="sem-horarios">Bem vindo ao Quadro de Horários!</h1></center>
        </div>
      </div>
    </div>
  </div>
</body>

</html>