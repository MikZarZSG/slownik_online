<?php
    //Działanie zmiennych sesyjnych
    session_start();
    
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
        
        //Pomyślnie wykonano zapytanie
        if($wynik) {
            //Pomyślnie zalogowano
            if($wynik->num_rows > 0) {
                //Pobranie danych o użytkowniku do zmiennych sesyjnych
                $wiersz = $wynik->fetch_assoc();
                $_SESSION['id'] = $wiersz['id'];
                $_SESSION['login'] = $wiersz['login'];
                
                //Usunięcie komunikatu o błędzie
                if(isset($_SESSION['e_login'])) unset($_SESSION['e_login']);
                
                //Przekierowanie do panelu użytkownika
                header('Location: panel.php');
            }
            //Nieprawidłowa nazwa użytkownika lub hasło
            else {
                //Komunikat o błędzie
                $_SESSION['e_login'] =
                    '<span class="error">Nieprawidłowa nazwa użytkownika lub hasło!</span>';
                
                //Przekierowanie do panelu logowania
                header('Location: index.php');
            }
        } 
        //Błąd w wykonaniu zapytania
        else {
            throw new Exception("Niepoprawne zapytanie do bazy danych!");
        }
        
        //Zamknięcie połączenia
        $polaczenie->close();
    }
    //Wyjątki
    catch (Exception $e){
        echo '<span class="error">$e</span>';
    }

    
?>