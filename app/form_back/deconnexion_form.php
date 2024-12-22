<?php
session_start();
#$_SESSION['isRegistered'] = false;
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session
header("Location: ./index.php");
exit();
?>