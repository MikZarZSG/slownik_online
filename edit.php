<?php
    //Działanie zmiennych sesyjnych
    session_start();

    //Przekierowanie w przypadku, gdy użytkownik NIE jest zalogowany
    if(!isset($_SESSION['czy_zalogowany']) || !$_SESSION['czy_zalogowany']) {
        header('Location: index.php');
        exit();
    }
    
    //Przekierowanie w przypadku braku zmiennej GET
    if(!isset($_GET['id'])) {
        header('Location: panel.php');
        exit();
    }
    
    echo $_GET['id'];
?>