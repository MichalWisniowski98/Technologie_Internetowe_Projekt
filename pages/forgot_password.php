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
    <link rel="stylesheet" href="../main.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
    <a class="logo" href="../index.php">FutureDesk</a>

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Podaj email</p>
                
                <!-- Odzyskiwanie hasła - okno do wpisania maila -->
                <form action="javascript:history.back()" method="post">
                    <div class="input-group mb-3">
                            <input required type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <!-- Komunikat o wysłaniu maila - reset -->
                        <div class="col-4">
                            <?php
                                $_SESSION['error'] = 'Link do zmiany hasła został wysłany na podany email';  
                            ?>
                            <button type="submit" class="btn btn-primary btn-block">Reset</button>
                        
                        </div>
                        <!-- /.col -->
                </form>
            </div>
        </div>
    </div>

</body>
</html>
