<?php
    //Pobranie loginu i hasła z formularza
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    try {
        //Połączenie z BD
        require_once 'dbconn.php';
        $polaczenie = new mysqli($host, $user, $pass, $db);
        
        //Błąd połączenia
        if($polaczenie->connect_error) {
            throw new Exception ($polaczenie->connect_error);
        }
        
        //Zapytanie SQL - pobranie użytkownika o podanych danych
        $sql = "
        SELECT id, login, haslo
        FROM Uzytkownicy
        WHERE
            BINARY login = '$login' AND
            BINARY haslo = '$haslo'";
        
        $wynik = $polaczenie->query($sql);
        
        echo $wynik->num_rows;
        
        //Zamknięcie połączenia
        $polaczenie->close();
    }
    //Wyjątki
    catch (Exception $e){
        echo "<p>$e</p>";
    }

    
?>