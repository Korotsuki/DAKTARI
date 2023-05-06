<?php
// Destruction de la session
session_unset(); 
session_destroy(); 

header('Location: index.php');
exit; 
?>
