<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Gamer Shop | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./main.css">
</head>
<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <!-- Interaktywny przycisk logo sklepu -->
      <a href="./"><b>Gamer </b>Shop</a>
    </div>


    <?php
      //wyświetlanie błędów zwróconych ze skryptu add_user.php
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

    <div class="card-register">
      <div class="register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <!-- Formularz rejestracji - Imie, Nazwisko, 2x email, 2x hasło, przycisk z warunkami rejestracji  -->
        <form action="../scripts/add_user.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Imie" name="name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nazwisko" name="surname">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email1">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Retype Email" name="email2">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="pass1">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Retype password" name="pass2">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                I agree to the <a href="./terms.html">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        
        <!-- Link - "już mam konto" -->
        <a href="./login_page.php" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

</body>
</html>
