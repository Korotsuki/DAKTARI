<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css" />
        <title>Equipe Vet</title>
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
                    <li class="item"><a href="./infospratiques.php">Informations pratiques</a></li>
                    <li class="item connect"><a href="./connexion.html">Se connecter</a></li>
                    <li class="item rdv"><a href="./rdv.html">Prendre RDV | 06 54 91 23 45</a></li>
                </ul>
            </div>
        </nav>

        <!-- Contenu de la page -->
        <body>
            <div class="form">
                <section class="formulaire_co">
                    <h1>Prise de rendez-vous</h1>
                    <form action="rdv.php" method="post" >
                        <label>Nom :</label>
                        <input type="text" name="nom" required>
                        <br/>
                        <label>Prénom :</label>
                        <input type="text" name="prenom" required>
                        <br/>
                        <label>Date :</label>
                        <!--<input type="date" name="date" required>-->
                        <input type="date" name="date" required>
                        <br/>
                        <label>Heure :</label>
                        <!--<input type="time" name="heure" required>-->
                        <select name="heure" required>
                            <option value="">-- Sélectionnez un créneau horaire --</option>
                            <option value="08:00">08:00</option>
							<option value="08:30">08:30</option>
                            <option value="09:00">09:00</option>
							<option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
							<option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
							<option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
							<option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
							<option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
							<option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
							<option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
							<option value="17:30">17:30</option>
                            <option value="18:00">18:00</option>
                        </select>
                        <br/>
                        <label>Animal :</label>
                        <?php   
                        include('./php/connexion_inc.php');
                        include('./php/connexion_utilisateur.php');
                            $resultat=$cnx->prepare("SELECT numanimal,nomanimal FROM d_animal WHERE d_animal.codecli = ?");
                            $resultat->execute([$_SESSION['codecli']]);
                            echo '<select name="numanimal">';
                        while( $ligne = $resultat->fetch(PDO::FETCH_OBJ) ) {
                            echo '<option value="'.$ligne->numanimal.'">';
                            echo $ligne->nomanimal;
                            echo '</option>';
                        }
                            echo '</select>';
                        ?>
                        <br/>
                        <label>Lieu du rdv :</label>
                        <select name="lieu">
                            <option value="" selected>Choisissez un lieu de rendez-vous :</option>
                            <option value="clinique">Clinique</option>
                            <option value="domicile">Domicile</option>
                        </select>
                        <br/>
                        <input class="button" style="color: #53ACFF; background-color: #fff; margin-top: 25px;" type="reset" value="Annuler">
                        <input class="button" type="submit" value="Enregistrer">
                        <!--<button class="button"><a href="connexion.html">Enregistrer</a></button>-->
                    </form>
                </section>
            </div>
        </body>

</html>