<?php
    session_start();
    //sprawdzenie czy wszystkie pola zostały wypełnione
    if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email1']) && !empty($_POST['email2']) && !empty($_POST['pass1'])
    && !empty($_POST['pass2'])) {
        
        $error=0;

        if(!isset($_POST['terms'])){
            $error=1;
            $_SESSION['error'] = 'Zaznacz regulamin';
        }
        
        if($_POST['pass1'] != $_POST['pass2']){
            $error=1;
            $_SESSION['error'] = 'Hasła są różne';
        }
        
        if($_POST['email1'] != $_POST['email2']){
            $error=1;
            $_SESSION['error'] = 'Adresy email się nie zgadzają';
        }
        
        //jeżeli któreś z pól zostało źle wypełnione wraca do poprzedniej stroy i wyświetla jeden w powyższych komunikatów
        if($error != 0){
            ?>
                <script>
                    history.back();
                </script>
            <?php
            exit();
        }

        //zapisanie danych z formularza do zmiennych
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $pass1 = $_POST['pass1'];
        $email1 = $_POST['email1'];

        //szyfrowanie hasła za pomocą Argon2ID
        $pass = password_hash($pass1, PASSWORD_ARGON2ID);

        //nawiązanie połączenia z bazą - wyświetlenie błędu w razie problemów
        require_once './connect.php';
        if($conn->connect_errno){
            $_SESSION['error'] = 'Nie można połączyć się z bazą';
            header('location: ../register.php');
            exit();
        }
        
        //stworzenie polecenia - wprowadzenie danych z formularza do bazy
        $sql = "INSERT INTO `users`(`name`, `surname`, `email`, `password`) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $name, $surname, $email1, $pass);

        //jeżeli polecenie się wykonało - przejście do strony logowania - trzeba zmienić żeby wyświetlało komunikat o sukcesie
        if($stmt->execute()){
            $conn->close();
            $stmt->close();
            //header('location: ../login_page.php/?register=success');
            header('location: ../login_page.php');
            //exit();
            $_SESSION['error'] = 'Rejestracja zakończona powodzeniem';
        }

        //sprawdzenie czy istnieje w bazie danych email podany przez użytkowanika
        else{
            $sql = "SELECT * FROM `users` WHERE `email` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email1);
            $stmt->execute();

            //podany adres jest już w bazie
            if($conn->affected_rows){
                $_SESSION['error'] = 'Podany adres email jest już przypisany do konta';
            }
            else{
                $_SESSION['error'] = "Nie dodano użytkowanika do bazy danych";
            }
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