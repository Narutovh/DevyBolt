<?php
/* On reprend la session existante quand l'utilisateur est connecté */
session_start();
/* On initialise toutes les sessions avec aucune valeur */
$_SESSION = array();
/* On détruit la session qui déconnecte l'utilisateur */
session_destroy();
/* On redirige vers la page connexion */
header("Location: log_in.php");
?>