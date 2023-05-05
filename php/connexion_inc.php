<?php

/*
 * création d'objet PDO de la connexion qui sera représenté par la variable $cnx
 */
$user = 'coucou :3'; // A COMPLETER
$pass = 'E: uocuoc';// A COMPLETER
try {
    $cnx = new PDO('pgsql:host=sqletud.u-pem.fr;dbname=maryam.consani_db',
    $user,
    $pass);
    $cnx->exec("SET SEARCH_PATH TO bliblou;");*/
    
}
catch (PDOException $e) {
    //echo "ERREUR : La connexion a échouée";
    echo "ERREUR: La connexion a échouée... :c";

 /* Utiliser l'instruction suivante pour afficher le détail de erreur sur la
 * page html. Attention c'est utile pour débugger mais cela affiche des
 * informations potentiellement confidentielles donc éviter de le faire pour un
 * site en production.*/
//    echo "Error: " . $e;

}

?>
