<!-- nie działa -->

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
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=MuseoModerno:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../main.css">
</head>
<body class="hold-transition register-page">
  <div class="register-box">

        <!-- Interaktywny przycisk logo sklepu -->
      <a class="logo" href="../index.php">FutureDesk</a> 
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

        <p class="login-box-msg">Zarejestruj się</p>

        <!-- Formularz rejestracji - Imie, Nazwisko, 2x email, 2x hasło, przycisk z warunkami rejestracji  -->
        <form action="../scripts/add_product.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nazwa produktu" name="name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cena" name="price">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="file" class="form-control" name="image">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Dodaj produkt</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

</body>
</html>
