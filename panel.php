<?php
    //Działanie zmiennych sesyjnych
    session_start();

    //Przekierowanie w przypadku, gdy użytkownik NIE jest zalogowany
    if(!isset($_SESSION['czy_zalogowany']) || !$_SESSION['czy_zalogowany']) {
        header('Location: index.php');
        exit();
    }

    //Dodawanie danych do BD
    if(isset($_POST['slowo'])) {
        try {
            //Połączenie z BD
            require_once 'dbconn.php';
            $polaczenie = new mysqli($host, $user, $pass, $db);
            
            //Błąd połączenia
            if($polaczenie->connect_error) {
                throw new Exception($polaczenie->connect_error);
            }
            
            //Pobranie potrzebnych danych
            $id_u = $_SESSION['id_u'];
            $slowo = $_POST['slowo'];
            $tlumaczenie = $_POST['tlumaczenie'];
            $notatka = $_POST['notatka'];
            
            //Zapytanie SQL - wstawienie nowego rekordu
            $sql = "
            INSERT INTO Slowa (id_uzytkownik, slowo, tlumaczenie, notatka)
            VALUES ($id_u, '$slowo', '$tlumaczenie', '$notatka')";
            
            //Status dodawania rekordu do BD
            //Dodano rekord
            if($polaczenie->query($sql)) {
                $_SESSION['status'] = '<span class="sukces">Pomyślnie dodano rekord</span>';
            } 
            //Problem z dodaniem rekordu
            else {
                $_SESSION['status'] = '<span class="error">Problem z dodaniem rekordu!</span>';
            }
            
            //Zamknięcie połączenia
            $polaczenie->close();
        }
        //Wyjątki
        catch(Exception $e) {
            echo '<span class="error">' . $e . '</span>';
        }
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
    <h2>Słownik online - panel użytkownika</h2>
    
    <?php
        //Powitanie użytkownika
        $login = $_SESSION['login'];
        echo '<p>Witaj <b>' . $login . '</b> | <a href="logout.php">Wyloguj się</a></p>';
    
        //Status dodania rekordu
        if(isset($_SESSION['status'])) {
            echo $_SESSION['status'];
            unset($_SESSION['status']);
        }
    ?>
    
    <h2>Dodaj słowo</h2>
    <form action="panel.php" method="post">
        <div><label for="slowo">Słowo:</label></div>
        <div><input type="text" name="slowo" id="slowo" required></div>
        
        <div><label for="tlumaczenie">Tłumaczenie:</label></div>
        <div><input type="text" name="tlumaczenie" id="tlumaczenie" required></div>
        
        <div><label for="notatka">Notatka:</label></div>
        <div><input type="text" name="notatka" id="notatka" size="50"></div>
        
        <div><input type="submit" value="Dodaj"></div>
    </form>
    
    <?php
        try {
            //Połączenie z BD
            require_once 'dbconn.php';
            $polaczenie = new mysqli($host, $user, $pass, $db);

            //Błąd połączenia
            if($polaczenie->connect_error) {
                throw new Exception($polaczenie->connect_error);
            }
            
            //Pobranie potrzebnych danych
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
    <h2>Lista słów</h2>
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
echo<<<END
    <tr>
        <td>${wiersz['slowo']}</td>
        <td>${wiersz['tlumaczenie']}</td>
        <td>${wiersz['notatka']}</td>
        <td><a href="edit.php?id=${wiersz['id']}">Edytuj</a></td>
        <td><a href="delete.php?id=${wiersz['id']}">Usuń</a></td>
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