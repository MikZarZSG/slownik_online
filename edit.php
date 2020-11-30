<?php
    //Działanie zmiennych sesyjnych
    session_start();
    
    //Operacja - Edycja słowa
    if(isset($_POST['slowo'])) {
        echo "<p>${_POST['slowo']}</p>";
        echo "<p>${_POST['tlumaczenie']}</p>";
        echo "<p>${_POST['notatka']}</p>";
    }

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
    //Pobranie danych do formularza
    else {
        echo $_GET['id'];
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
    <h2>Edytuj słowo</h2>
    <form action="edit.php" method="post">
        <div><label for="slowo">Słowo:</label></div>
        <div><input type="text" name="slowo" id="slowo" required></div>
        
        <div><label for="tlumaczenie">Tłumaczenie:</label></div>
        <div><input type="text" name="tlumaczenie" id="tlumaczenie" required></div>
        
        <div><label for="notatka">Notatka:</label></div>
        <div><input type="text" name="notatka" id="notatka" size="50"></div>
        
        <div><input type="submit" value="Edytuj"></div>
    </form>
</body>
</html>