<!-- nie działa -->

<?php
    session_start();
    //sprawdzenie czy wszystkie pola zostały wypełnione
    if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['image'])) {
        
        $error=0;

        //zapisanie danych z formularza do zmiennych
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];

        //nawiązanie połączenia z bazą - wyświetlenie błędu w razie problemów
        require_once './connect.php';
        if($conn->connect_errno){
            $_SESSION['error'] = 'Nie można połączyć się z bazą';
            header('location: ../index.php');
            exit();
        }
        
        //stworzenie polecenia - wprowadzenie danych z formularza do bazy
        $sql = "INSERT INTO `produkty`(`name`, `price`, `image`) VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sdb', $name, $price, $image);

        //jeżeli polecenie się wykonało - przejście do strony logowania
        if($stmt->execute()){
            $conn->close();
            $stmt->close();
            //header('location: ../login_page.php/?register=success');
            header('location: ./add_product.php');
            //exit();
            $_SESSION['error'] = 'Dodano';
        }

        //zamknięcie połączenia z bazą
        $conn->close();
        $stmt->close();
        
        //powrót do poprzedniej strony
        /*?>
            <script>
                history.back();
            </script>
        <?php*/

    }
    //powrót do porzedniej strony i wyświetlnie błedu o nieuzupełnionym formularzu
    else{
        $_SESSION['error'] = 'Wypełnij wszystkie pola!';
        ?>
            <script>
                history.back();
            </script>
        <?php
    }
?>