<?php
    //Działanie zmiennych sesyjnych
    session_start();

    //Przekierowanie w przypadku, gdy użytkownik jest już zalogowany
    if(isset($_SESSION['czy_zalogowany']) && $_SESSION['czy_zalogowany']) {
        header('Location: panel.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Słownik online - panel logowania</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Słownik online - zaloguj się</h2>
    
    <form action="login.php" method="post">
        <div><label for="login">Login:</label></div>
        <div><input type="text" name="login" id="login"></div>
        
        <div><label for="haslo">Hasło:</label></div>
        <div><input type="password" name="haslo" id="haslo"></div>
        
        <div><input type="submit" value="Zaloguj się"></div>
        
        <?php
            if(isset($_SESSION['e_login'])) {
                echo $_SESSION['e_login'];
                unset($_SESSION['e_login']);
            } 
        ?>
    </form>
</body>
</html>