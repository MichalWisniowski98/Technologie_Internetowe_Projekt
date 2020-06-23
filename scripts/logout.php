<?php
    session_start();
    //sprawdzenie czy obecnie jest ktoś zalogowany - zamknięcie sesji
    if(isset($_SESSION['logged']['email'])){
        session_destroy();
        header("location: ../index.php");
        exit();
    }

    header('location: ../');
?>