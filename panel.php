<?php
    //Działanie zmiennych sesyjnych
    session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Słownik online</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>Witaj!</p>
    
    <?php
        echo "<p>${_SESSION['id']}</p>";
        echo "<p>${_SESSION['login']}</p>";
    ?>
    
    <p><a href="logout.php">Wyloguj się</a></p>
</body>
</html>