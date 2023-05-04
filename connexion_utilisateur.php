<?php
include('connexion_inc.php');

session_start();

function getClientCode($id, $mdp,$cnx){
    $res = $cnx->query('SELECT * FROM login;');
    
    while($ligne = $res->fetch()){
        if ($ligne['id']==$id && $ligne['mdp'] == md5($mdp)){
            return $ligne['code_client'];
        }
    }
    return false;
}
function getVetoCode($id, $mdp,$cnx){
    $res = $cnx->query('SELECT * FROM login;');
    
    while($ligne = $res->fetch()){
        if ($ligne['id']==$id && $ligne['mdp'] == md5($mdp)){
            return $ligne['code_veto'];
        }
    }
    return false;
}

if (isset($_POST['id']) && isset($_POST['mdp'])){

    // si c'est un admin
    if ($_POST['id']=='admin' && $_POST['mdp']=='admin'){
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['mdp'] = $_POST['mdp'];
        header('Location: ../admin.php');

    }elseif (getClientCode( $_POST['id'], $_POST['mdp'],$cnx) != false){// c'est un client...
        
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['mdp'] = $_POST['mdp'];
        $_SESSION['code'] = getClientCode( $_POST['id'], $_POST['mdp'],$cnx);

        header('Location: ../myaccount.php');

    }elseif (getVetoCode( $_POST['id'], $_POST['mdp'],$cnx) != false){// c'est le véto...
        
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['mdp'] = $_POST['mdp'];
        $_SESSION['code'] = getClientCode( $_POST['id'], $_POST['mdp'],$cnx);

        header('Location: ../veto.php');
    }else{// sinon (erreur)... -> Il n'y a pas de compte correspondant
        header('Location: ../connexion.php?error=1'); 
    }
}


?>