<?php 
require "../Code/login/login.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" media="screen" />
    <title>Fussballauktion</title>
    <script src="https://kit.fontawesome.com/6016e9420e.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="logo">

        </div>

    </header>
    <div class="tabelle">
        <ul>
            <li class="masterRow">
                <span class="name">Name</span>
                <span class="Mannschaft">Mannschaft</span>
                <span class="position">Position</span>
                <span class="worth">Preis in <i class="fas fa-euro-sign"></i></span>
            </li>
            <li class="rows">
                <span class="name">Neri Filippo</span>
                <span class="Mannschaft">VENEZIA</span>
                <span class="position">G</span>
                <span class="worth">45,00 Mio. <i class="fas fa-euro-sign"></i></span>
            </li>
            <li class="rows">
                <span class="name">Neri Filippo</span>
                <span class="Mannschaft">VENEZIA</span>
                <span class="position">G</span>
                <span class="worth">45,00 Mio. <i class="fas fa-euro-sign"></i></span>
            </li>
        </ul>
    </div>
    <div class="login">
        <form action="#">
            <label for="teamname">Teamname</label><br>
            <input type="text" id="teamname" name="teamname" value=""><br>
            <label for="passwort">Passwort</label><br>
            <input type="text" id="passwort" name="passwort" value=""><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <footer>
        <p>Footer</p>
    </footer>
    <div>

    </div>
</body>

</html>