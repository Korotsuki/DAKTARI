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
        <h1>Dossiers Clients</h1>
        <br>
        <h2>Recherche Clients</h2>
        <form method="POST" action="">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : ''; ?>">
            <br>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo isset($_POST['prenom']) ? $_POST['prenom'] : ''; ?>">
            <br>
            <input type="submit" value="Rechercher">
        </form>
        <br>
        <?php
        $query = "SELECT codecli, nomcli, prenomcli, adrcli, telcli FROM d_client";
        $where = array();
        $params = array();

        if (!empty($_POST['nom'])) {
            $where[] = "nomcli = ?";
            $params[] = $_POST['nom'];
        }

        if (!empty($_POST['prenom'])) {
            $where[] = "prenomcli = ?";
            $params[] = $_POST['prenom'];
        }

        if (!empty($where)) {
            $query .= " WHERE " . implode(" AND ", $where);
        }

        $stmt = $cnx->prepare($query);
        $stmt->execute($params);
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h2>Liste Clients</h2>";
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
                echo '<td><a href="moncompte.php?codecli=' . $client['codecli'] . '&nomcli=' . $client['nomcli'] . '&prenomcli=' . $client['prenomcli'] . '&adrcli=' . $client['adrcli'] . '&telcli=' . $client['telcli'] . '">Voir le compte client</a></td>';
                echo '</tr>';                
            }
            echo '</table>';
        } else {
            echo 'Aucun client trouvé.';
        }
        ?>

        </div>
    </body>
</html>