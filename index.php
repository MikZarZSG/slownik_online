<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Słownik online - panel logowania</title>
</head>
<body>
    <h1>Zaloguj się</h1>
    
    <form action="login.php" method="post">
        <div><label for="login">Login:</label></div>
        <div><input type="text" name="login" id="login"></div>
        
        <div><label for="haslo">Hasło:</label></div>
        <div><input type="password" name="haslo" id="haslo"></div>
        
        <div><input type="submit" value="Zaloguj się"></div>
    </form>
</body>
</html>