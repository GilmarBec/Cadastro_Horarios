<?php
  include_once("lib/session.php");
  if(!$logado) Header("Location: ../master/");
  include_once("lib/navbar.php");
  include_once("lib/head.php");
?>

<!DOCTYPE html>

<head>
  <?php ativarHead(); ?>
</head>

<body style="overflow-y: hidden;">
  <div class="container">
    <?php navbar("importar",$logado); ?>
    
    <div class="row embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" id="iframeImportar" name="iframeImportar" src="/master/importar/"></iframe>
    </div>
  </div>
</body>

</html>