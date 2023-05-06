<?php
// Include the main TCPDF library (search for installation path).
require_once('./TCPDF/tcpdf.php');

// Création d'un nouvel objet PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// set document information
$pdf->SetAuthor('LNA');
$pdf->SetTitle('Facture Client');

// Définition des marges
$pdf->SetMargins(15, 15, 15);

// Ajout d'une nouvelle page
$pdf->AddPage();

// Récupération des paramètres de la ligne sélectionnée
$numconsultation = $_GET['numconsultation'];
$nomcli = $_GET['nomcli'];
$animal = $_GET['animal'];
$diagnostic = $_GET['diagnostic'];
$remise = $_GET['remise'];
$manipulation = $_GET['manipulation'];
$total = $_GET['total'];

// Création du tableau avec les paramètres
$html = '
<html>
<head>
    <style>
        /* Styles CSS pour le PDF */
    </style>
</head>
<body>
    <h1>Facture de Consultation</h1>
    <p>Nom du client : '.$nomcli.'</p>
    <p>Animal : '.$animal.'</p>
    <p>Diagnostic du médecin concernant '.$animal.': '.$diagnostic.'</p>
    <p>Remise  : '.$remise.'%</p>
    <p>Manipulation : '.$manipulation.'€</p>
    <p>Total du montant Hors Taxes: '.$total.'€</p>
    <br><br><br><br>
    <h3>Cabinet Médical du Dr. DAKTARI</h3>
</body>
</html>
';

// Ajout du contenu dans le PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Génération du fichier PDF
$pdf->Output('factureclient.pdf', 'I');
?>