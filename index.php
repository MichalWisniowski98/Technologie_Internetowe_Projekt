<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gamer Shop | Home</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- CSS Main-->
  <link rel="stylesheet" href="./main.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../"><b>Gamer </b>Shop</a>
  </div>


  

  <div class="card">
        <a href="./login.php" class="text-center">Login</a>
  </div>
</div>

<?php
  require_once './connect.php';
  if($conn->connect_errno){
    $_SESSION['error'] = 'Awaria bazy danych!';
    exit();
  }

  $sql = "SELECT  id, name, price, image FROM `produkty`";
  $stmt = $conn->prepare($sql);
  //$stmt->bind_param('s', $name);
  //$stmt->bind_param('i', $id);
  $stmt->bind_result($id, $name, $price, $image);
  //$stmt->bind_param("d", $price);
  $stmt->execute();
  //$stmt->bind_result($district);
  $stmt->fetch();
  echo  "<br>", $id, " ", $name," ", $price;
  //header("Content-type: image/png");
  echo '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
  //$num = mysql_numrows($stmt);
  //echo mysql_resut($stmt, 1, 1);
  if($conn->affected_rows){
    $_SESSION['error'] = 'Podanu adres email istnieje w bazie dancyh';
  }
  $stmt->close();
  $conn->close();
?>

</body>
</html>
