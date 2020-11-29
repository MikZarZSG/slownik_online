<?php
    //Działanie zmiennych sesyjnych
    session_start();

    //Przekierowanie w przypadku, gdy użytkownik NIE jest zalogowany
    if(!isset($_SESSION['czy_zalogowany']) || !$_SESSION['czy_zalogowany']) {
        header('Location: index.php');
        exit();
    }
    
    //Wylogowanie - zniszczenie zmiennych sesyjnych
    session_destroy();
    
    //Przekierowanie do panelu logowania
    header('Location: index.php');
?>