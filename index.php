<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css" />
        <title>Modif</title>
        <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon.ico">
        <META NAME="Author" CONTENT="Hélèna/Maryam">
        <META NAME="Keywords" CONTENT="DAKTARI">
    </head>
    <body>

        <!-- Code du haut de page -->
        <nav class="NAVBAR">
            <div class="scroll"></div>
            <div class="DAKTARI">
                <a href="./index.html"><img src="./img/daktari.png" alt="DAKTARI"></a>
            </div>
            <div class="NAVI">
                <ul class="menu">
                    <!--<li class="item"><a href="./index.html">Accueil</a></li>-->
                    <li class="item"><a href="./team.html">L'équipe Vet</a></li>
                    <li class="item"><a href="./infospratiques.html">Informations pratiques</a></li>
                    <li class="item connect"><a href="./connexion.html">Se connecter</a></li>
                    <li class="item rdv"><a href="./rdv.html">Prendre RDV | 06 54 91 23 45</a></li>
                </ul>
            </div>
        </nav>

        <!-- Contenu de la page -->
        <?php include('contenu.php'); ?>
        <div class="container">
            <div class="accueil">
                <div class="img1"></div>
                <p><?php echo $acceuil; ?></p>
            </div>


            <section class="infos">
                <div class="bloc">
                    <img src="./img/adn.png" width="50px" height="50px" alt="">
                    <p><?php echo $phaa1; ?></p>
                </div>
                <div class="bloc">
                    <img src="./img/collier.png" width="50px" height="50px" alt="">
                    <p><?php echo $phaa2; ?></p>
                </div>
                <div class="bloc">
                    <img src="./img/trousse.png" width="50px" height="50px" alt="">
                    <p><?php echo $phaa3; ?></p>
                </div>
            </section>


            <div class="plus">
                <a href="./connexion.html">Connectez-vous à votre compte pour accéder à plus d’interractions !</a>
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