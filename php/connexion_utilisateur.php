<?php
include('connexion_inc.php');

session_start();

function getClientCode($id, $mdp, $cnx){
    $stmt = $cnx->prepare("SELECT codecli FROM d_login WHERE id = ? AND mdp = ? AND acces='CLIENT';");
    $stmt->execute([$id, $mdp]);
    $ligne = $stmt->fetch();

    if ($ligne) {
        return $ligne['codecli'];
    }
    return false;
}

function getVetoCode($id, $mdp, $cnx){
    $stmt = $cnx->prepare("SELECT * FROM d_login WHERE id = ? AND mdp = ? AND acces='VETO';");
    $stmt->execute([$id,$mdp]);
    $ligne = $stmt->fetch();

    if ($ligne) {
        return $ligne['id'];
    }
    return false;
}

if (!function_exists('getAdminCode')) {
    function getAdminCode($id, $mdp, $cnx){
        $stmt = $cnx->prepare("SELECT codecli FROM d_login WHERE id = ? AND mdp = ? AND acces='ADMIN';");
        $stmt->execute([$id, $mdp]);
        $ligne = $stmt->fetch();

        if ($ligne) {
            return $ligne['id'];
        }
        return false;
    }
}

if (isset($_POST['id']) && isset($_POST['mdp'])){

    // si c'est un admin
    if ($_POST['id'] == 'admin' && $_POST['mdp'] == 'admin'){
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['mdp'] = $_POST['mdp'];
        $_SESSION['acces'] = "ADMIN";

        header('Location: ../droitspages.php');
        exit;

    }elseif (getAdminCode($_POST['id'], $_POST['mdp'], $cnx) !== false){
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['mdp'] = $_POST['mdp'];
        $_SESSION['acces'] = "ADMIN";

        header('Location: ../droitspages.php');
        exit;
    }elseif (getVetoCode( $_POST['id'], $_POST['mdp'],$cnx) != false){// c'est le véto...
        
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['mdp'] = $_POST['mdp'];
        $_SESSION['acces'] = "VETO";

        header('Location: ../dossiersclients.php');
        exit;

    }elseif (getClientCode( $_POST['id'], $_POST['mdp'],$cnx) != false){// c'est un client...
        
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['mdp'] = $_POST['mdp'];
        $_SESSION['codecli'] = getClientCode( $_POST['id'], $_POST['mdp'],$cnx);
        $_SESSION['acces'] = "CLIENT";
        
        header('Location: ../moncompte.php');
        exit;

    }else{// sinon (erreur)... -> Il n'y a pas de compte correspondand=
        header('Location: ../connexion.html?error=1'); 
    }
}
