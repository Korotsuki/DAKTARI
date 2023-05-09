
<?php
include('./php/connexion_inc.php');

// Vérification des champs
if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['date']) && !empty($_POST['heure'])) {

    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $numanimal = $_POST['numanimal'];
    $dateTime = $date . ' ' . $heure . ':00';

    // Vérification si le datetime existe déjà dans d_consultation
    $stmtCheck = $cnx->prepare("SELECT COUNT(*) FROM d_consultation WHERE dateconsultation = ?");
    $stmtCheck->execute([$dateTime]);
    $count = $stmtCheck->fetchColumn();

    if ($count > 0) {
        echo "Ce créneau horaire est déjà réservé. Veuillez choisir un autre.";
    } else {
        do {
            $idconsul = generateUniqueID(8);
        
            $reqCheck = $cnx->prepare("SELECT COUNT(*) FROM d_client WHERE numconsultation = ?;");
            $reqCheck->execute(array($idconsul));
            $count = $reqCheck->fetchColumn();
        } while ($count > 0);

        $stmtInsert = $cnx->prepare("INSERT INTO d_consultation VALUES (?,?,?,?,?,?,?,?)");
        $stmtInsert->execute([$idconsul, $dateTime, '30', '', '', '', $numanimal, null]);

        echo "Le rendez-vous a bien été pris !";
    }

} else {
    // Message d'erreur si des champs sont manquants
    echo "<p>Des champs sont manquants</p>";
}

function generateUniqueID($length)
{
    $characters = '0123456789';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, 9)];
    }

    return $randomString;
}
?>