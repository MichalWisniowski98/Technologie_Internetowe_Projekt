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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gamer Shop | Home</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../main.css">
</head>
<body class="hold-transition register-page">
  <div class="home-box">
    <div class="logo">
      <!-- Interaktywny przycisk logo sklepu -->
      <a href="./user.php"><b>Gamer </b>Shop</a>
    </div>
    <?php
        //Wyświetlanie nazwy użytkownika - tu by trzeba było dać jakiś div żeby było oddzielone od reszty strony
        echo "Jesteś zalogowany jako ", $_SESSION['logged']['name'];
    ?>
    <div class="card">
        <!-- Przycisk Wyloguj -->
        <a href="../scripts/logout.php" class="text-center">Wyloguj</a>
    </div>
    <!-- Przycisk koszyka -->
    <form action="../pages/cart.php" method="post">
      <input type='submit' name='product' value='Koszyk'>
    </form>
  </div>

  <?php
    //łączenie się z bazą i sprawdzenie czy działa
    require_once '../scripts/connect.php';
    if($conn->connect_errno){
        $_SESSION['error'] = 'Błąd łączenia z bazą danych!';
        exit();
    }
    
    //zapytanie zwracające produkty
    $sql = "SELECT  id, name, price, image FROM `produkty`";
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
        for($c=0; $c<3; $c++){
          echo "<br>";
          echo '<img id="img1" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
          echo  " ", $num, " ", $id, " ", $name, " ", $price, " ";
          echo "<input type='submit' name='product' value='$tab_name[0], $num'";
          $num++;
        }
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
