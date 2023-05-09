<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css" />
        <title>Tarifs</title>
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
        <h1>Les tarifs en vigueur</h1>
        <br>
        <?php
        $query = "SELECT DISTINCT ON (localisation, typesoin, créneauxconsultation, distancekm)
        id_tarifs, localisation, typesoin, créneauxconsultation, distancekm, datetarification, tarif
        FROM d_tarifs
        ORDER BY localisation, typesoin, créneauxconsultation, distancekm, datetarification DESC;
        ";
        $stmt = $cnx->prepare($query);
        $stmt->execute();
        $tarifs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h2>Table des tarifs</h2>";
        if (!empty($tarifs)) {
            echo '<table>';
            echo '<tr><th>localisation</th><th>type de soin</th><th>créneaux de consultations</th><th>distancekm</th><th>tarif</th></tr>';
            foreach ($tarifs as $tarif) {
                echo '<tr>';
                echo '<td>' . $tarif['localisation'] . '</td>';
                echo '<td>' . $tarif['typesoin'] . '</td>';
                echo '<td>' . $tarif['créneauxconsultation'] . '</td>';
                if ($tarif['distancekm'] == 0) {
                    echo '<td> Clinique </td>';
                } else {
                    echo '<td> A Domicile </td>';
                }
                echo '<td>' . $tarif['tarif'] . '€</td>';
                echo '</tr>';                
            }
            echo '</table>';
        } else {
            echo 'Aucun tarif trouvé.';
        }
        ?>

        <?php if ($_SESSION['acces'] == 'VETO') : ?>
            <div class="droitsform">
                <h2>Modification des tarifs</h2>
                <form method="post">

                    <label for="localisation">Localisation :</label>
                    <select name="localisation">
                        <?php
                        $resultat = $cnx->query("SELECT DISTINCT localisation FROM d_tarifs");
                        while ($ligne = $resultat->fetch(PDO::FETCH_OBJ)) {
                            echo '<option value="' . $ligne->localisation . '" name="'.$ligne->localisation.'">';
                            echo $ligne->localisation;
                            echo '</option>';
                        }
                        ?>
                    </select>

                    <label for="typesoin">Type de Soin :</label>
                    <select name="typesoin">
                        <?php
                        $resultat = $cnx->query("SELECT DISTINCT typesoin FROM d_tarifs");
                        while ($ligne = $resultat->fetch(PDO::FETCH_OBJ)) {
                            echo '<option value="' . $ligne->typesoin . '" name="'.$ligne->typesoin.'">';
                            echo $ligne->typesoin;
                            echo '</option>';
                        }
                        ?>
                    </select>

                    <label for="creneauxconsultation">Créneaux de Consultations :</label>
                    <select name="creneauxconsultation">
                        <?php
                        $resultat = $cnx->query("SELECT DISTINCT créneauxconsultation FROM d_tarifs");
                        while ($ligne = $resultat->fetch(PDO::FETCH_OBJ)) {
                            echo '<option value="' . $ligne->créneauxconsultation . '" name="'.$ligne->créneauxconsultation.'">';
                            echo $ligne->créneauxconsultation;
                            echo '</option>';
                        }
                        ?>
                    </select>

                    <label for="distancekm">Distance en km :</label>
                    <select name="distancekm">
                        <?php
                        $resultat = $cnx->query("SELECT DISTINCT distancekm FROM d_tarifs");
                        while ($ligne = $resultat->fetch(PDO::FETCH_OBJ)) {
                            echo '<option value="' . $ligne->distancekm . '" name="'.$ligne->distancekm.'">';
                            if ($ligne->distancekm == 0) {
                                echo 'Clinique';
                            } else {
                                echo '>' . $ligne->distancekm . ' km';
                            }
                            echo '</option>';
                        }
                        ?>
                    </select>

                    <label for="motifremise">Tarif</label>
                    <input type="number" name="tarif"/>
                    
                    <div class="choicesdroits">
                        <input type="reset" name="reset" value="Effacer" /> 
                        <input type="submit" name="Modifier" value="Modifier" />
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <?php
        if (isset($_POST["Modifier"])) {
                
                $query = "SELECT MAX(id_tarifs) FROM d_tarifs";
                $idtarif = $cnx->query($query)->fetchColumn();
                $idtarif += 1;

                $localisation = $_POST['localisation'];
                $typesoin = $_POST['typesoin'];
                $creneauxconsultation = $_POST['creneauxconsultation'];
                $distancekm = $_POST['distancekm'];

                $query = "SELECT CURRENT_DATE";
                $date = $cnx->query($query)->fetchColumn();

                $tarif = $_POST['tarif'];
                
                $requete = $cnx->prepare("SELECT * FROM d_tarifs WHERE localisation = :localisation AND typesoin = :typesoin AND créneauxconsultation = :creneauxconsultation AND distancekm = :distancekm AND datetarification = :datetarification AND tarif = :tarif;");
                $requete->execute([$localisation, $typesoin, $creneauxconsultation, $distancekm, $date, $tarif]);
                $ligne = $requete->fetch();

                if (!$ligne) {
                    // Insertion des données dans la base de données
                    $query = "INSERT INTO d_tarifs (id_tarifs, localisation, typesoin, créneauxconsultation, distancekm, datetarification, tarif) 
                    VALUES (:id_tarifs, :localisation, :typesoin, :creneauxconsultation, :distancekm, :datetarification, :tarif)";
                    $stmt = $cnx->prepare($query);
                    $stmt->bindParam(':id_tarifs', $idtarif);
                    $stmt->bindParam(':localisation', $localisation);
                    $stmt->bindParam(':typesoin', $typesoin);
                    $stmt->bindParam(':creneauxconsultation', $creneauxconsultation);
                    $stmt->bindParam(':distancekm', $distancekm);
                    $stmt->bindParam(':datetarification', $date);
                    $stmt->bindParam(':tarif', $tarif);
                    
                    if ($stmt->execute()) {
                        echo "Données insérées avec succès.";
                        
                    } else {
                        echo "Erreur lors de l'insertion des données.";
                    }

                }
                return false;
        }
        ?>

        </div>
    </body>
</html>