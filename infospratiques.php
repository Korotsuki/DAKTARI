<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css" />
        <title>Infos Pratiques</title>
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
        <div class="infoscontainer">
            <?php include('contenu.php'); ?>
            <div class="centrage">
                <div class="Numéro">
                    <h2>Informations pratiques</h2>
                    <p>Numéro d'urgence</p>
                    <p><?php echo $num; ?></p>
                </div>
                <div class="Horaire">
                    <table>
                        <caption>
                          Horaires d'ouverture
                        </caption>
                        
                        <tr>
                          <th>Jours</th>
                          <th>Ouverture</th>
                          <th>Fermeture</th>
                        </tr>
                  
                        <tr>
                          <td data-cell="username">Lundi</td> 
                          <td data-cell="performance points">8h</td> 
                          <td data-cell="accuracy">15h</td> 
                        </tr>
                  
                        <tr>
                          <td data-cell="username">Mardi</td> 
                          <td data-cell="performance points">8h</td> 
                          <td data-cell="accuracy">18h</td> 
                        </tr>
                  
                        <tr>
                          <td data-cell="username">Mercredi</td> 
                          <td data-cell="performance points">8h</td> 
                          <td data-cell="accuracy">18h</td> 
                        </tr>

                        <tr>
                            <td data-cell="username">Jeudi</td> 
                            <td data-cell="performance points">8h</td> 
                            <td data-cell="accuracy">18h</td> 
                          </tr>
                      </table>
                </div>
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