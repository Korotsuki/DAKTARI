<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css" />
        <title>Accueil</title>
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
                    <!--<li class="item"><a href="./index.html">Accueil</a></li>-->
                    <li class="item"><a href="./team.php">L'équipe Vet</a></li>
                    <li class="item"><a href="./infospratiques.php">Informations pratiques</a></li>
                    <li class="item connect"><a href="./connexion.html">Se connecter</a></li>
                    <li class="item rdv"><a href="./connexion.html">Prendre RDV | 06 54 91 23 45</a></li>
                </ul>
            </div>
        </nav>

        <!-- Contenu de la page -->
        <?php include('contenu.php'); ?>
        <div class="container">
            <div class="modif">
                <h1>Modification du contenu</h1>
        
                <form action="contenu.php" method="POST">
                    <fieldset>
                        <legend>Contenu de la Page d'acceuil</legend>
                        <label>Message d'acceuil</label>
                        <input type="textarea" name="acceuil" value="<?php echo $acceuil ?>">
                        <br/>
                        <label>Paragraphe 1</label>
                        <input type="textarea" name="phaa1" value="<?php echo $phaa1 ?>">
                        <label>Paragraphe 2</label>
                        <input type="textarea" name="phaa2" value="<?php echo $phaa2 ?>">
                        <label>Paragraphe 3</label>
                        <input type="textarea" name="phaa3" value="<?php echo $phaa3 ?>">
                        <br/>
                    </fieldset>
        
                    <fieldset>
                        <legend>Contenu de la Page Equipe</legend>
                        <label>Titre Equipe</label>
                        <input type="textarea" name="titreEquipe" value="<?php echo $titreEquipe ?>">
                        <br/>
                        <label>Veterinaire</label>
                        <input type="textarea" name="pha1" value="<?php echo $pha1 ?>">
                        <label>Phrase d'accroche</label>
                        <input type="textarea" name="pha2" value="<?php echo $pha2 ?>">
                        <label>Paragraphe1</label>
                        <input type="textarea" name="phae1" value="<?php echo $phae1 ?>">
                        <label>Paragraphe2</label>
                        <input type="textarea" name="phae2" value="<?php echo $phae2 ?>">
                        <br/>
                    </fieldset>
        
                    <fieldset>
                        <legend>Contenu de la Page Infos Pratiques</legend>
                        <label>Numéro d'urgence</label>
                        <input type="textarea" name="num" value="<?php echo $num ?>">
                    </fieldset>
                    <input type="submit" value="Valider" name="bouton-valider">
                </form>
            </div>
        </div>


         <!-- Code du bas de page -->
         <footer class="footer">
            <div class="bloc">
                <p>14 rue des fleurets</p>
                <p>45120 Châlette-sur-Loing</p>
            </div>
            <div class="bloc">
                <div class="rec"></div>
            </div>
            <div class="bloc">
                <p>CPGU</p>
                <p>Mentions légales</p> 
                <p>Règles RGPD</p>
            </div>
        </footer>
        <p class="copyright">© 2023・Tous droits réservés</p>

    </body>
</html>