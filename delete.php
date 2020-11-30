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
    //Operacja usunięcia rekordu
    else {
        try {
            //Połączenie z BD
            require_once 'dbconn.php';
            $polaczenie = new mysqli($host, $user, $pass, $db);
            
            //Błąd połączenia
            if($polaczenie->connect_error) {
                throw new Exception($polaczenie->connect_error);
            }
            
            echo "Hello!";
            
            //Zamknięcie połączenia
            $polaczenie->close();
        }
        //Wyjątki
        catch(Exception $e) {
            echo '<span class="error">' . $e . '</span>';
        }
    }
?>