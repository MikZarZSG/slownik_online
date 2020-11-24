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
            throw new Exception($polaczenie->connect_error);
        }
        
        //Zapytanie SQL - pobranie użytkownika o podanych danych
        $sql = "
        SELECT id, login, haslo
        FROM Uzytkownicy
        WHERE
            BINARY login = '$login' AND
            BINARY haslo = '$haslo'";
        
        //Wykonanie zapytania SQL
        $wynik = $polaczenie->query($sql);
        
        //Czy zapytanie wykonało się poprawnie?
        if($wynik) {
            //Pomyślnie wykonano zapytanie
            //Czy zalogowano?
            if($wynik->num_rows > 0) {
                //Pomyślnie zalogowano
                echo "<p>Pomyślnie zalogowano</p>";
            } else {
                //Nieprawidłowa nazwa użytkownika lub hasło
                echo "<p>Nieprawidłowa nazwa użytkownika lub hasło!</p>";
            }
        } else {
            //Błąd w wykonaniu zapytania
            throw new Exception("Niepoprawne zapytanie do bazy danych!");
        }
        
        //Zamknięcie połączenia
        $polaczenie->close();
    }
    //Wyjątki
    catch (Exception $e){
        echo "<p>$e</p>";
    }

    
?>