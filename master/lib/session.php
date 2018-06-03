<?php
  session_start();
  $logado = false;
  if(ISSET($_SESSION['login'])) $logado = true;
  else {
  	echo '<script>window.location.href = "/master/login.php";</script>';
  }
?>