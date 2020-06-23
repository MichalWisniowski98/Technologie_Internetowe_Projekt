<?php
    session_start();

    //sprawdzenie czy ktoś jest zalogowany - jeżeli tak, przekierowanie na home screen danego użytkownika
    if(isset($_SESSION['logged']['email'])){
        if($_SESSION['logged']['permission'] == 1) header('location: ../logged/admin.php');
        if($_SESSION['logged']['permission'] == 2) header('location: ../logged/user.php');
    }
    else{
    
        //sprawdzenie czy wszystkie pola zostały wypełnione
        if(!empty($_POST['email']) && !empty($_POST['pass'])){

            //zapisanie danych z formularza do zmiennych
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            //nawiązanie połączenia z bazą
            require_once './connect.php';
            
            //sprawdzenie czy istnieje w bazie danych email podany przez użytkownika
            $sql = "SELECT * FROM `users` WHERE `email` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $error = 0;
            
            //adres email istnieje w bazie danych
            if($result->num_rows == 1){
                $user = $result->fetch_assoc();
                //echo $user['password'];

                //spradzenie czy podane hasło pasuje do tego w bazie
                if(password_verify($pass, $user['password'])){
                    
                    //zapisanie wyników zapytania do zmiennej sesyjnej
                    $_SESSION['logged']['name'] = $user['name'];
                    $_SESSION['logged']['surname'] = $user['surname'];
                    $_SESSION['logged']['email'] = $user['email'];
                    $_SESSION['logged']['permission'] = $user['permission_id'];
                    
                    //sprawdzenie uprawnien - 1 - Admin - 2 - User
                    switch($user['permission_id']){
                        case 1:
                            header('location: ../logged/admin.php');
                            break;
                        case 2:
                            header('location: ../logged/user.php');
                            break;
                    }
                    exit();
                }

                //hasło nie zgadza się z hasłem z bazy - wyświetlenie  błędu
                else{
                    $error = 1;
                    $_SESSION['error'] = "Błędny login lub hasło";
                }
            }

            //adresu nie ma w bazie - wyświetlnie błedu
            else{
                $error = 1;
                $_SESSION['error'] = "Błędny login lub hasło";
            }

            //jeżeli wystąpił błąd - przejście do poprzeniej strony i wyświetlenie błędu
            if($error == 1){
                //exit();
                ?>
                    <script>
                        history.back();
                    </script>
                <?php
            }
        }

        //powrót do porzedniej strony i wyświetlnie błedu o nieuzupełnionym formularzu
        else{
            $_SESSION['error'] = 'Wypełnij wszystkie pola';    
            ?>
                <script>
                    history.back();
                </script>
            <?php
        }
    }
?>