<?php
  session_start();
  if(ISSET($_SESSION['login'])) Header("Location: ../master/");
  else if(!ISSET($_SESSION['unidade'])) {
    session_destroy();
    Header('Location: ../');
  }
  
  if(ISSET($_GET['erro'])) {
    $erro = $_GET['erro'];
    if($erro == 1) {
     echo '<script>alert("Login ou senha incorretos!")</script>'; 
    }
  }
  include_once("lib/head.php");
?>

<!DOCTYPE html>

<head>
  <title>Login</title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script type="text/javascript" src="../dist/bootstrap/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../dist/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/root.css">
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="offset-sm-3 col-sm-6 col-12">
        <div class="card p-5 t-10 bg-dark text-light">
          <div class="card-head">
  				  <h1 class="text-center">Login</h1>
          </div>
          
          <div class="card-body">
    			  <form action="php/loginControl.php" method="POST">
    				  <input class="form-control" type="text" name="login" placeholder="Login">

    				  <input class="form-control" type="password" name="senha" placeholder="Senha">
              
              <div class="row">
                <div class="col-6">
                  <button class="btn btn-danger btn-block" type="button" onclick="window.location = 'php/logoutControl.php'">Voltar</button>
                </div>

                <div class="col-6">
      				    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>
              </div>
    			  </form>
          </div>
        </div>
			</div>
    </div>
  </div>
</body>

</html>