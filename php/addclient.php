<?php
include('connexion_inc.php');

try {
    do {
        // Génération de l'idclient unique de 8 caractères
        $idclient = generateUniqueID(8);

        // Vérification de l'unicité de l'idclient
        $reqCheck = $cnx->prepare("SELECT COUNT(*) FROM d_client WHERE idclient = ?;");
        $reqCheck->execute(array($idclient));
        $count = $reqCheck->fetchColumn();
    } while ($count > 0);

    echo $idclient;
    $stmt = $cnx->prepare("INSERT INTO d_client VALUES (?,?,?,?,?)");
    $stmt->execute([$idclient,$_POST['nom'],$_POST['prenom'],$_POST['adresse'],$_POST['num']]);

    $stmt = $cnx->prepare("INSERT INTO d_login VALUES (?,?,?,?)");
    $stmt->execute([$_POST['id'],$_POST['mdp'],'CLIENT',$idclient]);
    /*
    // Requête SQL pour insérer dans d_client
    $req = $cnx->prepare("INSERT INTO d_client (?)");
    if ($req->execute(array($idclient))) {
        echo "Données insérées dans d_client avec succès.";
    } else {
        $errorInfo = $req->errorInfo();
        echo "Erreur lors de l'insertion des données dans d_login : ";
        echo "Code d'erreur de la base de données : " . $errorInfo[0] . "<br>";
        echo "Code d'erreur de la requête SQL : " . $errorInfo[1] . "<br>";
        echo "Message d'erreur : " . $errorInfo[2];
    }

    // Requête SQL pour insérer dans d_login
    $req2 = $cnx->prepare("INSERT INTO d_login (?, ?, 'CLIENT', ?)");
    if ($req2->execute([$_POST['id'], $_POST['mdp'], $idclient])) {
        echo "Données insérées dans d_login avec succès.";
    } else {
        $errorInfo = $req2->errorInfo();
        echo "Erreur lors de l'insertion des données dans d_login : ";
        echo "Code d'erreur de la base de données : " . $errorInfo[0] . "<br>";
        echo "Code d'erreur de la requête SQL : " . $errorInfo[1] . "<br>";
        echo "Message d'erreur : " . $errorInfo[2];
    }

     Requête SQL pour insérer dans d_professionnel
    $req3 = $cnx->prepare("INSERT INTO d_professionnel VALUES (?, ?, ?);");
    $req3->execute(array($idclient, $_POST['iban'], $_POST['sitewebpro'])); // Remplace ? par les valeurs entrées
    */

    header('Location: ../connexion.html?newAccount=1');
    exit();

} catch (PDOException $e) {
    // Affichage du message d'erreur ou redirection vers une page d'erreur
    echo "Erreur : " . $e->getMessage();
    // header('Location: ../erreur.php');
    exit();
}

// Fonction pour générer une clé unique aléatoire
function generateUniqueID($length)
{
    $characters = '0123456789';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, 9)];
    }

    return $randomString;
}
?>