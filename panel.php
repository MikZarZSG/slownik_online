<?php
    //Działanie zmiennych sesyjnych
    session_start();

    //Przekierowanie w przypadku, gdy użytkownik NIE jest zalogowany
    if(!isset($_SESSION['czy_zalogowany']) || !$_SESSION['czy_zalogowany']) {
        header('Location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Słownik online</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>    
    <?php
        //Powitanie użytkownika
        $login = $_SESSION['login'];
        echo "<p>Witaj <b>$login</b></p>";
    ?>
    
    <p>
        <a href="logout.php">Wyloguj się</a>
    </p>
    
    <?php
        try {
            //Połączenie z BD
            require_once 'dbconn.php';
            $polaczenie = new mysqli($host, $user, $pass, $db);

            //Błąd połączenia
            if($polaczenie->connect_error) {
                throw new Exception($polaczenie->connect_error);
            }
            
            //Operacje na BD
            $id_u = $_SESSION['id_u'];
            
            //Zapytanie SQL - pobranie listy słów
            $sql = "
                SELECT id, slowo, tlumaczenie, notatka 
                FROM Slowa
                WHERE id_uzytkownik = $id_u";
            
            //Wykonanie zapytania
            $wynik = $polaczenie->query($sql);
            
            //Poprawnie wykonano zapytanie
            if($wynik) {
echo<<<END
    <table>
        <tr>
            <th>Słowo</th>
            <th>Tłumaczenie</th>
            <th>Notatka</th>
            <th>Edycja</th>
            <th>Usuń</th>
        </tr>
END;
                while($wiersz = $wynik->fetch_assoc()) {
                    //echo "<p>${wiersz['slowo']} | ${wiersz['tlumaczenie']}</p>";
                    
echo<<<END
    <tr>
        <td>${wiersz['slowo']}</td>
        <td>${wiersz['tlumaczenie']}</td>
        <td>${wiersz['notatka']}</td>
        <td><a href="#">Edytuj</a></td>
        <td><a href="#">Usuń</a></td>
    </tr>
END;
                }
echo<<<END
    </table>
END;
            }
            //Błąd w wykonaniu zapytania
            else {
                throw new Exception("Błąd wykonania zapytania");
            }
            
            //echo var_dump($wynik);
            
            //Zamknięcie połączenia
            $polaczenie->close();
        }
        //Wyjątki
        catch(Exception $e) {
            echo '<span class="error">' . $e . '</span>';
        }
    ?>
</body>
</html>