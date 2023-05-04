<?php
  if(isset($_POST['bouton-valider'])) {
  
  //Vérification des infos du formulaire 
  if(isset($_POST['email'] && isset($_POST['mdp']))) {
      $email = $_POST['email'];
      $mdp = $_POST['mdp'];
      //connextion à la base de données
      $nomserv = "localhost";
      $utilisateur = "root";
      $mdp = "";
      $nombdd = "form";
      $connex = mysqli_connect($nomserv, $utilisateur, $mdp, $nombdd)
      //requete pour sélectionner l'utilisateur qui a pour mail et mdp les identifiants qui ont été entrées 
      $req = mysqli_query($connect, "SELECT * FROM utilisateurs WHERE email='$email' AND mdp='$mdp'");
      
  }
  }
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Connexion</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon.ico">
    <meta name="Author" content="Hélèna/Maryam">
    <meta name="Keywords" content="DAKTARI">
    <style>
      *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: yellow;
      }
      section{
        background-color: #fff;
        padding: 10px;
        display: flex;
        flex-direction: column;
        width: 400px;
        border-radius: 6px;
      }
      section h1{
        text-align: center;
      }
      form{
        display: flex;
        flex-direction: column;
      }
      form input{
        margin: 5px 0;
        padding: 5px 5px;
        outline: 0;
        border: 1px solid #000;
        border-radius: 6px;
      }
      form input[type='submit']{
        background-color: greenyellow;
        border: 0;
        color: #fff;
        margin-top: 15px;
        padding: 6px 0;


      }
    </style>
  </head>

  <body>
      <section>
        <h1>Connexion</h1>
        <form action="" method="POST">
          <label>Adresse Mail</label>
          <input type="text" name="email">
          <label>Mot De Passe</label>
          <input type="password" name="mdp">
          <input type="submit" value="Valider" name="bouton-valider">
        </form>
      </section>
  </body>
</html>