<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css" />
        <title>Gestion consultations</title>
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
        <?php
            echo "Vous êtes connectés en tant que ";
            echo $_SESSION['id'];
        ?>
        <br>
        <h2>Recherche consultation</h2>
        <form method="POST" action="">
            <label for="nom">Nom :</label>
            <input type="text" id="numconsultation" name="numconsultation" value="<?php echo isset($_POST['numconsultation']) ? $_POST['numconsultation'] : ''; ?>">
            <br>
            <input type="submit" value="Rechercher">
        </form>
        <br>
        <?php
        $query = "SELECT * FROM d_consultation WHERE dateconsultation > NOW() ORDER BY dateconsultation DESC";
        $stmt = $cnx->prepare($query);
        $stmt->execute();
        $consultations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<h2>Liste Consultations à venir</h2>";
        if (!empty($consultations)) {
            echo '<table>';
            echo '<tr><th>Code Consultation</th><th>Date</th><th>Durée</th><th>Problème</th><th>Diagnostic</th><th>Résumé</th><th>Code Animal</th><th>Consultation Précédente</th></tr>';
            foreach ($consultations as $consultation) {
                echo '<tr>';
                echo '<td>' . $consultation['numconsultation'] . '</td>';
                echo '<td>' . $consultation['dateconsultation'] . '</td>';
                echo '<td>' . $consultation['dureeconsultation'] . '</td>';
                echo '<td>' . $consultation['problemeconsultation'] . '</td>';
                echo '<td>' . $consultation['diagnosticconsultation'] . '</td>';
                echo '<td>' . $consultation['resumeconsultation'] . '</td>';
                echo '<td>' . $consultation['numanimal'] . '</td>';
                echo '<td>' . $consultation['numconsultation_consultation_précédente'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'Aucune consultation à venir trouvée.';
        }
        ?>
        
        <?php
        $query = "SELECT * FROM d_consultation";
        $where = array();
        $params = array();

        if (!empty($_POST['numconsultation'])) {
            $where[] = "numconsultation = ?";
            $params[] = $_POST['numconsultation'];
        }

        if (!empty($where)) {
            $query .= " WHERE " . implode(" AND ", $where);
        }
        
        $query .= " ORDER BY dateconsultation DESC";
        $stmt = $cnx->prepare($query);
        $stmt->execute($params);
        $consultations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h2>Liste Consultations</h2>";
        if (!empty($consultations)) {
            echo '<table>';
            echo '<tr><th>Code Consultation</th><th>Date</th><th>Durée</th><th>Problème</th><th>Diagnostic</th><th>Résumé</th><th>Code Animal</th><th>Consultation Précédente</th></tr>';
            foreach ($consultations as $consultation) {
                echo '<tr>';
                echo '<td>' . $consultation['numconsultation'] . '</td>';
                echo '<td>' . $consultation['dateconsultation'] . '</td>';
                echo '<td>' . $consultation['dureeconsultation'] . '</td>';
                echo '<td>' . $consultation['problemeconsultation'] . '</td>';
                echo '<td>' . $consultation['diagnosticconsultation'] . '</td>';
                echo '<td>' . $consultation['resumeconsultation'] . '</td>';
                echo '<td>' . $consultation['numanimal'] . '</td>';
                echo '<td>' . $consultation['numconsultation_consultation_précédente'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'Aucune consultation trouvée.';
        }
        ?>
        <br>
        <h2>Mise à jour de la consultation</h2>
        <form method="POST">
            <label>Num de consultation :</label>
            <input type="text" name="numconsultation" value="<?php echo $consultation['numconsultation']; ?>">
            <label>Durée :</label>
            <input type="number" name="dureeconsultation" value="<?php echo $consultation['dureeconsultation']; ?>"><br>
            <label>Problème :</label>
            <textarea name="problemeconsultation"><?php echo $consultation['problemeconsultation']; ?></textarea><br>
            <label>Diagnostic :</label>
            <textarea name="diagnosticconsultation"><?php echo $consultation['diagnosticconsultation']; ?></textarea><br>
            <label>Résumé :</label>
            <textarea name="resumeconsultation"><?php echo $consultation['resumeconsultation']; ?></textarea><br>
            <input type="submit" value="Modifier" name="Modifier">
        </form>
        <?php
        if (isset($_POST['Modifier'])) {
            $numc = $_POST['numconsultation'];
            $dureeconsultation = $_POST['dureeconsultation'];
            $problemeconsultation = $_POST['problemeconsultation'];
            $diagnosticconsultation = $_POST['diagnosticconsultation'];
            $resumeconsultation = $_POST['resumeconsultation'];

            $query = "UPDATE d_consultation SET dureeconsultation = ?, problemeconsultation = ?, diagnosticconsultation = ?, resumeconsultation = ? WHERE numconsultation = ?";
            $stmt = $cnx->prepare($query);
            $stmt->execute([$dureeconsultation, $problemeconsultation, $diagnosticconsultation, $resumeconsultation, $numc]);

            echo "Consultation mise à jour avec succès.";
        }
        ?>

        <?php

        ?>
        </div>
    </body>
</html>