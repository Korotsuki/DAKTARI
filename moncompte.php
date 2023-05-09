<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css" />
        <title>Dossier Client</title>
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
        <div class="containerprive">
        <h1>Mon compte</h1>
        <?php
            echo "Vous êtes connecté en tant que ";
            echo $_SESSION['id'];
            if (isset($_GET['codecli'])) {
                $cli = $_GET['codecli'];
            } elseif (isset($_SESSION['codecli'])) {
                $cli = $_SESSION['codecli'];
            }
        ?>
        <br><br><br>
        <?php
            $query = "SELECT * FROM d_client WHERE d_client.codecli = :codecli;";
            $stmt = $cnx->prepare($query);
            $stmt->bindParam(':codecli', $cli);
            $stmt->execute();
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2>Mes infos</h2>";
            if (!empty($clients)) {
                echo '<table>';
                echo '<tr><th>Code</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Téléphone</th></tr>';
                foreach ($clients as $client) {
                    echo '<tr>';
                    echo '<td>' . $client['codecli'] . '</td>';
                    echo '<td>' . $client['nomcli'] . '</td>';
                    echo '<td>' . $client['prenomcli'] . '</td>';
                    echo '<td>' . $client['adrcli'] . '</td>';
                    echo '<td>' . $client['telcli'] . '</td>';
                    echo '</tr>';                
                }
                echo '</table>';
            } else {
                echo 'Aucune informations :/';
            }
        ?>
        <br><br><br>
        <?php
            $query = "SELECT * FROM d_professionnel NATURAL JOIN d_client WHERE d_client.codecli = :codecli;";
            $stmt = $cnx->prepare($query);
            $stmt->bindParam(':codecli', $cli);
            $stmt->execute();
            $pros = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2>Mes infos professionnelles</h2>";
            if (!empty($pros)) {
                echo '<table>';
                echo '<tr><th>IBAN</th><th>SiteWeb</th></tr>';
                foreach ($pros as $pro) {
                    echo '<tr>';
                    echo '<td>' . $pro['iban'] . '</td>';
                    echo '<td>' . $pro['sitewebpro'] . '</td>';
                    echo '</tr>';                
                }
                echo '</table>';
            } else {
                echo 'Aucune informations :/';
            }
        ?>
        <p>Pour modifier ses informations, demandez à votre secrétaire par mail (pour des raisons de sécurités)</p>
        <br><br><br>
        <?php
            $query = "SELECT d_animal.* FROM d_animal INNER JOIN d_client ON d_client.codecli = d_animal.codecli WHERE d_client.codecli = :codecli;";
            $stmt = $cnx->prepare($query);
            $stmt->bindParam(':codecli', $cli);
            $stmt->execute();
            $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2>Mes animaux</h2>";
            if (!empty($animaux)) {
                echo '<table>';
                echo '<tr><th>Numero</th><th>Nom</th><th>Genre</th><th>Race</th><th>Taille</th><th>Poids</th></tr>';
                foreach ($animaux as $animal) {
                    echo '<tr>';
                    echo '<td>' . $animal['numanimal'] . '</td>';
                    echo '<td>' . $animal['nomanimal'] . '</td>';
                    echo '<td>' . $animal['genre'] . '</td>';
                    echo '<td>' . $animal['nomrace'] . '</td>';
                    echo '<td>' . $animal['taille'] . '</td>';
                    echo '<td>' . $animal['poids'] . '</td>';
                    echo '</tr>';                
                }
                echo '</table>';
            } else {
                echo 'Aucune informations :/';
            }
        ?>

        <div class="form">
            <section class="formulaire_co">
                <h1>Modifier son compte</h1>
                <br/>
                <form action="" method="POST">
                    <h2>Informations utilisateur</h2>
                    <?php
                    // Récupérer les informations du client à partir de la base de données
                    $query = "SELECT * FROM d_client WHERE codecli = :codecli;";
                    $stmt = $cnx->prepare($query);
                    $stmt->bindParam(':codecli', $cli);
                    $stmt->execute();
                    $client = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <label>Nom</label>
                    <input type="text" name="nom" value="<?php echo $client['nomcli']; ?>">
                    <br/>
                    <label>Prénom</label>
                    <input type="text" name="prenom" value="<?php echo $client['prenomcli']; ?>">
                    <br/>
                    <label>Adresse</label>
                    <input type="text" name="adresse" value="<?php echo $client['adrcli']; ?>">
                    <br/>
                    <label>Numéro De Téléphone</label>
                    <input type="text" name="num" value="<?php echo $client['telcli']; ?>">
                    <br/>
                    <input type="submit" value="Terminer" name="bouton-valider">
                </form>
            </section>
        </div>
        <?php
            if (isset($_POST['bouton-valider'])) {
                // Récupérer les nouvelles valeurs des champs du formulaire
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $adresse = $_POST['adresse'];
                $num = $_POST['num'];

                // Mettre à jour les informations du client dans la base de données
                $query = "UPDATE d_client SET nomcli = :nom, prenomcli = :prenom, adrcli = :adresse, telcli = :num WHERE codecli = :codecli;";
                $stmt = $cnx->prepare($query);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':adresse', $adresse);
                $stmt->bindParam(':num', $num);
                $stmt->bindParam(':codecli', $cli);
                $stmt->execute();

                // Afficher un message de succès ou d'erreur
                if ($stmt->rowCount() > 0) {
                    echo "Les informations du client ont été mises à jour avec succès.";
                } else {
                    echo "Une erreur s'est produite lors de la mise à jour des informations du client.";
                }
            }
            ?>

            
        </div>
    </body>
</html>