<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gamer Shop | Log in</title>
  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=MuseoModerno:wght@300&display=swap" rel="stylesheet">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./main.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">

    <div class="logo-button">
      <!-- Interaktywny przycisk logo sklepu -->
      <a class="logo" href="./index.php">FutureDesk</a>
    </div>

    <?php
    //do wyjebania?
      /*if(isset($_GET['register'])){
        echo<<<SUCCESS
        <div class="cinfo-box bg success">
          <div class="info-box-content">
            <h3 class="card-title">Prawidłowo dodano użykownika</h3>
          </div>
        <div
      SUCCESS;
      }*/

      //wyświetlanie błędów zwróconych ze skryptu login.php
      if(isset($_SESSION['error'])){
      echo<<<ERROR
        <div class="card card-outline card-danger">
          <div class="card-header">
            <h3 class="card-title">{$_SESSION['error']}</h3>
          </div>
        <div>
      ERROR;
      unset($_SESSION['error']);
      }
    ?>
    <!-- /.login-logo -->
      <div class="card-body login-card-body">
        <p class="login-box-msg">Zaloguj się by przejść do koszyka</p>

        <!-- Formularz logowania - email i hasło - brakuje przycisku "zapamiętaj mnie" - sprawdzić czy da się to ogarnąć -->
        <form action="./scripts/login.php" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="pass">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
             <!-- Sprawdzić czy da się jakoś zapisywać dane logowania żeby mogło pamiętać użytkownika na kompie
             <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            -->
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- Dwa linki - "zapomniałem hasła" i "załóż konto" -->
        <p class="mb-1">
          <a href="./pages/forgot_password.php">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href=".//register.php" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
  </div>
  <!-- /.login-box -->

</body>
</html>
