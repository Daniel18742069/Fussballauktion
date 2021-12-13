<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fussballauktion</title>
    <link rel="stylesheet" href="style.css" media="screen" />
</head>
<body>

    <form>
    <div id="gesamt">
        
        <div id="kopf">
            <h1>Fußballauktion</h1>
        </div>
        
        <div id="menu">
      /**    <?php
                /**
                 * Zeige das Login-Formular, wenn der Benutzer noch nicht eingeloggt ist,
                 * ansonsten das Hauptmenu.
                 */	 
                if (ist_eingeloggt()) {
				    require '/PHP/hauptmenu.php';
                } else {

                    if(!empty($_GET['fehler'])) {?>

                        <p><?php echo $_GET['fehler'] ?></p>
                
                    <?php }
                    
                	require 'login.php';
                        
                } 

            ?>
            */  
        </div>
        
        <div id="fuss">
            Das ist das Ende
        </div>
            
    </div>
    </form>

</body>
</html>