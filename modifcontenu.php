<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css" />
        <title>Modification Contenu</title>
        <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon.ico">
        <META NAME="Author" CONTENT="Hélèna/Maryam">
        <META NAME="Keywords" CONTENT="DAKTARI">
    </head>
    <body>

        <!-- Code du haut de page -->
        <nav class="NAVBAR">
            <div class="scroll"></div>
            <div class="DAKTARI">
                <a href="./index.php"><img src="./img/daktari.png" alt="DAKTARI"></a>
            </div>
            <div class="NAVI">
                <ul class="menu">
                    <?php
                    include("./php/connexion_inc.php");
                    include("./php/connexion_utilisateur.php");
                    $resultat = $cnx->prepare("SELECT nompage FROM d_droits WHERE acces=:acces ORDER BY nompage DESC");
                    $resultat->execute(array(':acces' => $_SESSION['acces']));
                    if ($resultat->rowCount() > 0) {
                        while ($ligne = $resultat->fetch(PDO::FETCH_OBJ)) {
                            echo '<li class="item"><a href="./'.$ligne->nompage.'.php">'.$ligne->nompage.'</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </nav>

        <!-- Contenu de la page -->
        <?php include('contenu.php'); ?>
        <div class="container">
            <div class="modif">
                <h1>Modification du contenu</h1>
                <br>
                <form action="contenu.php" method="POST">
                <fieldset>
                    <legend>Contenu de la Page d'accueil</legend>
                    <label>Message d'accueil</label>
                    <input type="text" name="acceuil" value="<?php echo $acceuil ?>">
                    <br>
                    <label>Paragraphe 1</label>
                    <textarea rows="3" cols="150" name="phaa1"><?php echo $phaa1 ?></textarea>
                    <br>
                    <label>Paragraphe 2</label>
                    <textarea rows="3" cols="150" name="phaa2"><?php echo $phaa2 ?></textarea>
                    <br>
                    <label>Paragraphe 3</label>
                    <textarea rows="3" cols="150" name="phaa3"><?php echo $phaa3 ?></textarea>
                    <br>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Contenu de la Page Equipe</legend>
                    <label>Titre Equipe</label>
                    <input type="text" name="titreEquipe" value="<?php echo $titreEquipe ?>">
                    <br>
                    <label>Veterinaire</label>
                    <input type="text" name="pha1" value="<?php echo $pha1 ?>">
                    <label>Phrase d'accroche</label>
                    <input type="text" name="pha2" value="<?php echo $pha2 ?>">
                    <br>
                    <label>Paragraphe1</label>
                    <textarea rows="5" cols="150" name="phae1"><?php echo $phae1 ?></textarea>
                    <br>
                    <label>Paragraphe2</label>
                    <textarea rows="5" cols="150" name="phae2"><?php echo $phae2 ?></textarea>
                    <br>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Contenu de la Page Infos Pratiques</legend>
                    <label>Numéro d'urgence</label>
                    <input type="text" name="num" value="<?php echo $num ?>">
                </fieldset>
                <input type="submit" value="Valider" name="bouton-valider">
            </form>
            </div>
        </div>

    </body>
</html>