
<?php
// Vérification des champs
if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['date']) && !empty($_POST['heure'])) {

	// Récupération des données du formulaire
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$date = $_POST['date'];
	$heure = $_POST['heure'];

} else {
	// Message d'erreur si des champs sont manquants
	echo "<p>Des champs sont manquants</p>"
?>
            