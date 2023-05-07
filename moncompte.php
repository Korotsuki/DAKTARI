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
            echo "Vous êtes connectés en tant que ";
            echo $_SESSION['id'];
        ?>
        <br>
        <?php
            $query = "SELECT d_client.* FROM d_login INNER JOIN d_client ON d_client.codecli = d_login.codecli WHERE d_login.id = :id;";
            $stmt = $cnx->prepare($query);
            $stmt->bindParam(':id', $_SESSION['id']);
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
        <br>
        <?php
            $query = "SELECT d_animal.* FROM d_animal INNER JOIN d_client ON d_client.codecli = d_animal.codecli INNER JOIN d_login ON d_client.codecli = d_login.codecli WHERE d_login.id = :id;";
            $stmt = $cnx->prepare($query);
            $stmt->bindParam(':id', $_SESSION['id']);
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
        </div>
    </body>
</html>