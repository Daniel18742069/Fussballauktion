<?php

function ist_eingeloggt() {
    $erg = false;
    if (isset($_SESSION['eingeloggt'])) {
        if (!empty($_SESSION['eingeloggt']))
            $erg = true;
    }
    return $erg;
}


function getDB() {

$db = new PDO('mysql:host=localhost;dbname=mydb', 'auktion', 'Lbshi-12345');

if(!$db) {

    echo "Keine Verbindung zu MySQL";
    var_dump($db->errorinfo());
}

return $db;

}

getDB();

?>