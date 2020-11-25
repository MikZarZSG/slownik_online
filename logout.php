<?php
    //Działanie zmiennych sesyjnych
    session_start();
    
    //Wylogowanie - zniszczenie zmiennych sesyjnych
    session_destroy();
    
    //Przekierowanie do panelu logowania
    header('Location: index.php');
?>