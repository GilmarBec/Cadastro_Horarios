<?php
  session_start();
  $logado = false;
  if(ISSET($_SESSION['login'])) $logado = true;
  else {
  	session_destroy();
  	echo '<script>window.location.href = "/master/login.php";</script>';
  }
?>