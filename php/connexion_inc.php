<?php

/*
 * création d'objet PDO de la connexion qui sera représenté par la variable $cnx
 */
$user = 'maryam.consani'; // A COMPLETER
$pass = 'ryrybdd';// A COMPLETER

try {
    $cnx = new PDO('pgsql:host=sqletud.u-pem.fr;dbname=maryam.consani_db',
    $user,
    $pass);
    $requete = 'SET search_path TO bliblou';
    $result = $cnx -> exec($requete);
    
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
