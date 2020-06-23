<?php
    session_start();
    //blokada przed wejściem na strone bez uprawnień
    if($_SESSION['logged']['permission'] != 2){
        header('location: ../scripts/login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=MuseoModerno:wght@300&display=swap" rel="stylesheet">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gamer Shop | Home</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../main.css">
</head>
<body class="hold-transition register-page">
  <div class="home-box">
    <header>
      <a class="logo" href="./index.php">FutureDesk</a>
      <!-- Przycisk koszyka -->
      <form action="../pages/cart.php" method="post">
        <input type='submit' class="koszyk" name='product' value='Koszyk'>       
      </form>
      <div class = "user">Witaj : <?php echo $_SESSION['logged']['name']; ?></div>
      
      <a href="../scripts/logout.php"><button class = "zarejestruj">Wyloguj</button></a>
    </header>

  </div>

  <?php
    //łączenie się z bazą i sprawdzenie czy działa
    require_once '../scripts/connect.php';
    if($conn->connect_errno){
        $_SESSION['error'] = 'Błąd łączenia z bazą danych!';
        exit();
    }
    
    echo '<form action="./user.php?-Krzesla" method="post">';
      echo "<input type='submit' class = 'zarejestruj' name='chairs' value='Krzesła'>";
    echo '</form>';
    echo '<form action="./user.php?-Sluchawki" method="post">';
      echo "<input type='submit' class = 'zarejestruj' name='headphones' value='Słuchawki'>";
    echo '</form>';
    echo '<form action="./user.php?-Biurka" method="post">';
      echo "<input type='submit' class = 'zarejestruj' name='desks' value='Biurka'>";
    echo '</form>';

    //zapytanie zwracające produkty
    if((strpos($_SERVER['REQUEST_URI'], "?-Krzesla")) || (strpos($_SERVER['REQUEST_URI'], ".php"))){
      $sql = "SELECT  id, name, price, image FROM `produkty` WHERE id = '1'";
    }
    if((strpos($_SERVER['REQUEST_URI'], "?-Sluchawki"))){
      $sql = "SELECT  id, name, price, image FROM `produkty` WHERE id = '2'";
    }
    if((strpos($_SERVER['REQUEST_URI'], "?-Biurka"))){
      $sql = "SELECT  id, name, price, image FROM `produkty` WHERE id = '3'";
    }
      $stmt = $conn->prepare($sql);
      $stmt->bind_result($id, $name, $price, $image);
      $stmt->execute();
      $stmt->fetch();
      //header("Content-type: image/png");
      $tab_name = explode(" ", $name);

    //pętla do wyświetlenia tego samego produktu 9x / dodawanie do koszyka - trzeba to wpakować w jakieś divy
    echo  '<form action="" method="post">';
      $num=0;
      for($ci=0; $ci<3; $ci++){
          echo "<br>";
          echo '<img id="img1" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
          echo  " ", $num, " ", $id, " ", $name, " ", $price, " ";
          echo "<input type='submit' name='product' value='$tab_name[0], $num'";
          $num++;
        echo "<br>";
      }
    echo "</form>";

    //zapisanie dodanego produktu w zmiennej sesyjnej
    if(isset($_POST['product'])){
      $product = $_POST['product'];
      if(!isset($_SESSION['product'][$product])) $_SESSION['product'][$product] = 1;
      else $_SESSION['product'][$product]++;
    }

    //zamknięcie połączenia z bazą
    $stmt->close();
    $conn->close();
  ?>

</body>
</html>
