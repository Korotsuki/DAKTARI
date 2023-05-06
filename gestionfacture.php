<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css" />
        <title>Gestion des Factures</title>
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
        <h1>Gestion des factures</h1>

        <?php
        $query = "
        SELECT d_facturer.numconsultation, d_animal.nomanimal as animal, d_client.nomcli as client, d_consultation.diagnosticconsultation as diagnostic, _remise, motifremise, d_manip.tarifmanip as manipulation, (tarif - ROUND((tarif * COALESCE(_remise, 0) / 100), 2) + COALESCE(d_manip.tarifmanip, 0)) as Total
        FROM d_facturer
        JOIN d_tarifs ON d_tarifs.id_tarifs = d_facturer.id_tarifs
        JOIN d_consultation ON d_consultation.numconsultation = d_facturer.numconsultation
        JOIN d_animal ON d_animal.numanimal = d_consultation.numanimal
        JOIN d_client ON d_client.codecli = d_animal.codecli
        LEFT JOIN d_manip ON d_manip.numconsultation = d_consultation.numconsultation;
        ";
        $resultat = $cnx->query($query);

        echo '<table>';
        echo '<tr><th>Numéro de consultation</th><th>Animal</th><th>Client</th><th>Diagnostic</th><th>Remise</th><th>Motif Remise</th><th>Manipulation</th><th>Total</th><th>PDF</th></tr>';
        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $ligne['numconsultation'] . '</td>';
            echo '<td>' . $ligne['animal'] . '</td>';
            echo '<td>' . $ligne['client'] . '</td>';
            echo '<td>' . $ligne['diagnostic'] . '</td>';
            echo '<td>' . $ligne['_remise'] . '</td>';
            echo '<td>' . $ligne['motifremise'] . '</td>';
            echo '<td>' . $ligne['manipulation'] . '</td>';
            echo '<td>' . $ligne['total'] . '</td>';
            echo '<td><a href="facturepdf.php?numconsultation=' . $ligne['numconsultation'] . '&nomcli=' . ($ligne['client']) . '&animal=' . ($ligne['animal']) . '&diagnostic=' . ($ligne['diagnostic']) . '&remise=' . $ligne['_remise'] . '&manipulation=' . ($ligne['manipulation']) . '&total=' . $ligne['total'] . '">PDF</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        ?>

<div class="droitsform">
            <h2>Modification des remises</h2>
            <form method="post">
            <label for="numconsultation">Numéro Consultation:</label>
            <?php
			$resultat=$cnx->query("SELECT numconsultation FROM d_consultation");
				echo '<select name="numconsultation">';
			while( $ligne = $resultat->fetch(PDO::FETCH_OBJ) ) {
				echo '<option value="'.$ligne->numconsultation.'">';
				echo $ligne->numconsultation;
				echo '</option>';
			}
				echo '</select>';
			?>
            <label for="_remise">% Remise : </label>
            <input type="number" name="_remise" value="0">

            <label for="motifremise">Motif de la remise :</label>
            <input type="text" name="motifremise">

            <div class="choicesdroits">
            <input type="reset" name="reset" value="Effacer" /> 
            <input type="submit" name="Modifier" value="Modifier" />
            </div>
            </form>

            <?php
            if (isset($_POST["Modifier"])) {
                $numConsultation = $_POST['numconsultation'];
                $remise = $_POST['_remise'];
                $motifremise = $_POST['motifremise'];

                // Mise à jour des valeurs dans la base de données
                $requete = "UPDATE d_facturer SET _remise = '$remise', motifremise = '$motifremise' WHERE numconsultation = '$numConsultation'";
                
                // Exécution de la requête
                $resultat = $cnx->exec($requete);

                // Vérification si la mise à jour a été effectuée avec succès
                if ($resultat !== false) {
                    echo "Les valeurs ont été mises à jour avec succès. Veuillez rafraichir la page";
                } else {
                    echo "Erreur lors de la mise à jour des valeurs.";
                }
            }
            ?>



        </div>
    </body>
</html>