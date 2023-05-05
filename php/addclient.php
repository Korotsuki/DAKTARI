<?php

include('connexion_inc.php');


// Requête SQL pour insérer dans d_client
$cnx->exec("BEGIN;"); //Début transaction
$req=$cnx->prepare("INSERT INTO d_client VALUES (DEFAULT,?,?,?,?)"); //CodeCli, Nom, Prenom, Adresse,Telephone
$req->execute(array($_POST['nom'],$_POST['prenom'],$_POST['adresse'],$_POST['num'])); // Remplace ? par les valeurs entrées


// Requête SQL pour insérer dans d_login
$req2=$cnx->prepare("INSERT INTO d_login VALUES (?,?,DEFAULT)"); //ID, Mot de passe, Codecli
$req2->execute(array($_POST['id'],$_POST['mdp'])); // Remplace ? par les valeurs entrées

$cnx->exec("COMMIT;"); //Fin transaction

header('Location: ../connexion.php?newAccount=1');


?>
