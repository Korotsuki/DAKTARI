<?php
// nom fichier 
$filename = "data.txt";

// Si le fichier existe, récupérer les variables
if (file_exists($filename)) {
    $fileContent = file_get_contents($filename);
    $variables = unserialize($fileContent);
} else {
    $variables = array();
}

//PAGE ACCEUIL
$acceuil = "BIENVENUE À LA CLINIQUE CHAPI & CHAPO";
$phaa1 = "Clinique vétérinaire pour chiens, chats et petits animaux de compagnie";
$phaa2 = "1 vétérinaire vous reçoit sur rendez-vous du lundi au samedi";
$phaa3 = "Préparez votre visite pour une consultation, une chirurgie ou une urgence";

//PAGE EQUIPE
$titreEquipe = "L'ÉQUIPE DAKTARI";
$pha1 = "Dr. DAKTARI";
$pha2 = "Le vétérinaire sympa !";
$phae1 = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga est autem sequi mollitia animi voluptatem, dicta minima dolore quis minus in voluptatum eligendi aut nemo ex provident magnam voluptates ipsa?
Vel itaque, sint cum tempora, ullam vitae adipisci excepturi, temporibus veniam officiis ut obcaecati nesciunt saepe doloribus quam! Fuga voluptatum dicta aut. Ad quibusdam molestias reiciendis et doloremque suscipit perferendis?";
$phae2 = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Error voluptatibus necessitatibus sint tempore praesentium illum ratione eligendi repudiandae aliquam modi tempora aut accusantium cumque voluptas fugit reprehenderit, natus aperiam fuga!
Modi, numquam sunt blanditiis fuga recusandae tenetur enim minima, aut laudantium molestias assumenda quas rem id laborum fugiat aspernatur in? Minima blanditiis reiciendis molestiae mollitia labore omnis. Autem, aliquid fugit.
Fugiat deleniti vel deserunt optio quibusdam sint porro quae assumenda laborum? Commodi consequuntur modi nulla illo quasi numquam esse adipisci facere saepe beatae cum, eum sequi sapiente qui eaque molestias?
Ratione optio voluptatibus accusantium voluptate, minus deserunt quasi libero dicta dignissimos sunt eum ex iusto sint! Maxime culpa consequuntur reprehenderit voluptatem unde aperiam error laboriosam odio, magni deserunt rem sint.
Facere laborum eos repellendus, vero unde reprehenderit atque corrupti illum dicta! Quod quaerat ab architecto ratione unde nulla enim eligendi dolorum porro molestiae quae, sunt dolores laboriosam cumque repellendus animi?";

//PAGE INFOS
$num = "+33 01 555 555 555";

if(isset($_POST['bouton-valider'])){
    $acceuil = $_POST['acceuil'];
    $phaa1 = $_POST['phaa1'];
    $phaa2 = $_POST['phaa2'];
    $phaa3 = $_POST['phaa3'];
    $titreEquipe = $_POST['titreEquipe'];
    $pha1 = $_POST['pha1'];
    $pha2 = $_POST['pha2'];
    $phae1 = $_POST['phae1'];
    $phae2 = $_POST['phae2'];
    $num = $_POST['num'];

    // Ajouter les variables au tableau
    $variables['acceuil'] = $acceuil;
    $variables['phaa1'] = $phaa1;
    $variables['phaa2'] = $phaa2;
    $variables['phaa3'] = $phaa3;
    $variables['titreEquipe'] = $titreEquipe;
    $variables['pha1'] = $pha1;
    $variables['pha2'] = $pha2;
    $variables['phae1'] = $phae1;
    $variables['phae2'] = $phae2;
    $variables['num'] = $num;

    // Écrire les variables dans le fichier
    file_put_contents($filename, serialize($variables));
} else {
    // Si aucune donnée n'a été envoyée, récupérer les variables du tableau
    if(isset($variables['acceuil'])) $acceuil = $variables['acceuil'];
    if(isset($variables['phaa1'])) $phaa1 = $variables['phaa1'];
    if(isset($variables['phaa2'])) $phaa2 = $variables['phaa2'];
    if(isset($variables['phaa3'])) $phaa3 = $variables['phaa3'];
    if(isset($variables['titreEquipe'])) $titreEquipe = $variables['titreEquipe'];
    if(isset($variables['pha1'])) $pha1 = $variables['pha1'];
    if(isset($variables['pha2'])) $pha2 = $variables['pha2'];
    if(isset($variables['phae1'])) $phae1 = $variables['phae1'];
    if(isset($variables['phae2'])) $phae2 = $variables['phae2'];
    if(isset($variables['num'])) $num = $variables['num'];
}
?>