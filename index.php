<?php
  session_start();
  //blokada przed wejściem na strone bez uprawnień
  if(isset($_SESSION['logged']['email'])){
    header('location: ./scripts/login.php');
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
  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=MuseoModerno:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./main.css">
</head>
<body class="hold-transition register-page">
    <header>
      <a class="logo" href="./index.php">FutureDesk</a>
      <form action="./pages/cart.php" method="post">
        <input type='submit' class="koszyk" name='product' value='Koszyk'>
      </form>
      <a href="./login_page.php"><button class = "zaloguj">Zaloguj</button></a>
      <a href="./register.php"><button class = "zarejestruj">Zarejestruj</button> </a>
    </header>
    <div class= "content">
        <?php
        //łączenie się z bazą i sprawdzenie czy działa
        require_once './scripts/connect.php';
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
        echo  '<form action="" class = "produkt" method="post">';
          $num=0;
          for($ci=0; $ci<4; $ci++){
            for($c=0; $c<2; $c++){
              echo "<br>";
              echo '<img id="img1" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';

              echo  " ", $name, " ", $price, " zł";

              echo "<input  type='submit' class = 'kup' name='product' value='KUP'";
              $num++;
            }
            echo "<br>";
          }
          
        //zapisanie dodanego produktu w zmiennej sesyjnej
        echo "</form>";
        if(isset($_POST['product'])){
          $product = $_POST['product'];
          if(!isset($_SESSION['product'][$product])) $_SESSION['product'][$product] = 1;
          else $_SESSION['product'][$product]++;
        }

        //zamknięcie połączenia z bazą
        $stmt->close();
        $conn->close();
      ?>
    </div>
</body>
</html>
