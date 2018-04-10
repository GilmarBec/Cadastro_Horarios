<?php
  include_once("../lib/session.php");
  
  include_once("../lib/head.php");
  include_once("../lib/navbar.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
	<?php ativarHead(); ?>
</head>
<body style="overflow-y: hidden;">
	<div class="container">
		<?php navbar("settings",$logado); ?>

		<div class="row embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" id="iframeSettings" name="iframeSettings" src="/master/settings/selectUsers.php"></iframe>
    </div>
	</div>
</body>
</html>